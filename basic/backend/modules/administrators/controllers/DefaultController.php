<?php

namespace app\backend\modules\administrators\controllers;

use yii\web\Controller;

/**
 * Default controller for the `administrators` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
