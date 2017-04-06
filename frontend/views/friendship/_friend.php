<?php
use common\models\Friendship;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 31.03.17
 * Time: 13:56
 */
/** @var Friendship $model */
/* @var $avatar \common\models\Photo */
/** @var \common\models\Photo $modelPhoto */


?>




<?php
$currentUser = Yii::$app->user->identity;

$myFriend = $currentUser->id == $model->friend_one ? $model->friendTwo : $model->friendOne;
?>


<div class="col-sm-6">
    <div class="row thumbnail">
        <div class="col-sm-3">
            <?= Html::img('/' . $myFriend->photoAvatar->photo, ['class' => ' img-responsive avatar-listFriend']); ?>
        </div>

        <div class="col-sm-9">

            <div class="row" style="margin-bottom: 0%">
                <h3><?= $myFriend->getFullName(); ?> </h3>
            </div>
            <div class="row" style="margin-bottom: 0%">
                <?= $myFriend->getUsername(); ?>
            </div>
            <div class="row" style="margin-bottom: 0%">
                <?= FA::icon('home'); ?>
                <?= $myFriend->city->name ?>
            </div>
            <div class="row" style="margin-bottom: 0%">
                <?= FA::icon('signal') ?>
                <?= $myFriend->getLevelLabel() ?>
            </div>
            <div class="row">
                <?= FA::icon('calendar'); ?>
                <?= Yii::$app->formatter->asDate($model->created_at);
                ?>
            </div>

        </div>
    </div>

</div>
