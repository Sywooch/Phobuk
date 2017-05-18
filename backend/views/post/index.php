<?php

use common\models\Post;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posty';

?>
<div class="post-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'text:ntext',
            [
                'attribute' => 'user_id',
                'value' => function (Post $model) {
                    return $model->user->getFullName();
                }
            ],
            'photo_id',
            'created_at',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>