<?php

namespace app\backend\modules\teacherteam\controllers;

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
}
