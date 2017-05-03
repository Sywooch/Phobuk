<?php

use common\widgets\UserEventList\UserEventListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $userRequestList \common\models\EventHasUser */
/* @var  $userConfirmedList \common\models\EventHasUser */
/* @var $model common\models\Event
 * @var $isParticipant
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view" xmlns="http://www.w3.org/1999/html">
    <div class="col-sm-8 col-sm-offset-2 thumbnail thumbnail-color">
        <h1 style="text-align: center"><?= 'Wydarzenie: ' . Html::encode($this->title) ?></h1>


        <div style=" padding-bottom: 15px">
            <div class="col-xs-12 col-md-5 col-md-offset-4">


                <h4>Kiedy: <?= FA::icon('calendar') . ' ' . Yii::$app->formatter->asDate($model->date) ?></h4>
                <p style="font-style: italic"> <?= $daysToEvent ?></p>
                <h4>Gdzie: <?= FA::icon('map-marker') . ' ' . $model->city->name ?></h4>
                <h4> Organizator:
                    <?= Html::a(FA::icon('user') . ' ' . $model->eventOrganizer->getFullName(), ['/profile/', 'id' => $model->organizer], [
                        'class' => 'btn btn-default btn-sm'
                    ]) ?></h4>
            </div>
            <?php if (Yii::$app->user->identity->getId() == $model->organizer) { ?>
                <div class="btn-group pull-right" role="group">
                    <?= Html::a(FA::icon('pencil') . ' Edytuj', ['update', 'id' => $model->id], [
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

        <div class="col-xs-10 col-xs-offset-1">
            <?= $model->text ?>
        </div>
        <?php
        if (!$isParticipant || $isParticipant->isInvited()) { ?>
            <div class="pull-right">
                <?= Html::a(FA::icon('plus') . ' Dołącz do wydarzenia', ['join-to-event', 'id' => $model->id], ['class' => 'btn btn-default  btn-sm']) ?>
            </div>
        <?php } ?>


        <div class="col-xs-10  col-xs-offset-1">
            <h4>Zaproszeni na wydarzenie (<?= $userRequestList->count ?>):</h4>
            <?= UserEventListWidget::widget(['model' => $userRequestList, 'isParticipant' => $isParticipant]) ?>
        </div>
        <div class="col-xs-10  col-xs-offset-1">
            <h4>Biorą udział w wydarzeniu(<?= $userConfirmedList->count ?>):</h4>
            <?= UserEventListWidget::widget(['model' => $userConfirmedList, 'isParticipant' => $isParticipant]) ?>

        </div>

    </div>

</div>
