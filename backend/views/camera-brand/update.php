<?php


/* @var $this yii\web\View */
/* @var $model common\models\CameraBrand */

$this->title = 'Aktualizacja marki aparatu: ' . $model->name;

?>
<div class="camera-brand-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
