<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@frontend/assets';

    public $css = [
        'css/site.css',
        'css/font-awesome.css',
        'css/site_sass.scss',
        'css/modaal.css',
    ];

    public $js = [
        'js/main.js',
        'js/modaal.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    public function init() {
        parent::init();
        $this->publishOptions['forceCopy'] = true;
    }
}
