<?php

use common\models\City;
use common\models\User;
use kartik\datetime\DateTimePicker;
use vova07\imperavi\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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


            <div class="col-md-4">
                <p><strong>Data wydarzenia</strong></p>
                <!--  --><?php /*echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date',
                    'language' => 'pl',
                    'dateFormat' => 'yyyy-MM-dd',
                ]) */ ?>

                <?php echo DateTimePicker::widget([
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'model' => $model,
                    'attribute' => 'date',
                    'language' => 'pl',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii',
                    ]
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Wybierz miasto']) ?>

            </div>
            <div class="col-md-4">
                <?php $user = ArrayHelper::map(User::find()->all(), 'id', 'fullName') ?>
                <?= $form->field($model, 'users_ids')->checkboxList($user,
                    ['multiple' => true]) ?>
            </div>

        </div>
    </div>
    <div class="form-group col-xs-offset-5">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
