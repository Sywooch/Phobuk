<?php
namespace common\widgets\CommentsListWidget;

use common\models\PhotoComment;
use common\models\PostComment;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 26.04.17
 * Time: 16:56
 */
class CommentsListWidget extends Widget {
    public $model;
    public $commentDataProvider;


    public function init() {
        parent::init();
    }

    public function run() {

        if ($this->model->tableName() == 'photo') {
            $pathText = '/photo-comment/delete';
            $commentCreateModel = new PhotoComment();
            $commentCreateModelPath = '/photo-comment/create';
            $commentCreatePath = 'photoComment';
        } else {
            $pathText = '/post-comment/delete';
            $commentCreateModel = new PostComment();
            $commentCreateModelPath = '/post-comment/create';
            $commentCreatePath = 'postComment';
        }

        return $this->render('_commentsListWidget', [
            'model' => $this->model,
            'commentDataProvider' => $this->commentDataProvider,
            'pathText' => $pathText,
            'commentCreateModel' => $commentCreateModel,
            'commentCreatePath' => $commentCreatePath,
            'commentCreateModelPath' => $commentCreateModelPath

        ]);
    }
}