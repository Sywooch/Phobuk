<?php

/* @var $this yii\web\View */
use kop\y2sp\ScrollPager;
use yii\web\View;
use yii\widgets\ListView;


/* @var $photoFriendProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;

?>
<div class="site-index">

    <div class="col-xs-12 ">
        <div class="container">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_friend_photo',
                'summary' => '',
                'itemOptions' => ['class' => 'item'],
                'id' => 'site-listview-id',
                'layout' => '<div class="container">{items}</div> <div class="pager-margin">{pager}{summary}</div>',
                'pager' => [
                    'class' => \kop\y2sp\ScrollPager::className(),
                    'triggerText' => 'Pokaż więcej',
                    'enabledExtensions' => [ScrollPager::EXTENSION_TRIGGER],
                ],
            ]);
            ?>
        </div>
    </div>

</div>