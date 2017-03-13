<?php

use common\models\Photo;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Photo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Zdjęcia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-view">

    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <div class="row" style="text-align: center">


        <?= FA::icon('calendar'); ?>
        <?= Yii::$app->formatter->asDatetime($model->created_at) ?>

        <?= Html::a(FA::icon('user') . ' ' . $model->user->username, ['/profile/'], [
            'class' => 'btn btn-default btn-sm'
        ]) ?>

        <?= Html::a('#' . $model->category->name, ['/category/', 'id' => $model->id], [
            'class' => 'btn btn-default btn-sm'
        ]) ?>
        <div class="btn-group pull-right" role="group">
            <?= Html::a(FA::icon('pencil'), ['/photo/update', 'id' => $model->id], [
                'class' => 'btn btn-default btn-sm'
            ]) ?>
            <?= Html::a(FA::icon('trash'), ['delete', 'id' => $model->id],
                ['class' => 'btn btn-default btn-sm', 'data' => [
                    'confirm' => 'Jesteś pewien, że chcesz usunąć to zdjęcie?',
                    'method' => 'post',
                ],
                ]) ?>
        </div>
    </div>
    <br>
    <?= Html::img('/' . $model->photo, ['width' => '50%', 'height' => '50%', 'class' => 'center-block']); ?>


</div>
