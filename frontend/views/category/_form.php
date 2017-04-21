<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 18.04.17
 * Time: 15:23
 */
use common\widgets\PhotoItemWidget\PhotoItemWidget;

/** @var \common\models\Photo $model */

?>
<?= PhotoItemWidget::widget(['model' => $model]) ?>