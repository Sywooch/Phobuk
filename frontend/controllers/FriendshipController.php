<?php

namespace frontend\controllers;

use common\models\Friendship;
use common\models\Photo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FriendshipController implements the CRUD actions for Friendship model.
 */
class FriendshipController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;


        $confirmedQuery = Friendship::find()
            ->forUserId($user->getId())
            ->confirmed()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        $confirmedDataProvider = new ActiveDataProvider([
            'query' => $confirmedQuery
        ]);


        $friendRequestDataProvider = new ActiveDataProvider();
        $friendRequestDataProvider->query = Friendship::find()
            ->forUserId($user->getId())
            ->waiting();


        /** @var Friendship $model */
        /** @var Photo $photoAvatar */
        return $this->render('index', [
            'confirmedDataProvider' => $confirmedDataProvider,
            'requestsDataProvider' => $friendRequestDataProvider,


        ]);
    }

    /**
     * Displays a single Friendship model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRequest()
    {
        $user = Yii::$app->user->identity;

        $friendRequestDataProvider = new ActiveDataProvider();
        $friendRequestDataProvider->query = Friendship::find()
            ->forUserId($user->getId())
            ->waiting();


        return $this->render('request', [

            'requestsDataProvider' => $friendRequestDataProvider,
        ]);
    }

    /**
     * Creates a new Friendship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Friendship();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Friendship model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Friendship::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
