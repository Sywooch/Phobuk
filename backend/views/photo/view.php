<?php

use common\models\Photo;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Photo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Zdjęcia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aktualizuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Jesteś pewien, że chcesz usunąć to zdjęcie?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img('/' . $model->photo, ['width' => '50%', 'height' => '50%', 'align' => 'center']);
                }
            ],
            'title',
            [
                'attribute' => 'user_id',
                'value' => function (Photo $model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function (Photo $model) {
                    return $model->category->name;
                }
            ],
            'created_at',
            'update_at',
        ],
    ]) ?>
</div>
