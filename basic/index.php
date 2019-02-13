<?php
//comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

//判断加载的项目（web、wap、api、web）
if (strpos($_SERVER['PHP_SELF'], '/wap/') !== false)
    header('Location:/backend');
else
    header('Location:/backend');