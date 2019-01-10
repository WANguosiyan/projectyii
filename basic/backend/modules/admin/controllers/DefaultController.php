<?php

namespace app\backend\modules\admin\controllers;
use app\backend\components\BaseController;
use app\models\TAdmin;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    public $layout = '@app/backend/views/layouts/main_login';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * user login
     * @return string
     */
    public function actionLogin(){
        $this->data['js'] = array(
            /*begin validate*/
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/select2/js/select2.full.min.js',
            /*end validate*/
            'pages/scripts/login.js'
        );
        $this->data['css'] = array(
            'pages/css/login.min.css'
        );
        $this->data['error'] = '';
        $params = Yii::$app->request->post('User');
        if($params){
            $model = TAdmin::findOne(['name'=>$params['name']]);
            if(!$model) $this->data['error'] = '用户不存在';
        }
        return $this->render('login', $this->data);
    }
}
