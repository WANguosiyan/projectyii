<?php
namespace app\api\modules\home\models;
use app\api\modules\home\Module;
use app\backend\modules\product\models\CpProductParam;
use app\backend\modules\product\models\CpProduct;
use app\backend\modules\product\models\CpProductFile;
use app\backend\modules\product\models\CpProductImg;
use app\backend\modules\product\models\CpProductSpec;
use app\backend\modules\txt\models\Common;
use app\backend\modules\txt\models\TwNewsFile;
use app\backend\modules\txt\models\TwNewsList;
use app\backend\modules\txt\models\TwNewsType;
use cebe\markdown\MarkdownExtra;
use Yii;
use yii\data\Pagination;
use yii\db\Query;

class Article extends Module{
    /**
     * @param int $parent_id
     * @param int $limit
     * @param int $pageIndex
     * @param int $pageSize
     * @return array
     */
    public static function getLatest($parent_id=0,$pageIndex=1,$pageSize=10){
        $list = [];
        $model = TwNewsList::find()
            ->where(['news_type'=>$parent_id])
            ->andwhere(['status'=>1])
            ->orderBy("create_time DESC");
        $count = $model->count();
        $model->offset(($pageIndex - 1) * $pageSize)
                ->limit($pageSize);

        $list['list'] = self::dateFormat($model->asArray()->all());
        $list['page'] = new Pagination(
            [
                'totalCount' => $count,
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$pageSize,$pageSize]
            ]
        );

        return $list;
    }

    /**
     * 获取子集分类
     * @param $parent_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getCaseType($parent_id){
        $res = TwNewsType::find()->select('*')
                ->where(['parent_id'=>$parent_id])
                ->asArray()
                ->all();
        return $res;
    }
    /**
     * 获取所有的案例
     * @param int $parent_id
     * @param int $pageIndex
     * @param int $pageSize
     * @return mixed
     */
    public static function getCase($parent_id = 0,$is_index = false,$pageIndex = 1,$pageSize = 10){
        $res = TwNewsType::TypeInfo($parent_id);
        $ids = TwNewsList::getParentId($res);
        if(!$res && !$ids) $ids = $parent_id;
        $model = TwNewsList::find()
                ->where(['status'=>'1']);

        $model->andwhere(['news_type'=>$ids]);
        if($is_index){
            $list = $model->andWhere(['is_index'=>'1'])
                        ->orderBy("sort asc,id desc")
                        ->asArray()
                        ->all();
        }else{
            $count = $model->count();
            $model->offset(($pageIndex-1)*$pageSize)
                ->limit($pageSize);
            $list['list'] = $model->all();
            $list['page'] = new Pagination(
                [
                    'totalCount' => $count,
                    'defaultPageSize'=>$pageIndex,
                    'pageSizeLimit'=>[$pageSize,$pageSize]
                ]
            );
        }

        return $list;
    }

    /**
     * 产品列表
     * @param bool $is_index
     * @param array $query_params
     * @param int $pageIndex
     * @param int $pageSize
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getProduct($is_index = false,$query_params = [],$pageIndex = 1,$pageSize = 10){
        $list = [];
        if($is_index){
            $list = CpProduct::find()
                    ->where(['is_index'=>'1'])
                    ->asArray()
                    ->all();
        }else{
            $model = CpProduct::find();
            if($query_params['param']){
                $model->leftJoin(CpProductParam::tableName().' as param','param.product_id = cp_product.id')
                    ->where(['value'=>$query_params['param']]);
            }
            if($query_params['search']){
                $model->filterWhere(['like','title',$query_params['search']]);
            }
            $count = $model->count();
            $list['page'] = new Pagination([
                'totalCount' => $count,
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$pageSize,$pageSize]
            ]);
            $model->offset(($pageIndex-1)*$pageSize)
                ->limit($pageSize);
            $list['list'] = $model->asArray()->all();
        }
        return $list;
    }

    /**
     * 产品列表图册
     * @param $data
     * @param $img_type
     * @return mixed
     */
    public static function proListImgs($data = [],$img_type = 0){
        foreach($data as $k=>$v){
            $data[$k]['imgs'] = self::proImgs($v['id'],$img_type);
        }
        return $data;
    }
    /**
     * 单个产品图册
     * @param $pro_id
     * @param $img_type
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function proImgs($pro_id,$img_type){
        $row = CpProductImg::find()
                ->where(['product_id'=>$pro_id])
                ->andWhere(['remark'=>$img_type])
                ->asArray()
                ->all();
        return $row;
    }

    /**
     * 相关产品
     * @param array $ids
     * @return array
     */
    public static function proRelative($ids = []){
        $res = [];
        foreach($ids as $v){
            $res[] = self::getInfo('cp_product','id',$v);
        }
        return $res;
    }
    /**
     * 合作伙伴
     * @param $parent_id
     */
    public static function getCooper($parent_id){
        $model = TwNewsList::find();
        $list = $model->where(['status'=>'1'])
            ->andWhere(['news_type'=>$parent_id])
            ->orderBy("sort asc,id desc")
            ->asArray()
            ->all();
        return $list;
    }

    /**
     * 资质文件
     * @param string $flag
     * @param int $pageIndex
     * @param int $pageSize
     * @return mixed
     */
    public static function getFiles($pageIndex = 1,$pageSize = 20){
        $model = TwNewsFile::find();
        $count = $model->count();
        $model->offset(($pageIndex-1)*$pageSize)
            ->limit($pageSize);
        $list['list'] = $model->all();
        $list['page'] = new Pagination(
            [
                'totalCount' => $count,
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$pageSize,$pageSize]
            ]
        );
        return $list;
    }
    /**
     * 日期格式化
     * @param $data
     * @param string $str
     * @return mixed
     */
    public static function dateFormat($data,$str = "Y.m.d"){
        foreach($data as $k=>$v){
            $data[$k]['create_time'] = date($str,$v['create_time']);
        }
        return $data;
    }

    /**
     * 详情页
     * @param $model
     * @param $key
     * @param $v
     * @return array|bool
     */
    public static function getInfo($model,$key,$v){
        $row = (new Query())
            ->select('*')
            ->from($model)
            ->where([$key=>$v])
            ->one();
        if(isset($row['create_time'])){
            $row['create_time'] = date('Y.m.d',$row['create_time']);
        }
        return $row;
    }

    /**
     * 产品属性规格值
     * @param $spec_type
     * @return mixed
     */
    public static function paramValue($spec_type){
        $data = self::param($spec_type);
        foreach($data as $k=>$v){
             $data[$k]['value'] = CpProductParam::find()
                                ->select(['spec_id','value'])
                                ->where(['spec_id'=>$v['spec_id']])
                                ->distinct()
                                ->asArray()
                                ->all();
        }
        return $data;
    }
    /**
     * 属性/规格参数
     * @param $spec_type
     * @return mixed
     */
    public static function param($spec_type){
        $model = CpProductSpec::find()
                ->where(['cat_id'=>1])
                ->andWhere(['spec_type'=>$spec_type])
                ->orderBy('sort asc')
                ->asArray()
                ->all();
        return $model;
    }

    /**
     * 产品详情参数
     * @param $id
     * @param $spec_type
     * @return mixed
     */
    public static function pro_info($id,$spec_type){
        $param = CpProductSpec::find()
                ->select(['cp_product_spec.*','param.*'])
                ->leftJoin(CpProductParam::tableName().' as param','param.spec_id = cp_product_spec.spec_id')
                ->where(['param.product_id'=>$id])
                ->andWhere(['spec_type'=>$spec_type])
                ->asArray()
                ->all();
        return $param;
    }
    /**
     * 产品相关图册
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function pro_file($id){
        $file = CpProductFile::find()
                ->where(['product_id'=>$id])
                ->asArray()
                ->one();
        return $file;
    }
    public static function sendMail($data = []){
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('1244120082@qq.com');
        $body = "<div>用户姓名：<font color='red'>".$data['username']."</font></div>";
        $body .= "<div>手机号：".$data['phone']."</div>";
        $body .= "<div>邮箱：".$data['mail']."</div><hr/>";
        $body .= "<div>留言内容：".$data['message']."</div>";
        $mail->setSubject('用户留言');
        $mail->setHtmlBody($body);
        $b = $mail->send();
        if($b){
            return true;
        }
        return false;
    }
}