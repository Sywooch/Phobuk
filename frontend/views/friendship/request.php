<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 31.03.17
 * Time: 13:05
 */
/* @var $requestsDataProvider yii\data\ActiveDataProvider */
/* @var $user \common\models\User */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Zaproszenia do znajomych';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<h4>Ilość zaproszeń: <?= $requestsDataProvider->count ?> </h4>


<div class="container ">
    <?= ListView::widget([
        'dataProvider' => $requestsDataProvider,
        'viewParams' => ['user' => $user],
        'itemView' => '_form',
        'summary' => '',
    ]);
    ?>
</div>



