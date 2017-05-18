<?php

use common\models\Gallery;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galerie';

?>
<div class="gallery-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type',
                'value' => function (Gallery $model) {
                    return $model->showStatusLabel();
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function (Gallery $model) {
                    return $model->user->getFullName();
                }
            ],
            'title',
            'created_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
