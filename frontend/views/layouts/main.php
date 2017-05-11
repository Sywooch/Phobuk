<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var Friendship $model */


use common\models\Friendship;
use common\widgets\InvitationButton\InvitationButton;
use frontend\assets\AppAsset;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => ' navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => FA::icon('home') . ' Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Rejestracja', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Logowanie', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => FA::icon('user') . ' Profil', 'url' => ['/profile', 'id' => Yii::$app->user->getId()]];
            $menuItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'items' => $menuItems,
        ]);
        if (!Yii::$app->user->isGuest) {
            echo InvitationButton::widget();
        }
        NavBar::end(); ?>

        <div class="all-content container ">
            <section>
                <div id="modal-placeholder"></div>
                <?= $content ?>
                <?php if (!Yii::$app->user->isGuest) { ?>

                    <span id="menu-toggle" class="">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                    <div class="left-menu" id="left-menu">

                        <div class="left-menu-ul">
                            <p> <?= Html::a(FA::icon('user') . ' Moi znajomi', ['/friendship/', 'id' => Yii::$app->user->identity->getId()]) ?></p>
                            <p><a href="/event"><?= FA::icon('calendar') ?> Wydarzenia</a></p>
                            <p><a href="/gallery"><?= FA::icon('camera') ?> Galerie</a></p>
                            <br>
                            <p> <?= Html::a(FA::icon('picture-o') . ' Dodaj zdjęcie', ['/photo/create'], [
                                    'id' => 'create-new-photo-btn']) ?></p>
                            <p><?= Html::a(FA::icon('newspaper-o') . ' Dodaj post', ['/post/create'], [
                                    'id' => 'create-new-post-btn']) ?></p>
                            <p><?= Html::a(FA::icon('calendar-o') . ' Dodaj wydarzenie', ['/event/create'], [
                                    'id' => 'create-new-event-btn']) ?></p>
                            <p><?= Html::a(FA::icon('camera-retro') . ' Dodaj galerię', ['/gallery/create'], [
                                    'id' => 'create-new-gallery-btn']) ?></p>

                        </div>

                    </div>
                <?php } ?>
            </section>
        </div>
    </div>


    <footer class="footer">
        <div class="container-fuid">
            <p class="pull-right">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>