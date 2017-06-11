<?php

use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\Photo */

?>
<div class="modal-black">
    <?php Modal::begin([
        'id' => 'update-photo-modal',
        'header' => '<div class="center"> <h3>Aktualizacja zdjęcia</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>