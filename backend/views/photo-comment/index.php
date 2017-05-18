<?php

use common\models\PhotoComment;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PhotoCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Komentarze do zdjęć';

?>
<div class="photo-comment-index">


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
                'value' => function (PhotoComment $model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'attribute' => 'photo_id',
                'value' => function (PhotoComment $model) {
                    return $model->photo->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
