<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 30.04.17
 * Time: 15:05
 */
/** @var \common\models\EventHasUser $isParticipant */
use common\models\User;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>

<?php
foreach ($model->models as $userList) {
    $user = User::findOne($userList->user_id);
    $isCurrentUser = $userList->user_id == Yii::$app->user->getId() ?>
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row thumbnail">
            <div class="col-sm-4 ">
                <?php if (!$user->avatar == null) {
                    echo Html::img('/' . $user->photoAvatar->photo, ['class' => ' img-responsive avatar-listFriend ']);
                } ?>

            </div>
            <div class="col-sm-8">
                <div class=" title">
                    <h3><?= Html::a($user->getFullName(), ['/profile', 'id' => $user->getId()]) ?></h3>
                </div>
                <?= $user->getUsername() . ' ' ?>
                <?php if (!$user->city_id == null) {
                    echo FA::icon('home') . ' ' . $user->city->name;
                } ?>

                <p>  <?= $userList->showStatusLabel() ?></p>
                <?php
                if ($isCurrentUser) {
                    if ($isParticipant->isConfirmed()) {
                        echo Html::a(FA::icon('minus') . ' Zrezygnuj z udziału', ['remove', 'id' => $userList->event_id], ['class' => 'btn btn-default  btn-sm']);
                    }
                    if ($isParticipant->isInvited()) {
                        echo Html::a(FA::icon('plus') . ' Potwierdź', ['confirm', 'id' => $userList->event_id], ['class' => 'btn btn-default  btn-sm']);
                        echo Html::a(FA::icon('minus') . ' Odrzuć', ['reject', 'id' => $userList->event_id], ['class' => 'btn btn-default  btn-sm']);

                    }
                }
                ?>

            </div>
        </div>
    </div>
<?php } ?>
