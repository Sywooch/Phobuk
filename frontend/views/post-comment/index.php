<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post Comment', ['create'], ['class' => 'btn btn-success']) ?>
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
            'post_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
