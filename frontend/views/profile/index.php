<?php
/* @var $this yii\web\View
 *
 * @var $user \common\models\User
 * @var $city \common\models\City
 * @var $avatar \common\models\Photo
 * @var $isCurrentUser bool
 * @var $dataProvider
 * @var $friendship \common\models\Friendship
 * rmrevin\yii\fontawesome\AssetBundle::register($this);
 */
use common\widgets\CameraBrandListWidget\CameraBrandListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = $user->getFullName();
?>
<div class="backgroung-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 col-sm-offset-2 col-md-offset-2  ">
                <?php
                if (!$avatar == null) {
                    echo Html::img('/' . $avatar->photo, ['class' => ' img-responsive avatar thumbnail']);
                }
                ?>

            </div>
            <div class="col-xs-4 col-sm-3 col-md-3 " style="margin-left: 5px">
                <h3><?= $user->getFullName() ?></h3>
                <h5><?= $user->getUsername() ?></h5>
                <p>
                    <?= FA::icon('home'); ?>
                    <?= $city->name ?>
                </p>
                <p>
                    <?= FA::icon('signal') ?>
                    <?= $user->getLevelLabel() ?>
                </p>
                <?= CameraBrandListWidget::widget(['id' => $user->getId()]) ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2 ">

                <p>  <?= Html::a('Znajomi', ['/friendship/', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?></p>
                <?php if (Yii::$app->user->identity->getId() == $user->getId()) { ?>
                    <p><?= Html::a('Aktualizuj profil', ['update', 'id' => $user->id], ['class' => 'btn btn-primary btn-color']) ?></p>
                    <p> <?= Html::a('Dodaj zdjęcie', ['/photo/create'], ['class' => 'btn btn-primary btn-color']) ?></p>
                    <p><?= Html::a('Dodaj post', ['/post/create'], ['class' => 'btn btn-primary btn-color']) ?></p>
                <?php }
                if (!$isCurrentUser) {
                    if (!$friendship) {
                        echo Html::a('Dodaj do znajomych', ['friendship/invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']);
                    } else if ($friendship->isConfirmed()) { ?>
                        <p>Jesteśmy znajomymi</p>
                        <?= Html::a('Usun ze znajomych', ['friendship/remove', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php } else if ($friendship->isInvited($user->id)) { ?>
                        <p> Oczekuje na potwierdzenie </p>
                        <?= Html::a('Cofnij zaproszenie', ['friendship/revert-invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php } else { ?>
                        <?= Html::a('Potwierdz', ['friendship/confirm-invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                        <?= Html::a('Odrzuć', ['friendship/reject', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>

<div class="container ">
    <div class="row">

        <?= ListView::widget(['dataProvider' => $dataProvider,
            'itemView' => '_photo',
            'summary' => '',]);
        ?>
    </div>
</div>
