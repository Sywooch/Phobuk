<?php

use common\models\Category;
use common\models\Photo;
use vova07\imperavi\Widget;
use wbraganca\selectivity\SelectivityWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

/* @var $categories */
?>
<div class="post-form">

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


            <div class="col-md-6">
                <?php
                $allCategory = ArrayHelper::map(Category::find()->all(), 'id', 'name');
                $categories_ids_array = [];
                foreach ($model->categories as $category) {
                    $categories_ids_array[] = ['id' => $category->id, 'text' => $category->name];
                }

                echo $form->field($model, 'categories_ids')->widget(SelectivityWidget::className(), [
                    'pluginOptions' => [
                        'multiple' => true,
                        'value' => $model->categories_ids,
                        'items' => $allCategory,
                        'placeholder' => 'Wybierz',
                        'initSelection' => new JsExpression('function(data, callback) {
            $("#' . Html::getInputId($model, 'categories_ids') . '").selectivity("data", ' . Json::encode($categories_ids_array) . ')
        }')
                    ]
                ]) ?>


            </div>
            <div class="col-md-6">

                <?php $img = ArrayHelper::map(Photo::find()->all(), 'id', 'photo'); ?>

                <?= $form->field($model, 'photo_id')->inline()->radioList(Photo::imageList($img),
                    ['encode' => false,
                        'template' => '{label}<div class="col-xs-12 ">{input}</div>']) ?>
            </div>


        </div>
    </div>
    <div class="form-group col-xs-offset-6">
        <?= Html::submitButton($model->isNewRecord ? 'Utwórz' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
