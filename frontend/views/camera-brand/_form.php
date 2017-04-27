<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 21:40
 */
use common\widgets\UserListWidget\UserListWidget;

?>

<?= UserListWidget::widget(['model' => $model]) ?>