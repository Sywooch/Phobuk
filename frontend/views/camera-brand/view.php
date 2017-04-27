<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\CameraBrand */
/* @var $userCameraBrand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Camera Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-brand-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="container ">
        <?= ListView::widget([
            'dataProvider' => $userCameraBrand,
            'itemView' => '_form',
            'viewParams' => ['userCameraBrand' => $userCameraBrand],
            'summary' => '',
        ]);
        ?>
    </div>

</div>
