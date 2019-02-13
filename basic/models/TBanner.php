<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "t_banner".
 *
 * @property string $id
 * @property int $banner_type_id
 * @property string $name 名称
 * @property string $img_url 图片地址
 * @property string $link_url 链接地址
 * @property int $sort 排序
 * @property int $create_time
 * @property int $update_time
 */
class TBanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['banner_type_id', 'sort', 'create_time', 'update_time'], 'integer'],
            [['name', 'img_url', 'link_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_type_id' => 'Banner Type ID',
            'name' => 'Name',
            'img_url' => 'Img Url',
            'link_url' => 'Link Url',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
    /**
     * 获取列表
     */
    public static function getList($conditionArr = [], $pageIndex = 1, $pageSize = 15, $order = 't1.sort ASC')
    {
        $start = ($pageIndex - 1) * $pageSize;
        $condition = implode(' AND ', $conditionArr);
        if($condition){
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TBanner::tableName().' AS t1 WHERE '.$condition
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TBanner::tableName().' AS t1 '.
                'WHERE '.$condition.' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }else{
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TBanner::tableName()
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TBanner::tableName().' AS t1 '.
                ' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }



        return $model;
    }
    /**
     * 搜索条件
     *
     */
    public static function search($params){
//        echo "<pre>";
//        var_dump($params);die;
        $condition_arr = [];
        if(isset($params['type']) && $params['type'] == 1){
            $condition_arr[] = " t1.{$params['Single']['name']} LIKE '%{$params['Single']['search_val']}%'  ";
        }else{

        }
        return $condition_arr;
    }
}
