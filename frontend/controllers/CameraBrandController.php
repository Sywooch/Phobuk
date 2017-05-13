<?php

namespace frontend\controllers;

use common\models\CameraBrand;
use common\models\UserCamera;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CameraBrandController implements the CRUD actions for CameraBrand model.
 */
class CameraBrandController extends Controller {
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
     * Displays a single CameraBrand model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $query = UserCamera::find()
            ->where('camera_brand_id = :id', [
                'id' => $id
            ]);

        $userCameraBrand = new  ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'userCameraBrand' => $userCameraBrand,
        ]);
    }


    protected function findModel($id) {
        if (($model = CameraBrand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
