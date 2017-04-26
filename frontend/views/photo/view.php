<?php

use common\models\Photo;
use common\widgets\CommentsListWidget\CommentsListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $photoComment common\models\PhotoComment */
/* @var $model common\models\Photo */
/* @var $commentDataProvider */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Zdjęcia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-view">
    <div class="col-sm-8 col-sm-offset-2 thumbnail">
    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>


        <div style="text-align: center">


        <?= FA::icon('calendar'); ?>
        <?= Yii::$app->formatter->asDatetime($model->created_at) ?>

        <?= Html::a(FA::icon('user') . ' ' . $model->user->username, ['/profile/', 'id' => $model->user->getId()], [
            'class' => 'btn btn-default btn-sm'
        ]) ?>

        <?= Html::a('#' . $model->category->name, ['/category/view', 'id' => $model->category->id], [
            'class' => 'btn btn-default btn-sm'
        ]) ?>
            <?= Html::a(FA::icon('comment') . ' ' . $commentDataProvider->count, ['/photo/view', 'id' => $model->id], [
                'class' => 'btn btn-default btn-sm'
            ]) ?>

        <?php if (Yii::$app->user->identity->getId() == $model->user->id) { ?>
            <div class="btn-group pull-right" role="group">
                <?= Html::a(FA::icon('pencil') . ' Edytuj', ['/photo/update', 'id' => $model->id], [
                    'class' => 'btn btn-default btn-sm'
                ]) ?>
                <?= Html::a(FA::icon('trash') . ' Usuń', ['delete', 'id' => $model->id],
                    ['class' => 'btn btn-default btn-sm', 'data' => [
                        'confirm' => 'Jesteś pewien, że chcesz usunąć to zdjęcie?',
                        'method' => 'post',
                    ],
                    ]) ?>

            </div>
        <?php } ?>
    </div>
    <br>
        <?= Html::img('/' . $model->photo, ['class' => 'center-block img-fluid img-responsive img-center']); ?>
        <br>


        <?= CommentsListWidget::widget([
            'model' => $model,
            'commentDataProvider' => $commentDataProvider]) ?>
</div>
</div>

