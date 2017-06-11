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
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix">
        <div class="card">

            <div class="title">
                <h2><?= Html::a($model->title, ['/event/view', 'id' => $model->id]) ?></h2>
            </div>

            <div class="row">
                <div class="center">
                    <div class="col-xs-12 ">
                        <h4>Kiedy: <?= FA::icon('calendar') . ' ' . Yii::$app->formatter->asDate($model->date) ?></h4>
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
                    <p>Ilość uczestników:
                        <?= $userConfirmedList->count ?></p>

                    <p>Ilość zaproszonych osób:
                        <?= $userList->count ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

