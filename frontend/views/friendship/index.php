<?php

use common\models\User;
use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $confirmedDataProvider yii\data\ActiveDataProvider */
/* @var $user \common\models\User */


$this->title = 'Znajomi użytkownika: ';

?>
<div class="friendship-index">
    <?php $query = User::findOne($user);
    $fullName = $query->getFullName(); ?>
    <div class="center">
    <h1><?= Html::encode($this->title) . $fullName ?></h1>

    <?php if ($user == Yii::$app->user->identity->getId()) { ?>

        <?= Html::a('Zaproszenia do znajomych', ['request', 'id' => Yii::$app->user->identity->getId()], ['class' => 'btn btn-primary btn-color']) ?>

    <?php } ?>

    <h4>Ilość znajomych: <?= $confirmedDataProvider->count ?> </h4>
    </div>
    <div class="col-xs-12">
        <div class="container">
            <?= ListView::widget([
                'dataProvider' => $confirmedDataProvider,
                'itemView' => '_form',
                'summary' => '',
                'viewParams' => ['user' => $user],
                'itemOptions' => ['class' => 'item'],
                'id' => 'friend-confirmed-listview-id',
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
</div>




