<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 5/11/17
 * Time: 11:40 AM
 * @var $model \common\models\Gallery
 */
use common\models\Gallery;
use common\models\Photo;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;


$query = Photo::find()
    ->joinWith('galleries')
    ->where('gallery_id = :id', ['id' => $model->id])
    ->limit(4);
$pageSize = 3;

$photosProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => $pageSize,
    ],
]);

$otherPhotos = $photosProvider->totalCount - $pageSize;

if ($otherPhotos > 0) {
    $buttonText = 'Pozostało zdjęć: ' . $otherPhotos . '. Zobacz więcej';
} else
    $buttonText = 'Wyświetl galerię';

$js = <<<JS
$('.gallery').modaal({
    type: 'image',

    
});
JS;
$this->registerJs($js);

$currentUser = Yii::$app->user->getId();
if ($model->type == Gallery::TYPE_PUBLIC || $model->type == Gallery::TYPE_PRIVATE && $currentUser == $model->user_id) {


?>
<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 padding-phone-fix">
    <div class="card">


        <div class="col-xs-12">
            <div class="title">
                <h2><?= Html::a($model->title, ['/gallery/view', 'id' => $model->id]) ?></h2>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 center">
                <?= FA::icon('calendar') . ' ' . $model->created_at ?>

                <?= Html::a(FA::icon('user') . ' ' . $model->user->username, ['/profile/', 'id' => $model->user->getId()], [
                    'class' => 'btn btn-default btn-sm'
                ]) ?>

                <?php if ($model->isPublic()) {
                    echo FA::icon('globe');
                } else
                    echo FA::icon('user-secret');

                echo ' ' . $model->showStatusLabel() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <?php foreach ($photosProvider->models as $photo) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 padding-wrapper-fix gall-img">
                        <?= Html::a((Html::img('/' . $photo->photo, ['class' => 'img-gallery ', 'aria-label' => $photo->title])), '/' . $photo->photo, ['class' => 'img-gallery  gallery', 'rel' => 'gallery', 'aria-label' => $photo->title]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 ">
                <?= Html::a($buttonText, ['/gallery/view', 'id' => $model->id], [
                    'class' => 'btn btn-site col-xs-12 padding-wrapper-fix'
                ]) ?>
            </div>
        </div>

    </div>
</div>
<?php } ?>