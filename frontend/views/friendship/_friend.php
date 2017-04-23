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
/* @var  $user */
/* @var commonFriendDataProvider */
/* @var $avatar \common\models\Photo */
/** @var \common\models\Photo $modelPhoto */


?>


<?php


$currentUserId = Yii::$app->user->identity->getId();
$myFriend = $user == $model->friend_one ? $model->friendTwo : $model->friendOne;


/** @var Friendship $currentUserFriendship */
$currentUserFriendship = Friendship::find()
    ->forUsers($currentUserId, $myFriend->id)
    ->one();

$isCurrentUser = $currentUserId == $myFriend->id;
?>


<div class="col-sm-6">
    <div class="row thumbnail">
        <div class="col-sm-3">
            <?= Html::img('/' . $myFriend->photoAvatar->photo, ['class' => ' img-responsive avatar-listFriend ']); ?>
        </div>

        <div class="col-sm-9">

            <div class="row title" style="margin-bottom: 0%">
                <h3>
                    <?= Html::a($myFriend->getFullName(), ['/profile', 'id' => $myFriend->getId()]) ?></h3>
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
                <?php if ($user == $currentUserId) { ?>
                    <p>
                <?= FA::icon('calendar'); ?>
                        Znajomość od:
                        <?= Yii::$app->formatter->asDate($model->created_at) ?>   </p>
                <?php } ?>
                <?php if (!$isCurrentUser) { ?>

                    <?php
                    if (!$currentUserFriendship) { ?>
                        <?= Html::a('Dodaj do znajomych', ['friendship/invite', 'id' => $myFriend->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php } else if ($currentUserFriendship->isConfirmed()) { ?>
                        <p>Jesteśmy znajomymi</p>
                        <?= Html::a('Usun ze znajomych', ['friendship/remove', 'id' => $myFriend->getId()], ['class' => 'btn btn-primary btn-color']) ?>

                    <?php } else if ($currentUserFriendship->isInvited($myFriend->id)) { ?>
                        <p> Oczekuje na potwierdzenie </p>
                        <?= Html::a('Cofnij zaproszenie', ['friendship/revert-invite', 'id' => $myFriend->getId()], ['class' => 'btn btn-primary btn-color']) ?>

                    <?php } else { ?>
                        <?= Html::a('Potwierdz', ['friendship/confirm-invite', 'id' => $myFriend->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                        <?= Html::a('Odrzuć', ['friendship/reject', 'id' => $myFriend->getId()], ['class' => 'btn btn-primary btn-color']) ?>

                    <?php }
                } ?>
            </div>

        </div>
    </div>

</div>
