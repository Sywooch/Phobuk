<?php

use common\widgets\UserEventList\UserEventListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\web\View;
use yii2mod\google\maps\markers\GoogleMaps;

/* @var $this yii\web\View */
/* @var $userRequestList \common\models\EventHasUser */
/* @var  $userConfirmedList \common\models\EventHasUser */
/* @var $model common\models\Event
 * @var $isParticipant
 */

$this->title = $model->title;

$id = $model->id;
$js = <<<JS
   $(document).on('click', '#update-event-btn', function() {
    $.ajax({
        url: "/event/update?id=" + $id,
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#modal-placeholder').html(data);
            $('#update-event-modal').modal('toggle');
        }
    });

    return false;
});
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="event-view container">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix">
        <div class="card">
            <div id="modal-placeholder"></div>
            <div class="col-xs-12 ">
                <div class="title  ">
                    <h2><?= 'Wydarzenie: ' . Html::encode($this->title) ?></h2>
                </div>
            </div>


            <div class="col-xs-12">
                <?php if (Yii::$app->user->identity->getId() == $model->organizer) { ?>
                    <div class="btn-group pull-right" role="group">
                        <?= Html::a(FA::icon('pencil') . ' Edytuj', ['update', 'id' => $model->id], [
                            'id' => 'update-event-btn',
                            'class' => 'btn btn-default btn-sm'
                        ]) ?>
                        <?= Html::a(FA::icon('trash') . ' Usuń', ['delete', 'id' => $model->id],
                            ['class' => 'btn btn-default btn-sm', 'data' => [
                                'confirm' => 'Jesteś pewien, że chcesz usunąć to wydarzenie?',
                                'method' => 'post',
                            ],
                            ]) ?>
                    </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="center">
                    <div class="col-xs-12">
                        <h4>
                            Kiedy: <?= FA::icon('calendar') . ' ' . $model->date ?></h4>
                        <div class="event-italic-text"> <?= $daysToEvent ?></div>
                        <h4>Gdzie: <?= FA::icon('map-marker') . ' ' . $model->city->name ?></h4>
                        <h4> Organizator:
                            <?= Html::a(FA::icon('user') . ' ' . $model->eventOrganizer->getFullName(), ['/profile/', 'id' => $model->organizer], [
                                'class' => 'btn btn-default btn-sm'
                            ]) ?></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?= $model->text ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $cityName = $model->city->name;
                    echo GoogleMaps::widget([
                        'wrapperHeight' => '300px',
                        'userLocations' => [
                            [
                                'location' => [
                                    'city' => $cityName,
                                    'country' => 'Poland',
                                ],
                                'htmlContent' => $cityName,
                            ],
                        ],

                        'googleMapsUrlOptions' => [
                            'key' => 'AIzaSyCpm8_cCBzCECgagIJ8ks2Gr-GvuTyMTu8',
                            'language' => 'pl',
                            'version' => '3.1.18'

                        ],
                        'googleMapsOptions' => [
                            'mapTypeId' => 'roadmap',
                            'maxZoom' => 12,
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <?php
                if (!$isParticipant || $isParticipant->isInvited()) { ?>
                    <div class="pull-right">
                        <?= Html::a(FA::icon('plus') . ' Dołącz do wydarzenia', ['join-to-event', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']) ?>
                    </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-xs-10  col-xs-offset-1">
                    <h4>Zaproszeni na wydarzenie (<?= $userRequestList->count ?>):</h4>
                    <?= UserEventListWidget::widget(['model' => $userRequestList, 'isParticipant' => $isParticipant]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10  col-xs-offset-1">
                    <h4>Biorą udział w wydarzeniu(<?= $userConfirmedList->count ?>):</h4>
                    <?= UserEventListWidget::widget(['model' => $userConfirmedList, 'isParticipant' => $isParticipant]) ?>
                </div>
            </div>

        </div>
    </div>
</div>



