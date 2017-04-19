<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $photoDataProvider \yii\data\ActiveDataProvider */

$this->title = $model->name;

?>
<div class="category-view">

    <h1>Kategoria: #<?= Html::encode($this->title) ?></h1>


</div>
<div class="container ">
    <div class="row">

        <?= ListView::widget([
            'dataProvider' => $photoDataProvider,
            'itemView' => '_form',
            'summary' => '',
        ]);
        ?>
    </div>
</div>