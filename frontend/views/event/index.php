<?php

use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $eventList yii\data\ActiveDataProvider */
/* @var $model common\models\Event */

$this->title = 'Wydarzenia';
?>

<div class="event-index">

    <div class="title">
    <h1><?= Html::encode($this->title) ?></h1>
</div>


    <div class="col-xs-12">
        <div class="container">
            <?= ListView::widget([
                'dataProvider' => $eventList,
                'itemView' => '_eventList',
                'summary' => '',
                'itemOptions' => ['class' => 'item'],
                'id' => 'event-listview-id',
                'layout' => '<div class="container">{items}</div> <div class="pager-margin">{pager}{summary}</div>',
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

