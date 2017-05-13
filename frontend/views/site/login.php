<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Witamy na Phobuku';

?>
<div class="site-login col-xs-12 col-sm-8 col-sm-offset-2 col-md-7 col-lg-6 col-lg-offset-3 ">
    <?php Pjax::begin() ?>
    <div class="card">
        <div class=" card-margin">
            <div class="site-button  ">
                <?= Html::a('Logowanie', ['login'], ['class' => 'btn btn-site-active col-xs-6']) ?>
                <?= Html::a('Rejestracja', ['signup'], ['class' => 'btn btn-site col-xs-6']) ?>
            </div>

            <div class="row">

                <div class="col-xs-12">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="reminder-text">
                        Zapomniałeś hasła? <?= Html::a('Zresetuj je. ', ['site/request-password-reset']) ?>
                    </div>


                    <div class="form-group">
                        <?= Html::submitButton('Logowanie', ['class' => 'btn btn-primary  col-xs-12', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>


        </div>
    </div>
    <?php Pjax::end() ?>
</div>