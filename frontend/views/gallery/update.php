<?php

use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

?>
<div style="color: black">
    <?php Modal::begin([
        'id' => 'update-gallery-modal',
        'header' => '<div class="center"> <h3>Aktualizuja galerii</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>
