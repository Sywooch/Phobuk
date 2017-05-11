<?php

use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\Event */

$this->title = 'Dodaj wydarzenie';

?>
<div style="color: black">
    <?php Modal::begin([
        'id' => 'create-event-modal',
        'header' => '<div class="center"> <h3>Dodaj nowe wydarzenie</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

    <?php Modal::end(); ?>
</div>
