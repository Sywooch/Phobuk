<?php
namespace common\widgets\CommentsListWidget;

use common\models\PhotoComment;
use common\models\PostComment;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 26.04.17
 * Time: 16:56
 */
class CommentsListWidget extends Widget {
    public $model;
    public $id;


    public function init() {
        parent::init();
    }

    public function run() {
        $commentDataProvider = new ActiveDataProvider();
        if ($this->model->tableName() == 'photo') {
            $commentDataProvider->query = PhotoComment::find()
                ->where('photo_id = :id', [
                    'id' => $this->id
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);
            $pathText = '/photo-comment/delete';
            $commentCreateModel = new PhotoComment();
            $commentCreateModelPath = '/photo-comment/create';
            $commentCreatePath = 'photoComment';
        } else {
            $commentDataProvider->query = PostComment::find()
                ->where('post_id = :id', [
                    'id' => $this->id
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);
            $pathText = '/post-comment/delete';
            $commentCreateModel = new PostComment();
            $commentCreateModelPath = '/post-comment/create';
            $commentCreatePath = 'postComment';
        }

        return $this->render('_commentsListWidget', [
            'model' => $this->model,
            'id' => $this->id,
            'commentDataProvider' => $commentDataProvider,
            'pathText' => $pathText,
            'commentCreateModel' => $commentCreateModel,
            'commentCreatePath' => $commentCreatePath,
            'commentCreateModelPath' => $commentCreateModelPath

        ]);
    }
}