<?php
//$params = require(__DIR__ . '/../backend/config/params.php');
$params = require(__DIR__ . '/params.php');
$public_params = require(__DIR__ . '/params.php');
if (YII_ENV == 'dev') {
    $host = 'http://localhost/projectyii/basic';
} else {
    $host = 'http://localhost/projectyii/basic';
}
$params['img_host'] = 'http://project.com';
$config = [
    'id' => 'basic',
    'language'=>'zh-CN',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home/default/index',
    'components' => [
        'session' => [
            'class' => 'yii\web\DbSession',
            'db' => 'db',
            'sessionTable'=>'session'
        ],
        'request' => [
            'cookieValidationKey' => '9oVZ7xEIgyyBlpE5_Fp0WxDTCjahLrP1',
            'enableCsrfValidation' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => false,//后缀
            'enableStrictParsing'=>false,//不要求网址严格匹配，则不需要输入rules
            'rules' => require(__DIR__ . '/../api/config/rule.php'),
        ],
        'errorHandler' => [
            'errorAction' => 'home/error/index',
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => array_merge($public_params,$params),
    'modules' => [
        'home' => [
            'class' => 'app\api\modules\home\Module',
        ],
        'site' => [
            'class' => 'app\api\modules\site\Module',
        ],

    ],
];
return $config;
