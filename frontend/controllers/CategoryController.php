<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\CategorySearch;
use common\models\Photo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $photoDataProvider = new ActiveDataProvider();
        $photoDataProvider->query = Photo::find()
            ->where('category_id = :categoryId', [
                'categoryId' => $id])
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);


        $rawSQL = "SELECT * from (select 'photo' as 'type', p.id, photo, title,'' as 'text', user_id, created_at, category_id from photo p 
UNION select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at,post_has_category.category_id from post d 
JOIN post_has_category on post_has_category.post_id = d.id) phopost 
WHERE category_id =$id ORDER BY created_at DESC";

        $countSQL = "SELECT count(*) from (select 'photo' as 'type', p.id, photo, title,'' as 'text', user_id, created_at, category_id from photo p 
UNION select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at,post_has_category.category_id from post d 
JOIN post_has_category on post_has_category.post_id = d.id) phopost 
WHERE category_id =$id ORDER BY created_at DESC";

        $count = Yii::$app->db->createCommand($countSQL)->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => $rawSQL,
            'totalCount' => $count
        ]);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'photoDataProvider' => $photoDataProvider,
            'dataProvider' => $dataProvider,
        ]);
    }
//
//select * from (select 'photo' as 'type', p.id, photo, title,'', user_id, created_at from photo p
//UNION select 'post' as 'type', d.id, photo.photo, d.title, text, d.user_id, d.created_at from post d
//join photo on photo.user_id = d.user_id) phopost
//WHERE user_id = 1 ORDER BY created_at
    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}