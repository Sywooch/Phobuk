<?php

namespace frontend\controllers;

use common\models\Friendship;
use common\models\Photo;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FriendshipController implements the CRUD actions for Friendship model.
 */
class FriendshipController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Friendship models.
     * @return mixed
     */
    public function actionIndex($id) {

        $user = null;

        if ($id) {
            $query = User::find();

            $query->where('id = :id_param', [
                'id_param' => $id
            ]);
            $user = $query->one();
        } else {
            $user = Yii::$app->user->identity;
        }
        if (!$user) {
            throw new NotFoundHttpException("Nie istnieje użytkownik o id= " . $id);
        }

        $confirmedQuery = Friendship::find()
            ->forUserId($user->getId())
            ->confirmed()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        $confirmedDataProvider = new ActiveDataProvider([
            'query' => $confirmedQuery
        ]);

        /** @var Friendship $model */
        /** @var Photo $photoAvatar */
        return $this->render('index', [
            'confirmedDataProvider' => $confirmedDataProvider,
            'user' => $user->getId(),

        ]);
    }

    /**
     * Displays a single Friendship model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRequest($id) {
        $user = Yii::$app->user->identity;

        $friendRequestDataProvider = new ActiveDataProvider();
        $friendRequestDataProvider->query = Friendship::find()
            ->forUserId($user->getId())
            ->waiting()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);
        return $this->render('request', [

            'requestsDataProvider' => $friendRequestDataProvider,
            'user' => $user->getId(),

        ]);
    }

    /**
     * Creates a new Friendship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionInvite($id) {

        $model = new Friendship();

        $model->friend_one = Yii::$app->user->identity->getId();
        $model->friend_two = $id;
        $model->status = Friendship::STATUS_FRIEND_REQUEST;

        $model->save();
        return $this->redirect(['/profile', 'id' => $id]);
    }

    public function actionRevertInvite($id) {

        $friendship = Friendship::find()
            ->where('friend_one = :currentUserId and friend_two = :userId and status = :status', [
                'status' => Friendship::STATUS_FRIEND_REQUEST,
                'currentUserId' => Yii::$app->user->identity->id,
                'userId' => $id])
            ->one();

        if ($friendship) {
            $friendship->delete();
        }

        return $this->redirect(['/profile', 'id' => $id]);
    }

    public function actionConfirmInvite($id) {

        $friendship = Friendship::find()
            ->where('friend_two = :currentUserId and friend_one = :userId and status = :status', [
                'status' => Friendship::STATUS_FRIEND_REQUEST,
                'currentUserId' => Yii::$app->user->identity->id,
                'userId' => $id])
            ->one();

        if ($friendship) {
            $friendship->status = Friendship::STATUS_CONFIRM_FRIENDS;
            $friendship->save();
        }

        return $this->redirect(['/profile', 'id' => $id]);
    }


    public function actionRemove($id) {

        $friendship = Friendship::find()
            ->forUsers(Yii::$app->user->identity->id, $id)
            ->confirmed()
            ->one();

        if ($friendship) {
            $friendship->delete();
        }

        return $this->redirect(['/profile', 'id' => $id]);
    }


    public function actionReject($id) {

        $friendship = Friendship::find()
            ->forUsers(Yii::$app->user->identity->id, $id)
            ->waiting()
            ->one();

        if ($friendship) {
            $friendship->delete();
        }

        return $this->redirect(['/profile', 'id' => $id]);
    }

    /**
     * Updates an existing Friendship model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Friendship model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Friendship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Friendship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Friendship::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
