<?php

namespace app\backend\modules\teacherteam\controllers;

use app\models\Common;
use app\models\TTeacherteam;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;
use app\backend\components\BaseController;

/**
 * Default controller for the `teacherteam` module
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
        $this->data['search_attributes'] =  $params = Yii::$app->request->get();
        $pageIndex = Yii::$app->request->get('page',1);
        $model = TTeacherteam::getList(TTeacherteam::search($params),$pageIndex,$this->pageSize);
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
     * 添加
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post('Teacherteam');
        if ($post) {
            $post['cover_img'] = Common::common($post['cover_img'], 'cover_img');
            $model = new TTeacherteam();
            $post['create_time'] = time();
            $model->attributes = $post;
            $submit = $model->save() ? 200 : 500;
            $this->refresh('&ref_sub=' . $submit);
        }
        $this->data['action'] = 'create';
        return $this->render('create', $this->data);
    }
        /**
         * 删除
         */
        public function actionDelete()
        {
            $this->data['params'] = \yii::$app->request->post();
            if(TTeacherteam::findOne($this->data['params']['id'])->delete()){
                return Json::encode(['code'=>200, 'msg'=>'删除成功']);
            }else{
                return Json::encode(['code'=>400, 'msg'=>'删除失败']);
            }
        }
        /**
         * 批量删除
         * @param banners_id
         * @reutrn array
         */
        public function actionBatchDel()
        {

            $banners_id = trim(Yii::$app->request->post('banners_id'), ',');
            $banners_id = explode(',',$banners_id);
            if (!$banners_id) return Json::encode(['code'=>500, 'msg'=>'没有获取请求的ID']);
            foreach($banners_id as $v){
                $model = TTeacherteam::findOne($v)->delete();
            }
            return Json::encode(['code'=>200]);
        }
}