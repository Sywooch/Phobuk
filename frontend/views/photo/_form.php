<?php

use common\models\Category;
use kartik\file\FileInput;
use wbraganca\selectivity\SelectivityWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Photo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <?php echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <?= $form->field($model, 'category_id')->widget(SelectivityWidget::className(), [
                'pluginOptions' => [
                    'allowClear' => true,
                    'items' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    'placeholder' => 'Nie wybrano kategorii'
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-xs-offset-4 col-sm-offset-5">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
