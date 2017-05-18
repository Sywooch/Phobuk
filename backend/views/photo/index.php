<?php

use common\models\Photo;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zdjęcia';

?>
<div class="photo-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'photo',
            'title',
            [
                'attribute' => 'user_id',
                'value' => function (Photo $model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function (Photo $model) {
                    return $model->category->name;
                }
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
