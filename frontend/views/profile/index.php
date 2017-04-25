<?php
/* @var $this yii\web\View
 *
 * @var $user \common\models\User
 * @var $city \common\models\City
 * @var $avatar \common\models\Photo
 * @var $isCurrentUser bool
 * @var $count
 * @var $photoDataProvider
 * @var $confirmedFriendDataProvider
 * @var $friendship \common\models\Friendship
 * rmrevin\yii\fontawesome\AssetBundle::register($this);
 */
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = $user->getFullName();
?>
<div class="backgroung-top">
    <div class="container padding-wrapper-fix ">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 col-sm-offset-3 col-md-offset-3  ">
                <?= Html::img('/' . $avatar->photo, ['class' => ' img-responsive avatar thumbnail']); ?>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-3 ">
                <div class="row" style="margin-bottom: 0%">
                    <h3><?= $user->getFullName() ?></h3>
                </div>
                <div class="row" style="margin-bottom: 0%">
                    <h5><?= $user->getUsername() ?></h5>
                </div>
                <div class="row">
                    <?= FA::icon('home'); ?>
                    <?= $city->name ?>
                </div>
                <div class="row">
                    <?= FA::icon('signal') ?>
                    <?= $user->getLevelLabel() ?>
                </div>
                <div class="row">
                    <p> <?= FA::icon('photo') ?>
                        Ilość zdjęć:
                        <?= $count ?> </p>

                </div>
            </div>


            <div class="col-xs-4 col-sm-3 col-md-3 ">
                <div class="row">
                    <?= Html::a('Znajomi', ['/friendship/', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                </div>
                <?php if (Yii::$app->user->identity->getId() == $user->getId()) { ?>


                    <div class="row">
                        <?= Html::a('Aktualizuj profil', ['update', 'id' => $user->id], ['class' => 'btn btn-primary btn-color']) ?>
                    </div>
                    <div class="row">
                        <?= Html::a('Dodaj zdjęcie', ['/photo/create'], ['class' => 'btn btn-primary btn-color']) ?>
                    </div>
                    <div class="row">
                        <?= Html::a('Dodaj post', ['/post/create'], ['class' => 'btn btn-primary btn-color']) ?>
                    </div>
                <?php } ?>
                <?php if (!$isCurrentUser) { ?>

                    <?php
                    if (!$friendship) { ?>
                        <?= Html::a('Dodaj do znajomych', ['friendship/invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php } else if ($friendship->isConfirmed()) { ?>
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
