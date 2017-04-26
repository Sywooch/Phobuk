<?php
namespace common\widgets\PhotoPostItemWidget;

use common\models\PhotoComment;
use common\models\PostComment;
use common\models\PostHasCategory;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 19.04.17
 * Time: 18:47
 */
class PhotoPostItemWidget extends Widget {

    public $model;

    public function init() {
        parent::init();
    }

    public function run() {
        $postHasCategory = new ActiveDataProvider();
        $postHasCategory->query = PostHasCategory::find()
            ->where('post_id = :postId', [
                'postId' => $this->model['id']
            ]);
        $commentDataProvider = new ActiveDataProvider();
        if ($this->model['type'] == 'photo') {
            $commentDataProvider->query = PhotoComment::find()
                ->where('photo_id = :id', [
                    'id' => $this->model['id']
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);
        } else {
            $commentDataProvider->query = PostComment::find()
                ->where('post_id = :id', [
                    'id' => $this->model['id']
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);
        }

        return $this->render('_photoItem', [
            'model' => $this->model,
            'postHasCategory' => $postHasCategory,
            'commentDataProvider' => $commentDataProvider,

        ]);
    }

}