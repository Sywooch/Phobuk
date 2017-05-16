<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 16.05.17
 * Time: 13:38
 */
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;


$this->title = 'Wydarzenia użytkownika';

?>

<div class="user-event">

    <div class="title ">
        <?php $query = User::findOne($user);
        $fullName = $query->getFullName(); ?>
        <h1><?= Html::encode($this->title) . ' ' . $fullName ?></h1>
    </div>

    <div class="center">
        <div class="btn btn-site-active  btn-sm " id="confirm-list-button">
            <div class="confirm-event title">Bierze udział w wydarzeniach</div>

        </div>
        <div class="btn btn-site  btn-sm " id="request-list-button">
            <div class="confirm-event title">Zaproszenia na wydarzenia</div>
        </div>
    </div>
    <div class="confirmed-event-list">

        <div class="col-xs-12 padding-phone-fix">
            <div class="container padding-phone-fix ">
                <?= ListView::widget([
                    'dataProvider' => $eventConfirmedList,
                    'itemView' => '_eventList',
                    'summary' => '',

                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="request-event-list">

        <div class="col-xs-12 padding-phone-fix">
            <div class="container padding-phone-fix ">


                <?= ListView::widget([
                    'dataProvider' => $eventRequestList,
                    'itemView' => '_eventList',
                    'summary' => '',
                ]); ?>
            </div>
        </div>
    </div>

</div>