<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 4/23/17
 * Time: 11:31 AM
 * @var $friendship
 * @var $dataProvider
 */

use rmrevin\yii\fontawesome\FA;
use yii\widgets\ListView;

?>

<div class='navbar-form navbar-inverse navbar-right dropdown'>
    <div class='dropdown dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
        <div class="invited"> <?= FA::icon('globe') ?> </div>
        <?php if ($count > 0) { ?>
            <div class="label-info"> <?= $count ?></div>
        <?php } ?>
        <span class='caret'></span>
    </div>
    <div class='dropdown-menu dropdown-messages'>
        <?php if ($count == 0) { ?>
            <p>Nie masz zaproszeń</p>
        <?php } else { ?>
            <div class="container-fuid">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_form',
                    'summary' => '',

                ]); ?>
            </div>
        <?php } ?>

    </div>
</div>
