<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 12.06.17
 * Time: 15:40
 * @var $model \common\models\Photo
 * @var $photosProvider \yii\data\ActiveDataProvider
 */
use yii\helpers\Html;


$i = 0;
foreach ($photosProvider->models as $photo) { ?>
    <div class="col-xs-12 col-sm-6 col-md-4 padding-wrapper-fix gall-img" data-toggle="modal"
         data-target="#myModal<?= $model->id ?>">
        <a href="#myCarousel<?= $model->id ?>" data-slide-to="<?= $i ?>">
            <?php
            echo Html::img('/' . $photo->photo, ['class' => 'img-gallery']);
            $i++;
            ?>
        </a>
    </div>
<?php } ?>

<div class="modal fade" id="myModal<?= $model->id ?>">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <div class="title">
                    <h3><?= $model->title ?></h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" title="Zamknij"><span
                        class="glyphicon glyphicon-remove"></span></button>
            </div>

            <div class="clearfix"></div>

            <div class="modal-body">
                <div id="myCarousel<?= $model->id ?>" class="carousel slide" data-interval="false">

                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($photosProvider->models as $photo) {
                            if ($i == 0) { ?>

                                <div class="item active">
                                    <?php
                                    $first = $photosProvider->models[0];
                                    echo Html::img('/' . $first->photo, ['class' => 'img-responsive', 'alt' => 'item' . $i]);
                                    ?>
                                </div>

                            <?php } else { ?>

                                <div class="item">
                                    <?= Html::img('/' . $photo->photo, ['class' => 'img-responsive', 'alt' => 'item' . $i]) ?>
                                </div>

                            <?php }
                            $i++;
                        } ?>
                    </div>

                    <a class="left carousel-control" href="#myCarousel<?= $model->id ?>" role="button"
                       data-slide="prev"> <span
                            class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#myCarousel<?= $model->id ?>" role="button"
                       data-slide="next"> <span
                            class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-sm close" type="button" data-dismiss="modal">Zamknij</button>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
