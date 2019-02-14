<?php

namespace app\backend\modules\enterprise\controllers;

use app\models\Common;
use app\models\TEnterprise;
use yii\web\Controller;
use app\backend\components\BaseController;
/**
 * Default controller for the `enterprise` module
 */
class DefaultController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->data['css'] = [
            'global/plugins/layer/skin/default/layer.css',
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            'global/plugins/fancybox/source/jquery.fancybox.css',
            'global/plugins/bootstrap-fileinput/fileinput.css',
        ];

        $this->data['js'] = [
            'global/plugins/layer/layer.js',
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $data = TEnterprise::find()->asArray()->one();
        $this->data['row'] = $data;
        return $this->render('index',$this->data);
    }
    /**
     * 编辑
     */
    public function actionUpdate(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $post = \Yii::$app->request->post('Enterprise');
            $model = TEnterprise::findOne($id);
            if (isset($post['logo']) && $post['logo']!=$model->logo){//图片上传
                $post['logo'] = Common::common($post['logo'], 'logo');
            }
            if (isset($post['qr_code']) && $post['qr_code']!=$model->qr_code){//图片上传
                $post['qr_code'] = Common::common($post['qr_code'], 'qrcode');
            }
            $post['update_time'] = time();
            $model->attributes = $post;
            $submit = $model->save()?200:500;
            $this->refresh('&ref_sub='.$submit);
        }
        $this->redirect('?r=enterprise/default/index');
    }
}
