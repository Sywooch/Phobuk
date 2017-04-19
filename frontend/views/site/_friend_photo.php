<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 18.04.17
 * Time: 15:23
 */
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/** @var \common\models\Photo $model */
/* @var $avatar \common\models\Photo */
?>

<div class="col-sm-6 col-sm-offset-3 ">


    <div class="thumbnail thumbnail-color">

        <div class="caption">
            <h3 style="text-align: center"><?= $model->title ?>
            </h3>
        </div>
        <div class="row" style="m">
            <div class="col-xs-4  ">
                <?= Html::img('/' . $model->user->photoAvatar->photo, ['class' => ' img-responsive avatar-small ']); ?>
            </div>

            <div class="col-xs-4 col-sm-8 col-md-8 ">
                <div class="row">
                    <?= $model->user->getFullName() ?>
                </div>
                <div class="row ">
                    <?= FA::icon('calendar'); ?>
                    <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                </div>
            </div>
        </div>

        <div class="row" style="margin-left: 2%">
            <?= Html::a('#' . $model->category->name, ['/category/view', 'id' => $model->category->id], [
                'class' => 'btn btn-default btn-sm']) ?>
        </div>

        <div class="caption">
            <?= Html::img('/' . $model->photo, ['class' => ' img-responsive card-img img-fluid ']); ?>
        </div>
    </div>


</div>