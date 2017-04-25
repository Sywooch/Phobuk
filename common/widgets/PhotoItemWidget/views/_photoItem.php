<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 19.04.17
 * Time: 18:48
 */


use common\models\Category;
use common\models\Photo;
use common\models\User;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/** @var \common\models\Photo $model */
/* @var  $postHasCategory */


?>


<div class="col-sm-8 col-sm-offset-2 ">


    <div class="thumbnail thumbnail-color">

        <div class="caption title">
            <h3 style="text-align: center ">
                <?php if ($model['type'] == 'photo') {
                    echo Html::a($model['title'], ['/photo/view', 'id' => $model['id']]);
                } else {
                    echo Html::a($model['title'], ['/post/view', 'id' => $model['id']]);
                }
                ?>
            </h3>
        </div>
        <div style="padding-bottom: 0">
            <div class="col-xs-6 col-sm-4 col-md-4 ">

                <?php
                $user = User::findOne($model['user_id']);
                $photoAvatar = $user->photoAvatar->photo;
                echo Html::img('/' . $photoAvatar, ['class' => ' img-responsive avatar-small thumbnail']); ?>

            </div>

            <div class="col-xs-4 col-sm-8 col-md-8 ">
                <div class="row">
                    <?php
                    $userFullName = $user->getFullName();
                    echo Html::a(FA::icon('user') . ' ' . $userFullName, ['/profile', 'id' => $model['user_id']], [
                        'class' => 'btn btn-default btn-sm']) ?>
                </div>
                <div class="row ">
                    <?= FA::icon('calendar'); ?>
                    <?= Yii::$app->formatter->asDatetime($model['created_at']) ?>
                </div>
            </div>
        </div>

        <div class="row" style="text-align: center">
            <?php
            if ($model['type'] == 'photo') {
                $category = Category::findOne($model['category_id']);
                $categoryPhotoName = $category->name;
                echo Html::a('#' . $categoryPhotoName, ['/category/view', 'id' => $model['category_id']], [
                    'class' => 'btn btn-default btn-sm']);
            } else {
                foreach ($postHasCategory->models as $modelCategory) {
                    $query = Category::findOne($modelCategory->category_id);
                    $categoryPostName = $query->name;
                    echo Html::a('#' . $categoryPostName, ['/category/view', 'id' => $modelCategory->category_id], [
                        'class' => 'btn btn-default btn-sm']);
                    echo ' ';
                }
            }
            ?>
        </div>

        <?php
        if ($model['type'] == 'post') { ?>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?= $model['text'] ?>
                </div>
            </div>
        <?php } ?>


        <div class="caption">
            <?php if (!$model['photo'] == null) {
                if ($model['type'] == 'photo') {

                    echo Html::img('/' . $model['photo'], ['class' => ' img-responsive img-center ']);
                } else {
                    $query = Photo::findOne($model['photo']);
                    $photo = $query->photo;
                    echo Html::img('/' . $photo, ['class' => 'img-responsive img-center']);
                }
            } ?>
        </div>

    </div>
</div>


