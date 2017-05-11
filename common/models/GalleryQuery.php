<?php
/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 5/11/17
 * Time: 12:18 PM
 */

namespace common\models;


use yii\db\ActiveQuery;

/**
 * Class GalleryQuery
 * @package common\models
 */
class GalleryQuery extends ActiveQuery {

    /**
     * GalleryQuery constructor.
     */

    private function forType($type) {
        return $this->andWhere('type = :type', [
            'type' => $type
        ]);
    }

    /**
     * @return $this
     */
    public function publicType() {
        return $this->forType(Gallery::TYPE_PUBLIC);
    }

    /**
     * @return mixed
     */
    public function privateType() {
        return $this->forType(Gallery::TYPE_PRIVATE);
    }

    public function privateForUser($user) {
        return $this->orWhere('type = 0 and user_id = :user', [
            'user' => $user
        ]);
    }

}