<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' =>'Social',
    'components' => [
        'authManager' =>[
            'class'=>'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
