<?php


use common\widgets\PhotoPostItemWidget\PhotoPostItemWidget;

/** @var \common\models\Photo $model */

?>
<?= PhotoPostItemWidget::widget(['model' => $model]) ?>

