<?php
namespace common\widgets\CameraBrandListWidget;

use common\models\UserCamera;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 27.04.17
 * Time: 13:44
 */
class CameraBrandListWidget extends Widget {
    public $id;

    public function init() {
        parent::init();
    }

    public function run() {
        $cameraBrands = new ActiveDataProvider();
        $cameraBrands->query = UserCamera::find()
            ->where('user_id = :userId', [
                'userId' => $this->id
            ]);
        return $this->render('_cameraBrandList', [
            'id' => $this->id,
            'cameraBrands' => $cameraBrands,

        ]);
    }

}