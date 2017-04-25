<?php

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'id' => 'post-form',
        'enableAjaxValidation' => false,
    ]); ?>
    <?= $form->field($model, 'title')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'pl',
            'minHeight' => 300,
            'plugins' => [
                'fullscreen',
                'table',
                'fontsize',
                'fontfamily'
            ]
        ]
    ]) ?>

    <?= $form->field($model, 'categories_ids')->checkboxList(\common\models\Category::getAllCategories(), ['multiple' => true]) ?>

    <?= $form->field($model, 'photo_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Photo::find()->all(), 'id', 'photo'), ['prompt' => 'Wybierz zdjęcie']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
