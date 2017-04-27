<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FriendshipSearch */
/* @var $confirmedDataProvider yii\data\ActiveDataProvider */
/* @var $user \common\models\User */


$this->title = 'Znajomi użytkownika: ';

//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-index">
    <?php $query = User::findOne($user);
    $fullName = $query->getFullName(); ?>
    <h1><?= Html::encode($this->title) . $fullName ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if ($user == Yii::$app->user->identity->getId()) { ?>
    <p>
        <?= Html::a('Zaproszenia do znajomych', ['request', 'id' => Yii::$app->user->identity->getId()], ['class' => 'btn btn-primary btn-color']) ?>
    </p>
    <?php } ?>

    <h4>Ilość znajomych: <?= $confirmedDataProvider->count ?> </h4>

    <div class="container ">
        <?= ListView::widget([
            'dataProvider' => $confirmedDataProvider,
            'viewParams' => ['user' => $user],
            'itemView' => '_form',
            'summary' => '',
        ]);
        ?>
    </div>
</div>
