<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $photoFriendProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="site-index">


</div>
<div class="container ">
    <div class="row">

        <?= ListView::widget([
            'dataProvider' => $photoFriendProvider,
            'itemView' => '_friend_photo',
            'summary' => '',
        ]);
        ?>
    </div>
</div>