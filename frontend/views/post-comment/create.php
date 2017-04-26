<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $postComment common\models\PostComment */
/* @var $id \common\models\Post */


?>
<div class="post-comment-create">

    <div class="post-comment-form">
        <div class="col-xs-12 col-md-8 col-md-offset-2">

            <?php $form = ActiveForm::begin([
                'action' => ['/post-comment/create', 'id' => $id]]); ?>

            <?= $form->field($postComment, 'text')->textarea(['rows' => 6]) ?>

            <div class="form-group ">

                <?= Html::submitButton('Dodaj komentarz', ['class' => 'btn btn-primary btn-color']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
