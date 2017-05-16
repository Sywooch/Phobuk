<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 16.05.17
 * Time: 11:56
 * @var $model
 */


use common\models\Event;
use common\models\User;
use yii\helpers\Html;

if ($model['type'] == 'friendship') {
    $modelPathId = $model['friend_one'];
    $query = User::findOne($modelPathId);
    $title = $query->getFullName();
    $modelPath = '/profile';
    $confirmPath = 'friendship/confirm-invite';
    $rejectPath = 'friendship/reject';
} else {
    $modelPathId = $model['event_id'];
    $query = Event::findOne($modelPathId);
    $title = 'Wydarzenie: ' . $query->title;
    $modelPath = '/event/view';
    $confirmPath = 'event/confirm';
    $rejectPath = 'event/reject';
}
?>
<div class="row">
    <div class="col-xs-12 dropdown-messages-text">
        <p><?= Html::a($title, [$modelPath, 'id' => $modelPathId]) ?></p>
        <p><?= $model['created_at'] ?></p>

    </div>
    <div class="col-xs-6">
        <?= Html::a('Potwierdź', [$confirmPath, 'id' => $modelPathId], ['class' => 'btn btn-primary btn-color']); ?>
    </div>
    <div class="col-xs-6">
        <?= Html::a('Odrzuć', [$rejectPath, 'id' => $modelPathId], ['class' => 'btn btn-primary btn-color']); ?>
    </div>
</div>
<div class='divider'></div>
