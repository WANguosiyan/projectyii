<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_joinin".
 *
 * @property string $id 姓名
 * @property string $name
 * @property string $sex 1-男 2-女 
 * @property string $tel 联系方式
 * @property string $email 邮箱
 * @property string $message 留言
 * @property string $status 1-未处理2-已处理
 * @property string $province 省
 * @property string $city 市
 * @property string $area
 * @property string $birth_date 出生日期
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property string $capital
 */
class TJoinin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_joinin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex', 'status', 'capital'], 'string'],
            [['create_time', 'update_time'], 'integer'],
            [['name', 'tel', 'email', 'message', 'province', 'city', 'area', 'birth_date','memo'], 'string', 'max' => 255],
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
            'sex' => 'Sex',
            'tel' => 'Tel',
            'email' => 'Email',
            'message' => 'Message',
            'status' => 'Status',
            'province' => 'Province',
            'city' => 'City',
            'area' => 'Area',
            'birth_date' => 'Birth Date',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'capital' => 'Capital',
            'memo'=>'Memo'
        ];
    }
    /**
     * 获取列表
     */
    public static function getList($conditionArr = [], $pageIndex = 1, $pageSize = 15, $order = 't1.create_time DESC')
    {
        $start = ($pageIndex - 1) * $pageSize;
        $condition = implode(' AND ', $conditionArr);
        if($condition){
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TJoinin::tableName().' AS t1 WHERE '.$condition
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TJoinin::tableName().' AS t1 '.
                'WHERE '.$condition.' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }else{
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TJoinin::tableName()
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TJoinin::tableName().' AS t1 '.
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
    /**
     * @return mixed
     * 获取今日申请加盟
     */
    public static function today_joinin_num(){
        $begin_today = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end_today = $begin_today + 3600*24;
        $count = TJoinin::find()->where(['between','create_time',$begin_today,$end_today])->count();
        return $count;
    }
    /**今日新增  最多显示六条
     * @return array
     */
    public static function add_joinin_list()
    {
        $begin_today = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end_today = $begin_today + 3600*24;
        $joinin_list = TJoinin::find()->select('*')->where(['between','create_time',$begin_today,$end_today])->orderBy(['create_time'=>SORT_DESC])->limit(6)->asArray()->all();
        foreach($joinin_list as $k => &$v){
            $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        }

        return $joinin_list;
    }
}
