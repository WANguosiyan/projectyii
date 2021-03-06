<?php

namespace app\backend\modules\administrators\controllers;

use app\models\TAdmin;
use yii\web\Controller;
use app\backend\components\BaseController;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * Default controller for the `administrators` module
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
            'backend/appointment/default.js',
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->data['search_attributes'] =  $params = Yii::$app->request->get();
        $pageIndex = Yii::$app->request->get('page',1);
        $model = TAdmin::getList(TAdmin::search($params),$pageIndex,$this->pageSize);
        $this->data['count'] = $model['count'];
        $this->data['dataProvider'] = $model['list'];

        $this->data['pages'] = new Pagination(
            [
                'totalCount' => $this->data['count'],
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$this->pageSize,$this->pageSize]
            ]
        );
        return $this -> render('index',$this->data);
    }
    /**
     * 编辑
     */
    public function actionUpdate(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $post = \Yii::$app->request->post('Admin');
            if($post){
                $model = TAdmin::findOne($id);
                $post['update_time'] = time();
                if($post['password'] != $model->password){
                    $post['password'] = md5(md5($post['password']));
                }

                $model->attributes = $post;
                $submit = $model->save()?200:500;
                if($submit == 200){
                    $this->redirect('?r=admin/default/login');
                }else{
                    $this->refresh('&ref_sub='.$submit);
                }

            }

        }
        $this->data['row'] = TAdmin::findOne($id);
        $this->data['action'] = 'update&id='.$id;
        return $this -> render('create',$this->data);

    }
}
