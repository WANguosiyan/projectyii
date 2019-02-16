<?php
/**
 * 错误管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\api\modules\home\controllers;

use Yii;
use app\api\components\ApiController;

class ErrorController extends ApiController
{
    /**
     * 错误
     *
     * @return array
     */
    public function actionIndex()
    {
        $exception = Yii::$app->getErrorHandler()->exception;
        $message = $exception->getMessage();
        return ['code'=>500, 'msg'=>'程序内部错误('.nl2br($message).')'];
    }
}