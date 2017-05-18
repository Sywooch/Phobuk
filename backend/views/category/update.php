<?php

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Aktualizacja kategorii: ' . $model->name;

?>
<div class="category-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
