<?php
namespace common\widgets\UserListWidget;

use common\models\Friendship;
use common\models\User;
use Yii;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 18:25
 */
class UserListWidget extends Widget {
    public $model;
    public $user;

    public function init() {
        parent::init();
    }

    public function run() {
        $currentUserId = Yii::$app->user->identity->getId();

        if ($this->model->tableName() == 'friendship') {
            $dispalayedUser = $this->user == $this->model->friend_one ? $this->model->friendTwo : $this->model->friendOne;
        } else {
            $user = $this->model->user_id;
            $dispalayedUser = User::findOne($user);

        }


        /** @var Friendship $currentUserFriendship */
        $currentUserFriendship = Friendship::find()
            ->forUsers($currentUserId, $dispalayedUser->id)
            ->one();

        $isCurrentUser = $currentUserId == $dispalayedUser->id;
        return $this->render('_userList', [
            'model' => $this->model,
            'user' => $this->user,
            'currentUserId' => $currentUserId,
            'isCurrentUser' => $isCurrentUser,
            'currentUserFriendship' => $currentUserFriendship,
            'dispalayedUser' => $dispalayedUser,

        ]);
    }
}