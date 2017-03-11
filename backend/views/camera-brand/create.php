<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CameraBrand */

$this->title = 'Create Camera Brand';
$this->params['breadcrumbs'][] = ['label' => 'Camera Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-brand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
