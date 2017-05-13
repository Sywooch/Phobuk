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
            'query' => $confirmedQuery,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $model = new Friendship();
        /** @var Friendship $model */
        /** @var Photo $photoAvatar */
        return $this->render('index', [
            'confirmedDataProvider' => $confirmedDataProvider,
            'user' => $user->getId(),
            'model' => $model,

        ]);
    }

    public function actionRequest($id) {
        $user = Yii::$app->user->identity;

        $query = Friendship::find()
            ->forUserId($user->getId())
            ->waiting()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        $friendRequestDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],

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
        return $this->redirect(Yii::$app->request->referrer);
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

        return $this->redirect(Yii::$app->request->referrer);
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

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionRemove($id) {

        $friendship = Friendship::find()
            ->forUsers(Yii::$app->user->identity->id, $id)
            ->confirmed()
            ->one();

        if ($friendship) {
            $friendship->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionReject($id) {

        $friendship = Friendship::find()
            ->forUsers(Yii::$app->user->identity->id, $id)
            ->waiting()
            ->one();

        if ($friendship) {
            $friendship->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
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
