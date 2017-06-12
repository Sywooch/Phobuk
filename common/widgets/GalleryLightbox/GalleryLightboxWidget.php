<?php
namespace common\widgets\GalleryLightbox;

use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 12.06.17
 * Time: 15:05
 */
class GalleryLightboxWidget extends Widget {

    public $photosProvider;
    public $model;

    public function init() {
        parent::init();
    }

    public function run() {

        return $this->render('_galleryLightbox', [
            'photosProvider' => $this->photosProvider,
            'model' => $this->model,

        ]);
    }
}