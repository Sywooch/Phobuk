<?php

use common\models\PostComment;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Komentarze do postów';

?>
<div class="post-comment-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text:ntext',
            'created_at',
            [
                'attribute' => 'user_id',
                'value' => function (PostComment $model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'attribute' => 'post_id',
                'value' => function (PostComment $model) {
                    return $model->post->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
