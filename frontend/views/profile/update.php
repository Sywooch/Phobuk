<?php

use common\models\CameraBrand;
use common\models\City;
use common\models\Photo;
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $photoDataProvider */
/* @var $model common\models\User */
/* @var $photoTypes */
/* @var $userWithPhotoType */
$this->title = 'Aktualizacja profilu: ' . $model->username;

?>
<div style="color: black">
    <?php Modal::begin([
        'id' => 'update-user-modal',
        'header' => '<div style="text-align: center"> <h3>Aktualizuja profilu</h3></div>',
        'size' => Modal::SIZE_LARGE
    ]); ?>
    <div class="user-update">

        <?php $form = ActiveForm::begin([
            'id' => 'post-form',
            'enableAjaxValidation' => false,
        ]); ?>

        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'username') ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'last_name') ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Wybierz miasto']) ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'level')->dropDownList(User::getLevelsLabels(), [
                User::LEVEL_UNPROFESSIONAL => ['selected' => true]]) ?>
        </div>

        <?php $img = ArrayHelper::map(Photo::find()->all(), 'id', 'photo'); ?>

        <?= $form->field($model, 'avatar')->inline()->radioList(Photo::imageList($img), ['prompt' => 'Wybierz avatar', 'encode' => false]) ?>

        <?= $form->field($model, 'text')->textarea(['rows' => 4]) ?>
        <?= $form->field($model, 'cameraBrands_ids')->inline()->checkboxList(CameraBrand::getAllCameraBrands(), ['multiple' => true]) ?>


        <div class="form-group col-xs-offset-5">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <?php Modal::end(); ?>
</div>
