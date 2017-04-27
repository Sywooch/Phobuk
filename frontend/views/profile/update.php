<?php

use common\models\CameraBrand;
use common\models\City;
use common\models\Photo;
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $photoDataProvider */
/* @var $model common\models\User */
/* @var $photoTypes */
/* @var $userWithPhotoType */
$this->title = 'Aktualizacja profilu: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'post-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Wybierz miasto']) ?>

    <?= $form->field($model, 'avatar')->dropDownList(ArrayHelper::map(Photo::find()->all(), 'id', 'photo'), ['prompt' => 'Wybierz avatar']) ?>

    <?= $form->field($model, 'level')->dropDownList(User::getLevelsLabels(), [
        User::LEVEL_UNPROFESSIONAL => ['selected' => true]
    ]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'cameraBrands_ids')->checkboxList(CameraBrand::getAllCameraBrands(), ['multiple' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

