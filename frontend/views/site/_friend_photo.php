<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 18.04.17
 * Time: 15:23
 */

use common\widgets\PhotoPostItemWidget\PhotoPostItemWidget;

/** @var \common\models\Photo $model */

?>
<?= PhotoPostItemWidget::widget(['model' => $model]) ?>