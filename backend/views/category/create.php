<?php


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Utwórz kategorię';

?>
<div class="category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
