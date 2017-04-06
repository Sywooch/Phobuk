<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Friendship */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Friendships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'friend_one',
                'value' => function (Friendship $model) {
                    return $model->friendOne->username;
                }
            ],
            [
                'label' => 'friend_two',
                'value' => $model->friendTwo->username,
            ],
            [
                'label' => 'status',
                'value' => $model->showStatusLabel(),
            ],
            'created_at',
        ],
    ]) ?>

</div>
