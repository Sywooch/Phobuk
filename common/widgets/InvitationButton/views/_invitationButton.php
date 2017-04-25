<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 4/23/17
 * Time: 11:31 AM
 * @var $friendship
 */

use common\models\User;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;


?>

<div class='navbar-form navbar-inverse navbar-right dropdown'>
    <div class='dropdown dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
        <div class="invited"> <?= FA::icon('user-plus') ?> </div>
        <?php if ($friendship->count > 0) { ?>
        <div class="label-info"> <?= $friendship->count ?></div>
        <?php } ?>
        <span class='caret'></span>
    </div>
    <div class='dropdown-menu dropdown-messages'>
        <?php if ($friendship->count == 0) { ?>
            <p>Nie masz zaproszeń do znajomych</p>
        <?php }
        foreach ($friendship->models as $model) {
            $query = User::findOne($model->friend_one);
            $fullName = $query->getFullName();
            ?>
            <div class="row">
                <div class="col-xs-12 dropdown-messages-text">
                    <p><?= Html::a($fullName, ['/profile', 'id' => $model->friend_one]) ?></p>
                    <p><?= $model->created_at ?></p>

                </div>
                <div class="col-xs-6">
                    <?= Html::a('Potwierdź', ['friendship/confirm-invite', 'id' => $model->friend_one], ['class' => 'btn btn-primary btn-color']); ?>
                </div>
                <div class="col-xs-6">
                    <?= Html::a('Odrzuć', ['friendship/reject', 'id' => $model->friend_one], ['class' => 'btn btn-primary btn-color']); ?>
                </div>
            </div>
            <div class='divider'></div>
        <?php } ?>
    </div>
</div>
