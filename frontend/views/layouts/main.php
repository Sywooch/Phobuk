<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);


    $menuItems = [
        ['label' => FA::icon('home') . ' Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => FA::icon('user') . ' Profil', 'url' => ['/profile', 'id' => Yii::$app->user->getId()]];
        //   $menuItems[] = ['label' => FA::icon('camera-retro') . ' Zdjęcia', 'url' => ['/photo']];
        // $menuItems[] = ['label' => FA::icon('camera') . ' Galerie', 'url' => ['/gallery']];
        //$menuItems[] = ['label' => FA::icon('newspaper-o') . ' Posty', 'url' => ['/post']];
        //$menuItems[] = ['label' => FA::icon('calendar') . ' Wydarzenia', 'url' => ['/event']];
        //$menuItems[] = ['label' => FA::icon('user-o') . ' Znajomi', 'url' => ['/friendship']];
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
    NavBar::end();
    ?>
    <div class="row padding-wrapper-fix">

        <div class="aside">
            <ul>
                <p><a href="/site/index"><?= FA::icon('home') ?> Strona główna</a></p>
                <p><a href="/friendship"><?= FA::icon('user') ?> Znajomi</a></p>
                <p><a href="/photo"><?= FA::icon('camera-retro') ?> Zdjęcia</a></p>
                <p><a href="/gallery"><?= FA::icon('camera') ?> Galerie</a></p>
                <p><a href="/post"><?= FA::icon('newspaper-o') ?> Posty</a></p>
                <p><a href="/event"><?= FA::icon('calendar') ?> Wydarzenia</a></p>
            </ul>

        </div>
        <div class="all-content container ">
            <section class="">
                <?= $content ?>
            </section>
        </div>
    </div>


    <footer class="footer">
        <div class="container">
            <p class="pull-right">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
