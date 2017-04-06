<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Friendship */

$this->title = 'Create Friendship';
$this->params['breadcrumbs'][] = ['label' => 'Friendships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
