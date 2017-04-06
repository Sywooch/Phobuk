<?php

use common\models\Friendship;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FriendshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Friendships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Friendship', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'friend_one',
                'value' => function (Friendship $model) {
                    return $model->friendOne->username;
                }
            ],
            [
                'attribute' => 'friend_two',
                'value' => function (Friendship $model) {
                    return $model->friendTwo->username;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Friendship $model) {
                    return $model->showStatusLabel();
                }
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
