<?php
namespace common\widgets\PhotoPostItemWidget;

use common\models\PhotoComment;
use common\models\PhotoLike;
use common\models\PostComment;
use common\models\PostHasCategory;
use common\models\PostLike;
use Yii;
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
        $path = '/photo/like';
        $postHasCategory = new ActiveDataProvider();
        $postHasCategory->query = PostHasCategory::find()
            ->where('post_id = :postId', [
                'postId' => $this->model['id']
            ]);
        $commentDataProvider = new ActiveDataProvider();
        $currentLikes = new ActiveDataProvider();
        $user = Yii::$app->user->getId();

        if ($this->model['type'] == 'photo') {
            $commentDataProvider->query = PhotoComment::find()
                ->where('photo_id = :id', [
                    'id' => $this->model['id']
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);

            $currentLikes->query = PhotoLike::find()
                ->where('photo_id = :id', [
                    'id' => $this->model['id']
                ]);
            if (!PhotoLike::currentUserLike($this->model['id'], $user)) {
                $status = PhotoLike::NonLikeStatus();
            } else {
                $status = PhotoLike::LikeAcceptStatus();
            }

        } else {
            $path = '/post/like';
            $commentDataProvider->query = PostComment::find()
                ->where('post_id = :id', [
                    'id' => $this->model['id']
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ]);

            $currentLikes->query = PostLike::find()
                ->where('post_id = :id', [
                    'id' => $this->model['id']
                ]);
            if (!PostLike::currentUserLike($this->model['id'], $user)) {
                $status = PostLike::NonLikeStatus();
            } else {
                $status = PostLike::LikeAcceptStatus();
            }
        }

        return $this->render('_photoItem', [
            'model' => $this->model,
            'postHasCategory' => $postHasCategory,
            'commentDataProvider' => $commentDataProvider,
            'currentLikes' => $currentLikes,
            'status' => $status,
            'path' => $path,

        ]);
    }

}