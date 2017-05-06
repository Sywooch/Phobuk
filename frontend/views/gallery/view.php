<?php

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $photosProvider \yii\data\ActiveDataProvider */
/**/
/* @var $photoForm \frontend\models\PhotoForm */

$this->title = $model->title;

?>
<div class="gallery-view">
    <div class="col-sm-8 col-sm-offset-2 thumbnail thumbnail-color">
        <div id="modal-placeholder"></div>
        <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

        <div style="text-align: center; padding-bottom: 15px">
            <?= FA::icon('calendar'); ?>
            <?= $model->created_at ?>

            <?= Html::a(FA::icon('user') . ' ' . $model->user->username, ['/profile/', 'id' => $model->user->getId()], [
                'class' => 'btn btn-default btn-sm'
            ]) ?>
            <?php if (Yii::$app->user->identity->getId() == $model->user->id) { ?>
                <div class="btn-group pull-right" role="group">
                    <?= Html::a(FA::icon('pencil') . ' Edytuj', ['/gallery/update', 'id' => $model->id], [
                        'id' => 'update-post-btn',
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

        <div class="w2-row" style="text-align: center">
            <?php

            foreach ($photosProvider->models as $photo) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 padding-wrapper-fix gall-img">

                    <?php
                    echo Html::img('/' . $photo->photo, ['class' => 'img-responsive img-gallery', 'alt' => $photo->title, 'data-toggle' => 'modal', 'data-target' => '#exampleModalLong']);
                    ?>
                </div>
            <?php } ?>
        </div>
        <?php

        $items = [];

        foreach ($photosProvider->models as $photo) {
            $items[] =
                [
                    'content' => Html::img('/' . $photo->photo, ['class' => 'img-responsive img-gallery', 'title' => $photo->title]),
                    'caption' => $photo->title
                ];
        }
        ?>

    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">

                    <?php echo Carousel::widget([

                        'options' => [
                            'class' => 'slide, carousel-inner',
                            'data-interval' => true,
                            'id' => 'modalCarousel',


                        ],
                        'items' => $items,

                    ]); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

