<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_teacherteam".
 *
 * @property string $id
 * @property string $name 师资名称
 * @property string $cover_img 封面图
 * @property string $content 简介
 * @property int $create_time
 * @property int $update_time
 */
class TTeacherteam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_teacherteam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_time', 'update_time','sort'], 'integer'],
            [['name', 'cover_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cover_img' => 'Cover Img',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'sort'=>'Sort'
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
                'SELECT COUNT(*) FROM '.TTeacherteam::tableName().' AS t1 WHERE '.$condition
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TTeacherteam::tableName().' AS t1 '.
                'WHERE '.$condition.' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }else{
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TTeacherteam::tableName()
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TTeacherteam::tableName().' AS t1 '.
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
