<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex($id = null)
    {
        $this->layout = 'main-profile';

        /** @var User $user */
        $user = null;

        if ($id) {
            $query = User::find();

            $query->where('id = :id_param', [
                'id_param' => $id
            ]);
            $user = $query->one();
        } else {
            $user = Yii::$app->user->identity;
        }


        if (!$user) {
            throw new NotFoundHttpException("User not exists");
        }

        return $this->render('index', [
            'user' => $user,
            'city' => $user->city,
            'isCurrentUser' => $user->getId() === Yii::$app->user->identity->getId(),
            'count' => $query = (new Query())
                ->from('user')
                ->count()
        ]);


    }

}




