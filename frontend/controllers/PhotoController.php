<?php

namespace frontend\controllers;

use common\models\Photo;
use common\models\PhotoLike;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PhotoController implements the CRUD actions for Photo model.
 */
class PhotoController extends Controller {
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
     * Displays a single Photo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    }


    /**
     * Creates a new Photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Photo();
        $model->scenario = Photo::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $model->upload();
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Photo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->scenario = Photo::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $model->upload();
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }


        }
        return $this->renderAjax('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Photo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Photo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Photo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLike($itemId, $itemType) {
        $user = Yii::$app->user->identity->getId();
        $currentLikes = new ActiveDataProvider();

        $currentUserLikes = PhotoLike::currentUserLike($itemId, $user);
        if (!$currentUserLikes) {
            PhotoLike::saveLike($itemId, $user);
            $status = PhotoLike::LikeAcceptStatus();
        } else {
            $currentUserLikes->delete();
            $status = PhotoLike::NonLikeStatus();
        }

        $currentLikes->query = PhotoLike::find()
            ->where('photo_id = :id', [
                'id' => $itemId
            ]);

        $res = [
            'status' => $status,
            'currentLikes' => $currentLikes->count,
            'itemId' => $itemId,
            'it' => $itemType
        ];

        return Json::encode($res);
    }
}
