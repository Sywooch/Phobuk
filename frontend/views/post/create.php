<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 01.05.17
 * Time: 13:01
 */

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
?>
<div class="modal-black">
    <?php Modal::begin([
        'id' => 'create-post-modal',
        'header' => '<div class="center"> <h3>Utwórz nowy post</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

    <?php Modal::end(); ?>
</div>
