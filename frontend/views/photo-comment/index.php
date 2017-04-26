<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PhotoCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photo Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text:ntext',
            'created_at',
            'user_id',
            'photo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
