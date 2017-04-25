<?php
namespace common\widgets\PhotoItemWidget;

use common\models\PostHasCategory;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 19.04.17
 * Time: 18:47
 */
class PhotoItemWidget extends Widget {

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
        return $this->render('_photoItem', [
            'model' => $this->model,
            'postHasCategory' => $postHasCategory,

        ]);
    }

}