<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $galleryListDataProvider yii\data\ActiveDataProvider */


$this->title = 'Galerie';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <div class="col-xs-12">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>

        </div>
    </div>

    <div class="container ">
        <div class="row">

            <?= ListView::widget([
                'dataProvider' => $galleryListDataProvider,
                'itemView' => '_galleryList',
                'viewParams' => [],
                'summary' => '',
            ]);
            ?>
        </div>
    </div>
</div>
