<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_appointment".
 *
 * @property string $id
 * @property string $name 姓名
 * @property int $appointment_time 时间
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property string $status 1-未处理 2-已处理 
 * @property string $tel 联系方式
 * @property string $sex 1-男 2-女
 * @property string $province 所在省
 * @property string $city 市
 * @property string $area 区
 * @property string $birth_date 出生日期
 */
class TAppointment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_appointment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appointment_time', 'create_time', 'update_time'], 'integer'],
            [['status', 'sex'], 'string'],
            [['name', 'tel', 'province', 'city', 'area', 'birth_date','memo'], 'string', 'max' => 255],
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
            'appointment_time' => 'Appointment Time',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'tel' => 'Tel',
            'sex' => 'Sex',
            'province' => 'Province',
            'city' => 'City',
            'area' => 'Area',
            'birth_date' => 'Birth Date',
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
                'SELECT COUNT(*) FROM '.TAppointment::tableName().' AS t1 WHERE '.$condition
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TAppointment::tableName().' AS t1 '.
                'WHERE '.$condition.' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }else{
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TAppointment::tableName()
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TAppointment::tableName().' AS t1 '.
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
     * 获取今日预约试听数
     */
    public static function today_appointment_num(){
        $begin_today = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end_today = $begin_today + 3600*24;
        $count = TAppointment::find()->where(['between','create_time',$begin_today,$end_today])->count();
        return $count;
    }
    /**今日新增  最多显示六条
     * @return array
     */
    public static function add_appointment_list()
    {
        $begin_today = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end_today = $begin_today + 3600*24;
        $appointment_list = TAppointment::find()->select('*')->where(['between','create_time',$begin_today,$end_today])->orderBy(['create_time'=>SORT_DESC])->limit(6)->asArray()->all();
        foreach($appointment_list as $k => &$v){
            $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        }

        return $appointment_list;
    }
}
