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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


</div>
<div class="container ">
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