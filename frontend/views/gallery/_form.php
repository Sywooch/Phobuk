<?php

use common\models\Gallery;
use common\models\Photo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
/* @var $photoForm \frontend\models\PhotoForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'type')->dropDownList(Gallery::getTypeLabels(), [
        Gallery::TYPE_PRIVATE => ['selected' => true]
    ]) ?>

    <?php $img = ArrayHelper::map(Photo::find()->all(), 'id', 'photo'); ?>

    <?= $form->field($model, 'photos_ids')->checkboxList(Photo::imageList($img),
        ['encode' => false,
            'template' => '{label}<div class="col-xs-12 ">{input}</div>']) ?>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
