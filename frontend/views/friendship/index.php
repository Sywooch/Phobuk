<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FriendshipSearch */
/* @var $confirmedDataProvider yii\data\ActiveDataProvider */
/* @var $requestsDataProvider yii\data\ActiveDataProvider */
/* @var $avatar \common\models\Photo */

$this->title = 'Znajomi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Zaproszenia', ['request'], ['class' => 'btn btn-primary btn-color']) ?>
    </p>

    <h4>Ilość znajomych: <?= $confirmedDataProvider->count ?> </h4>

    <div class="container ">
        <?= ListView::widget([
            'dataProvider' => $confirmedDataProvider,
            'itemView' => '_friend',
            'summary' => '',
        ]);
        ?>
    </div>
</div>
