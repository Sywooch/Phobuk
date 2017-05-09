<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 13:47
 * @var $cameraBrands
 */
use common\models\CameraBrand;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>
<div class="cameras-box">

    <div class="btn btn-primary btn-color btn-sm cameras-button" onclick="onToggle(this)">
        <?= FA::icon('camera') . ' Aparaty: ' . $cameraBrands->count ?>
    </div>

    <div class="cameras-list">
        <?php

        foreach ($cameraBrands->models as $cameraBrand) {
            $query = CameraBrand::findOne($cameraBrand->camera_brand_id);
            $camera_brand = $query->name; ?>
            <div class="camera-brand-button">
                <?php echo Html::a(FA::icon('camera') . ' ' . $camera_brand, ['/camera-brand/view', 'id' => $cameraBrand->camera_brand_id], [
                    'class' => 'btn btn-primary btn-color btn-sm',
                ]);
                echo ' '; ?>
            </div>
        <?php } ?>
        <div class="clearfix"></div>

    </div>

</div>
