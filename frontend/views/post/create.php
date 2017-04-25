<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $categories */

$this->title = 'Utwórz post';
$this->params['breadcrumbs'][] = ['label' => 'Posty', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
