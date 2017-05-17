<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 16.05.17
 * Time: 21:13
 * @var  $galleryDataProvider
 */
use common\models\User;
use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Galerie użytkownika';
?>
<div class="gallery-index">

    <div class="col-xs-12">
        <div class="title">
            <?php $query = User::findOne($user);
            $fullName = $query->getFullName(); ?>
            <h1><?= Html::encode($this->title) . ' ' . $fullName ?></h1>

        </div>
    </div>


    <div class="col-xs-12 padding-phone-fix">
        <div class="container padding-phone-fix">
            <?= ListView::widget([
                'dataProvider' => $galleryDataProvider,
                'itemView' => '_galleryList',
                'summary' => '',
                'itemOptions' => ['class' => 'item'],
                'id' => 'gallery-listview-id',
                'layout' => '<div class="container padding-phone-fix">{items}</div> <div class="pager-margin">{pager}{summary}</div>',
                'pager' => [
                    'class' => ScrollPager::className(),
                    'triggerText' => 'Pokaż więcej',
                    'enabledExtensions' => [ScrollPager::EXTENSION_TRIGGER],
                ],
            ]);
            ?>
        </div>
    </div>
</div>