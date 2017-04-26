<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 26.04.17
 * Time: 17:11
 * @var  $commentDataProvider
 * @var $pathText
 * @var $commentCreateModel
 * @var $commentCreatePath
 * @var $commentCreateModelPath
 */

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>
<div class="comment">

    <?= $this->render($commentCreateModelPath, [
        $commentCreatePath => $commentCreateModel,
        'id' => $model->id,
    ]) ?>

    <?php
    foreach ($commentDataProvider->models as $comment) {
        ?>
        <div class="thumbnail col-xs-12 col-sm-8 col-sm-offset-2">
            <?php if (Yii::$app->user->identity->getId() == $comment->user_id) { ?>
                <div class="btn-group pull-right" role="group">
                    <?= Html::a(FA::icon('trash') . ' Usuń', [$pathText, 'id' => $comment->id],
                        ['class' => 'btn btn-default btn-sm', 'data' => [
                            'confirm' => 'Jesteś pewien, że chcesz usunąć ten komentarz?',
                            'method' => 'post',
                        ],
                        ]) ?>

                </div>
            <?php } ?>
            <div class="col-xs-12 col-sm-4 ">
                <?= Html::img('/' . $comment->user->photoAvatar->photo, ['class' => ' img-responsive avatar-small thumbnail']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="text-align: center">
                <div class="row">

                    <?php
                    $author = null;
                    if ($model->user_id == $comment->user_id) {
                        $author = ' (autor)';
                    }
                    echo Html::a($comment->user->getFullName() . $author, ['/profile', 'id' => $comment->user_id]) ?>
                    <p><?= FA::icon('calendar') ?>
                        <?= $comment->created_at ?>
                    </p>
                </div>
            </div>
            <div class="col-xs-12">
                <?= $comment->text ?>
            </div>
        </div>

    <?php } ?>
</div>
