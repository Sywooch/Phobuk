<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 31.03.17
 * Time: 13:05
 */
/* @var $requestsDataProvider yii\data\ActiveDataProvider */
/* @var $user \common\models\User */

use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Zaproszenia do znajomych';

?>
<div class="center">
<h1><?= Html::encode($this->title) ?></h1>
</div>
<h4>Ilość zaproszeń: <?= $requestsDataProvider->count ?> </h4>


<div class="col-xs-12">
    <div class="container">
        <?= ListView::widget([
            'dataProvider' => $requestsDataProvider,
            'itemView' => '_form',
            'summary' => '',
            'viewParams' => ['user' => $user],
            'itemOptions' => ['class' => 'item'],
            'id' => 'friend-request-listview-id',
            'layout' => '<div class="container">{items}</div> <div class="pager-margin">{pager}{summary}</div>',
            'pager' => [
                'class' => ScrollPager::className(),
                'triggerText' => 'Pokaż więcej',
                'enabledExtensions' => [ScrollPager::EXTENSION_TRIGGER],
            ],
        ]);
        ?>
    </div>
</div>
