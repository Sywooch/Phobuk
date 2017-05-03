<?php

use common\models\City;
use common\models\User;
use vova07\imperavi\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin([
        'id' => 'event-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


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

    </div>
    <div class="col-xs-12 col-md-3 col-md-offset-3">
        <h5><strong>Data wydarzenia</strong></h5>
        <?php echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'date',
            'language' => 'pl',
            'dateFormat' => 'yyyy-MM-dd',
        ]) ?>
    </div>
    <div class="col-xs-12 col-md-3">
        <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Wybierz miasto']) ?>

    </div>

    <?php
    $user = ArrayHelper::map(User::find()->all(), 'id', 'fullName') ?>


    <div class="col-xs-12 col-md-3 col-md-offset-3">
        <?= $form->field($model, 'users_ids')->checkboxList($user,
            ['multiple' => true,
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return 'dupa' . $index;
                    }
                ],
                'itemOptions' => [
                    'class' => 'switch',
                    'data' => [
                        'on-text' => 'ON',
                        'off-text' => 'OFF',
                        'on-color' => 'teal'
                    ],
                ],
            ]) ?>

    </div>


    <div class="col-xs-12 col-md-6 col-md-offset-5">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Akualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
