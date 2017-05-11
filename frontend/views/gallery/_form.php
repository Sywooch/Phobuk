<?php

use common\models\Gallery;
use common\models\Photo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-xs-12 col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <?= $form->field($model, 'type')->dropDownList(Gallery::getTypeLabels(), [
            Gallery::TYPE_PRIVATE => ['selected' => true]
        ]) ?>
    </div>

    <?php $img = ArrayHelper::map(Photo::find()->all(), 'id', 'photo'); ?>

    <?= $form->field($model, 'photos_ids')->checkboxList(Photo::imageList($img),
        ['encode' => false,
            'template' => '{label}<div class="col-xs-12 ">{input}</div>']) ?>

    <div class="form-group col-xs-offset-5">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
