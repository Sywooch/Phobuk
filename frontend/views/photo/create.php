<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Photo */

$this->title = 'Dodaj zdjęcie';
$this->params['breadcrumbs'][] = ['label' => 'Zdjęcia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create">

    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
