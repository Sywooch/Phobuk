<?php


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Aktualizacja użytkownika: ' . $model->getFullName();

?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
