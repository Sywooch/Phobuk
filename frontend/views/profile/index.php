<?php
/* @var $this yii\web\View
 *
 * @var $user \common\models\User
 * @var $city \common\models\City
 * @var $avatar \common\models\Photo
 * @var $isCurrentUser bool
 * @var $dataProvider
 * @var $friendship \common\models\Friendship
 * rmrevin\yii\fontawesome\AssetBundle::register($this);
 */
use common\widgets\CameraBrandListWidget\CameraBrandListWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = $user->getFullName();
$id = $user->id;
$js = <<<JS
   $(document).on('click', '#update-user-btn', function() {
    $.ajax({
        url: "/profile/update?id=" + $id,
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#modal-placeholder').html(data);
            $('#update-user-modal').modal('toggle');
        }
    });

    return false;
});
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="backgroung-top">
    <div id="modal-placeholder"></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 col-sm-offset-2 col-md-offset-2  ">
                <?php
                if (!$avatar == null) {
                    echo Html::img('/' . $avatar->photo, ['class' => ' img-responsive avatar thumbnail']);
                }
                ?>

            </div>
            <div class="col-xs-4 col-sm-3 col-md-3 " style="margin-left: 5px">
                <h3><?= $user->getFullName() ?></h3>
                <h5><?= $user->getUsername() ?></h5>
                <p>
                    <?= FA::icon('home'); ?>
                    <?= $city->name ?>
                </p>
                <p>
                    <?= FA::icon('signal') ?>
                    <?= $user->getLevelLabel() ?>
                </p>
                <?= CameraBrandListWidget::widget(['id' => $user->getId()]) ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2 ">

                <p>  <?= Html::a('Znajomi', ['/friendship/', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?></p>
                <?php if (Yii::$app->user->identity->getId() == $user->getId()) { ?>
                    <p><?= Html::a('Aktualizuj profil', ['update', 'id' => $user->id], [
                            'id' => 'update-user-btn',
                            'class' => 'btn btn-primary btn-color']) ?></p>
                    <p> <?= Html::a('Dodaj zdjęcie', ['/photo/create'], [
                            'id' => 'create-new-photo-btn',
                            'class' => 'btn btn-primary btn-color']) ?></p>
                    <p><?= Html::a('Dodaj post', ['/post/create'], [
                            'id' => 'create-new-post-btn',
                            'class' => 'btn btn-primary btn-color']) ?></p>
                <?php }
                Pjax::begin(['enablePushState' => false]);
                if (!$isCurrentUser) {
                    if (!$friendship) {
                        echo Html::a('Dodaj do znajomych', ['invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']);
                    } else if ($friendship->isConfirmed()) { ?>
                        <p>Jesteśmy znajomymi</p>
                        <?= Html::a('Usun ze znajomych', ['remove', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php } else if ($friendship->isInvited($user->id)) { ?>

                        <p> Oczekuje na potwierdzenie </p>
                        <?= Html::a('Cofnij zaproszenie', ['revert-invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>


                    <?php } else { ?>
                        <?= Html::a('Potwierdz', ['confirm-invite', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                        <?= Html::a('Odrzuć', ['reject', 'id' => $user->getId()], ['class' => 'btn btn-primary btn-color']) ?>
                    <?php }
                } ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<div class="container ">
    <div class="row">

        <?= ListView::widget(['dataProvider' => $dataProvider,
            'itemView' => '_photo',
            'summary' => '',]);
        ?>
    </div>

</div>
