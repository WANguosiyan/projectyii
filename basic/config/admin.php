<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'timezone' => 'Asia/Shanghai',
    'bootstrap' => ['log'],
    'defaultRoute' => 'admin/default/login',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PwCMoZzJftF3Q2nWb3hBBVdkB65YNaZg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'admin/error/index',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //send all mails to a file by default. You have to set
            //'useFileTransport' to false and configure a transport
            //for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\backend\modules\admin\admin',
        ],
        'banner' => [
            'class' => 'app\backend\modules\banner\banner',
        ],
        'enterprise' => [
            'class' => 'app\backend\modules\enterprise\module',
        ],
        'curriculum' => [
            'class' => 'app\backend\modules\curriculum\curriculum',
        ],
        'teacherteam' => [
            'class' => 'app\backend\modules\teacherteam\module',
        ],
        'brandplan' => [
            'class' => 'app\backend\modules\brandplan\module',
        ],
        'review' => [
            'class' => 'app\backend\modules\review\module',
        ],
        'administrators' => [
            'class' => 'app\backend\modules\administrators\module',
        ],
        'appointment' => [
            'class' => 'app\backend\modules\appointment\module',
        ],
        'joinin' => [
            'class' => 'app\backend\modules\joinin\module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
