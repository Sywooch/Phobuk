<?php

namespace frontend\controllers;

use common\models\Post;
use common\models\PostHasCategory;
use common\models\PostWithCategories;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller {
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
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $categories = new ActiveDataProvider();
        $categories->query = PostHasCategory::find()
            ->where('post_id = :id', [
                'id' => $id]);

        return $this->render('view', [
            'post' => $this->findModel($id),
            'categories' => $categories,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Post();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (!$model->categories_ids == null) {
                    $postHasCategory = new PostHasCategory();
                    $postHasCategory->savePostHasCategory($model->id, $model->categories_ids);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->renderAjax('create', [
                'model' => $model,

            ]);
        }


    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id)->loadCategories();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (!$model->categories_ids == null) {
                    $postHasCategory = new PostHasCategory();
                    $postHasCategory->savePostHasCategory($model->id, $model->categories_ids);
                } else {
                    PostHasCategory::deleteAll(['post_id' => $id]);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->renderAjax('update', [
                'model' => $model,
            ]);

    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
