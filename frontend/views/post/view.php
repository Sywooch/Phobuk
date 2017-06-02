<?php

use common\widgets\CommentsListWidget\CommentsListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $post common\models\Post */
/* @var $categories */
/* @var $postComment */
/* @var $commentDataProvider */

$this->title = $post->title;
$id = $post->id;
$js = <<<JS
   $(document).on('click', '#update-post-btn', function() {
    $.ajax({
        url: "/post/update?id=" + $id,

        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#modal-placeholder').html(data);
            $('#update-post-modal').modal('toggle');
        }
    });

    return false;
});
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="container padding-phone-fix">
    <div class=" col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix ">
    <div class="card">
        <div id="modal-placeholder"></div>

        <div class="post-view ">

            <div class="caption">
                <?php if (!$post->photo == null) {
                    echo Html::img('/' . $post->photo->photo, ['class' => 'img-responsive img-center ']);
                } ?>
            </div>
            <div class="col-xs-12">
                <?php if (Yii::$app->user->identity->getId() == $post->user->id) { ?>
                    <div class="btn-group pull-right" role="group">
                        <?= Html::a(FA::icon('pencil') . ' Edytuj', ['/post/update', 'id' => $post->id], [
                            'id' => 'update-post-btn',
                            'class' => 'btn btn-default btn-sm'
                        ]) ?>
                        <?= Html::a(FA::icon('trash') . ' Usuń', ['delete', 'id' => $post->id],
                            ['class' => 'btn btn-default btn-sm', 'data' => [
                                'confirm' => 'Jesteś pewien, że chcesz usunąć ten post?',
                                'method' => 'post',
                            ],
                            ]) ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xs-12">
                <div class="title">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4 col-sm-2 col-sm-offset-2">
                    <?php if (!$post->user->avatar == null) {
                        echo Html::img('/' . $post->user->photoAvatar->photo, ['class' => 'img-responsive avatar-small thumbnail']);
                    } ?>
                </div>
                <div class="col-xs-8 col-sm-6">
                    <?= Html::a(FA::icon('user') . ' ' . $post->user->getFullName(), ['/profile/', 'id' => $post->user->getId()], [
                        'class' => 'btn btn-default btn-sm']) ?>
                    <p>  <?= FA::icon('calendar'); ?>
                        <?= $post->created_at ?>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 center">
                    <?php foreach ($categories->models as $model) {
                        $query = \common\models\Category::findOne($model->category_id);
                        $category_name = $query->name;
                        echo Html::a('#' . $category_name, ['/category/view', 'id' => $model->category->id], [
                            'class' => 'btn btn-default btn-sm']);
                        echo ' ';
                    } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?= $post->text ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?= CommentsListWidget::widget([
                        'model' => $post,
                        'id' => $id]) ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>