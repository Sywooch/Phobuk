<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;

/* @var $photoFriendProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;
?>
<div class="site-index">


</div>
<div class="container ">
    <div class="row">

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_friend_photo',
            'summary' => '',
        ]);
        ?>
    </div>
</div>