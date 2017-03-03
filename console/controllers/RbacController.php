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

        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'User can create post';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'User can update post';
        $auth->add($updatePost);

        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'User can create comment';
        $auth->add($createComment);

        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = 'User can update comment';
        $auth->add($updateComment);

        $inviteFriend = $auth->createPermission('inviteFriend');
        $inviteFriend->description = 'User can invited friend';
        $auth->add($inviteFriend);


        $user = $auth->createRole('user');
        $auth->add($user);

        $author = $auth->createRole('author');
        $auth->add($author);

        $admin = $auth->createRole('admin');
        $auth->add($admin);


        $auth->addChild($author, $createPost);
        $auth->addChild($author, $createComment);
        $auth->addChild($author, $inviteFriend);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $updateComment);

    }



}