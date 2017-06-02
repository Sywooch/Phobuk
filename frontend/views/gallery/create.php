<?php

use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */


$this->title = 'Dodaj galerię';

?>
<div class="modal-black">
    <?php Modal::begin([
        'id' => 'create-gallery-modal',
        'header' => '<div class="center"> <h3>Dodaj nową galerię</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>