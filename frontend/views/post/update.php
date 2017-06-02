<?php


/* @var $this yii\web\View */
use yii\bootstrap\Modal;

/* @var $model common\models\Post */


?>
<div class="modal-black">
    <?php Modal::begin([
        'id' => 'update-post-modal',
        'header' => '<div class="center"> <h3>Aktualizuja postu</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>