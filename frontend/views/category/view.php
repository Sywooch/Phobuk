<?php

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

</div>
<div class="container ">
    <div class="row">

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_form',
            'summary' => '',
        ]);
        ?>
    </div>
</div>