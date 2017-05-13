<?php

use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $model common\models\CameraBrand */
/* @var $userCameraBrand */

$this->title = $model->name;

?>
<div class="camera-brand-view">
    <div class="center">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="col-xs-12">

        <div class="container">

            <?= ListView::widget([
            'dataProvider' => $userCameraBrand,
            'itemView' => '_form',
            'summary' => '',
                'viewParams' => ['userCameraBrand' => $userCameraBrand],
                'itemOptions' => ['class' => 'item'],
                'id' => 'camera-brand-listview-id',
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