<?php

use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $galleryListDataProvider yii\data\ActiveDataProvider */


$this->title = 'Galerie';
?>
<div class="gallery-index">

    <div class="col-xs-12">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>

        </div>
    </div>


    <div class="col-xs-12 padding-phone-fix">
        <div class="container padding-phone-fix">
            <?= ListView::widget([
                'dataProvider' => $galleryListDataProvider,
                'itemView' => '_galleryList',
                'summary' => '',
                'itemOptions' => ['class' => 'item'],
                'id' => 'gallery-listview-id',
                'layout' => '<div class="container padding-phone-fix">{items}</div> <div class="pager-margin">{pager}{summary}</div>',
                'pager' => [
                    'class' => ScrollPager::className(),
                    'triggerText' => 'Pokaż więcej',
                    'enabledExtensions' => [ScrollPager::EXTENSION_TRIGGER],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
