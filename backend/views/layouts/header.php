<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">PB</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="user-footer">

                            <?= Html::a('Wyloguj się', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>

                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
