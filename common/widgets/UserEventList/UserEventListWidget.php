<?php
namespace common\widgets\UserEventList;

use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 30.04.17
 * Time: 15:05
 */
class UserEventListWidget extends Widget {

    public $model;
    public $isParticipant;

    public function init() {
        parent::init();
    }

    public function run() {

        return $this->render('_userList', [
            'model' => $this->model,
            'isParticipant' => $this->isParticipant
        ]);
    }

}