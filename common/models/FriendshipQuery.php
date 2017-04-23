<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 29.03.17
 * Time: 16:18
 */
use common\models\Friendship;

/** @var Friendship $model */
namespace common\models;


use yii\db\ActiveQuery;

class FriendshipQuery extends ActiveQuery {

    /**
     * @param $userId
     * @return $this
     */
    public function forUserId($userId) {
        $this->andWhere('friend_one = :userId or friend_two = :userId',
            [
                ':userId' => $userId
            ]);
        return $this;
    }


    /**
     * Tylko potwierdzone
     * @return $this
     */
    public function confirmed() {
        return $this->forStatus(Friendship::STATUS_CONFIRM_FRIENDS);
    }

    /**
     * Oczekujace
     * @return FriendshipQuery
     */
    public function waiting() {
        return $this->forStatus(Friendship::STATUS_FRIEND_REQUEST);
    }

    /**
     * @param $status - szukany status
     * @return $this
     */
    public function forStatus($status) {
        return $this->andWhere('status = ' . $status);
    }

    public function forUsers($user1Id, $user2Id) {
        $this->andWhere('(friend_one = :user1 and friend_two = :user2 or
            friend_two = :user1 and friend_one = :user2)',
            [
                'user1' => $user1Id,
                'user2' => $user2Id
            ]);

        return $this;
    }


}