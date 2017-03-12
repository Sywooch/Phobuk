<?php
/* @var $this yii\web\View
 *
 * @var $user \common\models\User
 * @var $city \common\models\City
 * @var $isCurrentUser bool
 * @var $count
 * rmrevin\yii\fontawesome\AssetBundle::register($this);
 */
use rmrevin\yii\fontawesome\FA;

$this->title = $user->getFullName();
?>
<div class="backgroung-top">
    <div class="container padding-wrapper-fix ">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 col-sm-offset-3 col-md-offset-3  ">
                <p>Tu jest piękne zdjęcie profilowe</p>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-3 ">
                <div class="row">
                    <h3><?= $user->getFullName() ?></h3>
                </div>
                <div class="row">
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
            </div>


            <div class="col-xs-4 col-sm-3 col-md-3 ">
                <p>3tu jest tekst</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h1><?= $user->username ?></h1>
    <h1><?= $city->name ?></h1>


</div>

