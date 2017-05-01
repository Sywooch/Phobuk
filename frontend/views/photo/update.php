<?php

use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\Photo */

?>
<div style="color: black">
    <?php Modal::begin([
        'id' => 'update-photo-modal',
        'header' => '<div style="text-align: center"> <h3>Aktualizuja zdjęcia</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>