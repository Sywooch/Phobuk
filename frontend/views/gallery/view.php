<?php
use common\widgets\GalleryLightbox\GalleryLightboxWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $photosProvider \yii\data\ActiveDataProvider */

$this->title = $model->title;
$id = $model->id;

$js = <<<JS
   $(document).on('click', '#update-gallery-btn', function() {
    $.ajax({
        url: "/gallery/update?id=" + $id,
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#modal-placeholder').html(data);
            $('#update-gallery-modal').modal('toggle');
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

            <div class="col-xs-12">
                <div class="title">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>
            </div>

            <div class="col-xs-12">
                <?php if (Yii::$app->user->identity->getId() == $model->user->id) { ?>
                    <div class="btn-group pull-right" role="group">
                        <?= Html::a(FA::icon('pencil') . ' Edytuj', ['/gallery/update', 'id' => $model->id], [
                            'id' => 'update-gallery-btn',
                            'class' => 'btn btn-default btn-sm'
                        ]) ?>
                        <?= Html::a(FA::icon('trash') . ' Usuń', ['delete', 'id' => $model->id],
                            ['class' => 'btn btn-default btn-sm', 'data' => [
                                'confirm' => 'Jesteś pewien, że chcesz usunąć tą galerię?',
                                'method' => 'post',
                            ],
                            ]) ?>
                    </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-xs-12 center">
                    <?= FA::icon('calendar') . ' ' . $model->created_at ?>

                    <?= Html::a(FA::icon('user') . ' ' . $model->user->username, ['/profile/', 'id' => $model->user->getId()], [
                        'class' => 'btn btn-default btn-sm'
                    ]) ?>


                    <?php if ($model->isPublic()) {
                        echo FA::icon('globe');
                    } else
                        echo FA::icon('user-secret');

                    echo ' ' . $model->showStatusLabel() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <?= GalleryLightboxWidget::widget(['photosProvider' => $photosProvider, 'model' => $model]) ?>
                </div>
            </div>

        </div>
    </div>
</div>