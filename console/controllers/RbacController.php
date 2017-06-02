<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 26.02.17
 * Time: 21:57
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

    }



}