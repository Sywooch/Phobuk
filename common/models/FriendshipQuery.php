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

class FriendshipQuery extends ActiveQuery
{

    /**
     * @param $userId
     * @return $this
     */
    public function forUserId($userId)
    {
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
    public function confirmed()
    {
        return $this->forStatus(Friendship::STATUS_CONFIRM_FRIENDS);
    }

    /**
     * Oczekujace
     * @return FriendshipQuery
     */
    public function waiting()
    {
        return $this->forStatus(Friendship::STATUS_FRIEND_REQUEST);
    }

    /**
     * @param $status - szukany status
     * @return $this
     */
    public function forStatus($status)
    {
        return $this->andWhere('status = ' . $status);
    }

}