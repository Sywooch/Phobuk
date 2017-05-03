<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 30.04.17
 * Time: 13:49
 */

namespace common\models;


use yii\db\ActiveQuery;

class EventHasUserQuery extends ActiveQuery {


    /**
     * @param $userId
     * @return $this
     */
    public function forUser($userId) {
        return $this->andWhere('user_id = :userId', [
            'userId' => $userId
        ]);
    }

    /**
     * @param $event
     * @return $this
     */
    public function forEvent($event) {
        return $this->andWhere('event_id = :event', [
            'event' => $event
        ]);
    }

    /**
     * @param $status
     * @return $this
     */
    private function forStatus($status) {
        return $this->andWhere('status = :status', [
            'status' => $status
        ]);
    }

    /**
     * @return $this
     */
    public function confirmed() {
        return $this->forStatus(EventHasUser::STATUS_EVENT_CONFIRM);
    }

    /**
     * @return $this
     */
    public function request() {
        return $this->forStatus(EventHasUser::STATUS_EVENT_REQUEST);
    }


}