<?php

/* @var $this yii\web\View */

$this->title = 'Witamy na Phobuku';

?>
<div class="site-about ">

    <div class="center">
        <h1 class="about-title">
            PHOBUK
        </h1>
        <div class="subtext">Witamy na Phobuku - portalu społecznościowym dla fotografów!</div>
    </div>
    <div class="col-xs-12">
        <?= $this->render('login', [
            'model' => $model,

        ]) ?>
    </div>
</div>
