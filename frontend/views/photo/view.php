<?php

use common\models\Photo;
use common\widgets\CommentsListWidget\CommentsListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $photoComment common\models\PhotoComment */
/* @var $model common\models\Photo */
/* @var $commentDataProvider */
$this->title = $model->title;
$id = $model->id;
$js = <<<JS
   $(document).on('click', '#update-photo-btn', function() {
    $.ajax({
        url: "/photo/update?id=" + $id,
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#modal-placeholder').html(data);
            $('#update-photo-modal').modal('toggle');
        }
    });

    return false;
});
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="container padding-phone-fix">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix">
    <div class="card">
        <div id="modal-placeholder"></div>

        <div class="caption">
            <?= Html::img('/' . $model->photo, ['class' => 'center-block img-fluid img-responsive img-center']); ?>
        </div>
        <div class="col-xs-12">
            <?php if (Yii::$app->user->identity->getId() == $model->user->id) { ?>
                <div class="btn-group pull-right" role="group">
                    <?= Html::a(FA::icon('pencil') . ' Edytuj', ['/photo/update', 'id' => $model->id], [
                        'id' => 'update-photo-btn',
                        'class' => 'btn btn-default btn-sm'
                    ]) ?>
                    <?= Html::a(FA::icon('trash') . ' Usuń', ['delete', 'id' => $model->id],
                        ['class' => 'btn btn-default btn-sm', 'data' => [
                            'confirm' => 'Jesteś pewien, że chcesz usunąć to zdjęcie?',
                            'method' => 'post',],
                        ]) ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-xs-12">
            <div class="title">
                <h2><?= Html::encode($this->title) ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-2 col-sm-offset-2">

                <?= Html::img('/' . $model->user->photoAvatar->photo, ['class' => 'img-responsive avatar-small thumbnail']); ?>
            </div>

            <div class="col-xs-8 col-sm-6">

                <?= Html::a(FA::icon('user') . ' ' . $model->user->getFullName(), ['/profile/', 'id' => $model->user->getId()], [
                    'class' => 'btn btn-default btn-sm'
                ]) ?>

                <p>  <?= FA::icon('calendar'); ?>
                    <?= $model->created_at ?>
                </p>

            </div>
        </div>

        <div class="row ">
            <div class="col-xs-12 center">
                <?= Html::a('#' . $model->category->name, ['/category/view', 'id' => $model->category->id], [
                    'class' => 'btn btn-default btn-sm'
                ]) ?>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <?= CommentsListWidget::widget([
                    'model' => $model,
                    'id' => $id]) ?>
            </div>
        </div>
    </div>
</div>

</div>