<?php


/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Aktualizuj miasto: ' . $model->name;

?>
<div class="city-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
