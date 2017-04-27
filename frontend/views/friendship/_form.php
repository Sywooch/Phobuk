<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 21:33
 */
use common\widgets\UserListWidget\UserListWidget;

?>

<?= UserListWidget::widget(['model' => $model, 'user' => $user]) ?>
