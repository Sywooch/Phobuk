<?php

use common\models\City;
use common\models\User;
use kartik\datetime\DateTimePicker;
use vova07\imperavi\Widget;
use wbraganca\selectivity\SelectivityWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin([
        'id' => 'post-form',
        'enableAjaxValidation' => false,
    ]); ?>
    <div class="col-xs-12">
        <?= $form->field($model, 'title')->textarea(['rows' => 1]) ?>
    </div>
    <div class="col-xs-12">
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
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-4 ">
                <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'model' => $model,
                    'attribute' => 'date',
                    'language' => 'pl',
                    'id' => 'event-date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii',
                    ]
                ]);
                echo Html::error($model, 'date'); ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Wybierz miasto']) ?>
            </div>

            <div class="col-md-4">

                <?php
                $allUser = ArrayHelper::map(User::find()->all(), 'id', 'fullName');
                $userInEvent = [];
                foreach ($model->users as $user) {
                    $userInEvent[] = ['id' => $user->id, 'text' => $user->getFullName()];
                }
                echo $form->field($model, 'users_ids')->
                widget(SelectivityWidget::className(), [
                    'pluginOptions' => [
                        'multiple' => true,
                        'value' => $model->users_ids,
                        'items' => $allUser,
                        'placeholder' => 'Wybierz',
                        'initSelection' => new JsExpression('function(data, callback) {
                            $("#' . Html::getInputId($model, 'users_ids') . '").selectivity("data", ' . Json::encode($userInEvent) . ') }')
                    ]
                ]) ?>
            </div>

        </div>
    </div>
    <div class="form-group col-xs-offset-5">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
