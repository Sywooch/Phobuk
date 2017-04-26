<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $photoComment common\models\PhotoComment */
/* @var $id \common\models\Photo */

?>
<div class="photo-comment-create">


    <div class="photo-comment-form">
        <div class="col-xs-12 col-md-8 col-md-offset-2">

            <?php $form = ActiveForm::begin([
                'action' => ['/photo-comment/create', 'id' => $id]]); ?>

            <?= $form->field($photoComment, 'text')->textarea(['rows' => 6]) ?>

            <div class="form-group ">

                <?= Html::submitButton('Dodaj komentarz', ['class' => 'btn btn-primary btn-color']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
