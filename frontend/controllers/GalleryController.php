<?php

namespace frontend\controllers;

use common\models\Gallery;
use common\models\GallerySearch;
use common\models\Photo;
use common\models\PhotoInGallery;
use frontend\models\PhotoForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller {
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GallerySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Gallery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
//        $photos = new ActiveDataProvider();
//        $photos->query = PhotoInGallery::find()
//            ->where('gallery_id = :id', [
//                'id' => $id]);

        $query = Photo::find()
            ->joinWith('galleries')
            ->where('gallery_id = :id', ['id' => $id]);

        $photosProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'photosProvider' => $photosProvider

        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Gallery();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $photoInGallery = new PhotoInGallery();
                $photoInGallery->savePhotoInGallery($model->id, $model->photos_ids);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }


    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id)->loadPhotos();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $photoInGallery = new PhotoInGallery();
                $photoInGallery->savePhotoInGallery($model->id, $model->photos_ids);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,

        ]);
    }


    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}