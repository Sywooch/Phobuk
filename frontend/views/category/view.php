<?php

use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $photoDataProvider \yii\data\ActiveDataProvider */

$this->title = $model->name;

?>
<div class="category-view">
    <div class="center">
    <h1>Kategoria: #<?= Html::encode($this->title) ?></h1>
    </div>


    <div class="col-xs-12">

        <div class="container">

            <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_form',
            'summary' => '',
                'itemOptions' => ['class' => 'item'],
                'id' => 'category-listview-id',
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