<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;


?>
<div class="site-signup col-xs-12 col-sm-8 col-sm-offset-2 col-md-7 col-lg-6 col-lg-offset-3">
    <?php Pjax::begin() ?>
    <div class="card">
        <div class="card-margin">
            <div class="site-button">
                <?= Html::a('Logowanie', ['login'], ['class' => 'btn btn-site col-xs-6']) ?>
                <?= Html::a('Rejestracja', ['signup'], ['class' => 'btn btn-site-active col-xs-6']) ?>
            </div>

            <div class="row">

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'first_name') ?>

                <?= $form->field($model, 'last_name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'level')->dropDownList(User::getLevelsLabels(), [
                    User::LEVEL_UNPROFESSIONAL => ['selected' => true]
                ]) ?>

                <div class="form-group ">
                    <?= Html::submitButton('Zarejetruj się', ['class' => 'btn btn-primary col-xs-12', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
    <?php Pjax::end() ?>
</div>