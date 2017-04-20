<?php
namespace common\widgets\PhotoItemWidget;

use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 19.04.17
 * Time: 18:47
 */
class PhotoItemWidget extends Widget {

    public $model;

    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('_photoItem', ['model' => $this->model]);
    }

}