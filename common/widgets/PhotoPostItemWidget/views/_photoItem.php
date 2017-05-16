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
/** @var \yii\web\View $this */
$id = $model['id'];
$type = $model['type'];
$photoModel = $model['photo'];


$js = <<<JS

    $(' [data-id="$id"] .like').click(function() {
   
 
        var like = this;

        var ajaxConfiguration = {
          url: '$path',
          type: 'get',
          data: {
            itemId: $id,
            itemType: '$type',
          },
         
          success: function(data) {
              response = $.parseJSON(data);
              var likeButton = $('.like-button', like);
              var count = $('.count', likeButton);
              var userLike = $('.userLike', likeButton);
          
              var countText = response.currentLikes;
              var userText = response.status;
     
                likeButton.addClass('btn-primary');
                likeButton.removeClass('btn-default');
                count.text(countText);
                userLike.text(userText);
            
            }
        };
         $.ajax(ajaxConfiguration);
         
    });

JS;

$this->registerJs($js);

$css = <<<CSS
    .like-button.active {
        color: blue;
    }
CSS;


$this->registerCss($css);
?>


<div data-id="<?= $id ?>" type="<?= $type ?>" class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix">

    <div class="card">

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

        <div class=" title">
            <h2>
                <?php if ($model['type'] == 'photo') {
                    echo Html::a($model['title'], ['/photo/view', 'id' => $model['id']]);
                } else {
                    echo Html::a($model['title'], ['/post/view', 'id' => $model['id']]);
                }
                ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-2 col-sm-offset-2">
                <?php
                $user = User::findOne($model['user_id']);
                $photoAvatar = $user->photoAvatar->photo;
                echo Html::img('/' . $photoAvatar, ['class' => 'img-responsive avatar-small thumbnail']); ?>
            </div>

            <div class="col-xs-8 col-sm-6">
                <div class="row">
                    <?php
                    $userFullName = $user->getFullName();
                    echo Html::a(FA::icon('user') . ' ' . $userFullName, ['/profile', 'id' => $model['user_id']], [
                        'class' => 'btn btn-default btn-sm']) ?>

                    <p>  <?= FA::icon('calendar'); ?>
                        <?= Yii::$app->formatter->asDatetime($model['created_at']) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-xs-12">
                <div class="center">
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
            </div>
        </div>

        <?php
        if ($model['type'] == 'post') { ?>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?= $model['text'] ?>
                </div>
            </div>

        <?php } ?>
        <div class="row ">
            <div class="col-xs-12">
                <div class="button-box ">
                    <div class="button-item">

                        <?php if ($model['type'] == 'photo') {
                            echo Html::a(FA::icon('comment') . ' ' . $commentDataProvider->count, ['/photo/view', 'id' => $model['id']], [
                                'class' => 'btn btn-default btn-sm'
                            ]);
                        } else {
                            echo Html::a(FA::icon('comment') . ' ' . $commentDataProvider->count, ['/post/view', 'id' => $model['id']], [
                                'class' => 'btn btn-default btn-sm'
                            ]);
                        }
                        ?>
                    </div>
                    <div class="button-item">
                        <div class="like">
                            <div class="btn like-button btn-default btn-sm"><span class="fa fa-thumbs-up"></span> <span
                                    class="count"><?= $currentLikes->count ?></span>
                                <span class="userLike" id="userLike"><?= $status ?></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
