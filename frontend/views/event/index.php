<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventSearch */
/* @var $eventList yii\data\ActiveDataProvider */
/* @var $model common\models\Event */

$this->title = 'Wydarzenia';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="event-index">

    <div class="title">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

    <div class="container">
    <div class="row">

        <?= ListView::widget([
            'dataProvider' => $eventList,
            'itemView' => '_eventList',
            'viewParams' => [],
            'summary' => '',
        ]);
        ?>
    </div>
</div>
</div>

