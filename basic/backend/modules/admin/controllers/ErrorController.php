<?php

namespace app\backend\modules\admin\controllers;

class ErrorController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
