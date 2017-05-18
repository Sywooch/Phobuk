<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Dodaj miasto';

?>
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
