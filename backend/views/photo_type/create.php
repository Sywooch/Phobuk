<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhotoType */

$this->title = 'Create Photo Type';
$this->params['breadcrumbs'][] = ['label' => 'Photo Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
