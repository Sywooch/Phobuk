<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 03.05.17
 * Time: 09:20
 * /* @var $model common\models\Event
 */

use common\models\EventHasUser;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$userList = new ActiveDataProvider();
$userList->query = EventHasUser::find()
    ->forEvent($model->id);

$userConfirmedList = new ActiveDataProvider();
$userConfirmedList->query = EventHasUser::find()
    ->forEvent($model->id)
    ->confirmed();
$isParticipant = EventHasUser::find()
    ->forEvent($model->id)
    ->forUser(Yii::$app->user->getId())
    ->one();

$daysToEvent = null;
$currentDate = new DateTime('now');
$eventDate = new DateTime(Yii::$app->formatter->asDate($model->date));
$interval = date_diff($currentDate, $eventDate);
if ($interval->days == 0) {
    $daysToEvent = 'Wydarzenie jest dzisiaj';
} elseif ($currentDate < $eventDate) {
    $daysToEvent = 'Wydarzenie odbędzie się za ' . $interval->days . ' dni';
} else($currentDate > $eventDate){
$daysToEvent = 'Wydarzenie minione'

}
?>

<div class="event-view">
    <div class="col-sm-8 col-sm-offset-2 thumbnail thumbnail-color">
        <div class="title">
            <h1 style="text-align: center"><?= Html::a($model->title, ['/event/view', 'id' => $model->id]) ?></h1>
        </div>

        <div style=" padding-bottom: 15px">
            <div class="col-xs-12 col-md-5 col-md-offset-4">
                <div class="row">
                    <h4>Kiedy: <?= FA::icon('calendar') . ' ' . Yii::$app->formatter->asDate($model->date) ?></h4>
                    <p style="font-style: italic"> <?= $daysToEvent ?></p>
                </div>
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
            <p>Ilość uczestników:
                <?= $userConfirmedList->count ?></p>

            <p>Ilość zaproszonych osób:
                <?= $userList->count ?></p>
        </div>


    </div>

</div>

