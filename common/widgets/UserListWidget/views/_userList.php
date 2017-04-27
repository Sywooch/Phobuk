<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 18:28
 * @var $dispalayedUser \common\models\User
 * @var $currentUserId
 * @var $isCurrentUser
 * @var $currentUserFriendship \common\models\Friendship
 */
use common\widgets\CameraBrandListWidget\CameraBrandListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>

<?php


?>


<div class="col-xs-12 col-sm-8 col-sm-offset-1 col-md-5 col-md-offset-1">
    <div class="row thumbnail">
        <div class="col-sm-3">
            <?= Html::img('/' . $dispalayedUser->photoAvatar->photo, ['class' => ' img-responsive avatar-listFriend ']); ?>
        </div>

        <div class="col-sm-9">

            <div class=" title">
                <h3><?= Html::a($dispalayedUser->getFullName(), ['/profile', 'id' => $dispalayedUser->getId()]) ?></h3>
            </div>
            <?= $dispalayedUser->getUsername() . ' ' ?>
            <?= FA::icon('home') . ' ' . $dispalayedUser->city->name ?>
            <?= FA::icon('signal') . ' ' . $dispalayedUser->getLevelLabel() ?>
            <div class="row"><?= CameraBrandListWidget::widget(['id' => $dispalayedUser->getId()]) ?> </div>

            <?php if ($model->tableName() == 'friendship') {

                if ($user == $currentUserId) { ?>

                    <?= FA::icon('calendar') . ' Znajomość od: ' . Yii::$app->formatter->asDate($model->created_at) ?>


                <?php }
            } ?>
            <?php if (!$isCurrentUser) { ?>

                <?php
                if (!$currentUserFriendship) { ?>
                    <?= Html::a('Dodaj do znajomych', ['friendship/invite', 'id' => $dispalayedUser->getId()], ['class' => 'btn btn-primary btn-color btn-sm']) ?>
                <?php } else if ($currentUserFriendship->isConfirmed()) { ?>
                    <?= Html::a('Usuń znajomość', ['friendship/remove', 'id' => $dispalayedUser->getId()], ['class' => 'btn btn-primary btn-color btn-sm']) ?>

                <?php } else if ($currentUserFriendship->isInvited($dispalayedUser->id)) { ?>
                    <p> Oczekuje na potwierdzenie
                        <?= Html::a('Cofnij zaproszenie', ['friendship/revert-invite', 'id' => $dispalayedUser->getId()], ['class' => 'btn btn-primary btn-color btn-sm']) ?>
                    </p>
                <?php } else { ?>
                    <?= Html::a('Potwierdz', ['friendship/confirm-invite', 'id' => $dispalayedUser->getId()], ['class' => 'btn btn-primary btn-color btn-sm']) ?>
                    <?= Html::a('Odrzuć', ['friendship/reject', 'id' => $dispalayedUser->getId()], ['class' => 'btn btn-primary btn-color btn-sm']) ?>

                <?php }
            } ?>
        </div>
    </div>

</div>



