<?php

use common\models\User;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Użytkownicy';

?>
<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Rola',
                'attribute' => 'role',
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),
                'value' => function ($model) {
                    $userRoles = Yii::$app->authManager->getRolesByUser($model->id);
                    return array_shift($userRoles)->name;
                },
            ],
            'first_name',
            'last_name',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->status) {
                        case User::STATUS_ACTIVE :
                            return 'Aktywny';
                            break;
                        case User::STATUS_DELETED :
                            return 'Usunięty';
                            break;
                        default :
                            return 'Brak danych';
                    }
                }
            ],
            'created_at',
            [
                'attribute' => 'level',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->level) {
                        case User::LEVEL_PROFESSIONAL :
                            return 'Profesjonalista';
                            break;
                        case User::LEVEL_UNPROFESSIONAL :
                            return 'Amator';
                            break;
                        default :
                            return 'Brak danych';
                    }
                }
            ],
            [
                'attribute' => 'city_id',
                'value' => function (User $model) {
                    return $model->city->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],

        ],
    ]); ?>
</div>
