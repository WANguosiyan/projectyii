<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_admin".
 *
 * @property string $user_id 后台用户ID
 * @property string $name 真实姓名
 * @property string $password
 * @property string $create_time 最后登录时间
 * @property string $login_ip 上次登录ip
 * @property string $login_count 登录次数
 * @property string $update_time 最后更改时间
 * @property int $disabled 是否删除 0-否 1-是
 */
class TAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password'], 'required'],
            [['create_time', 'login_count', 'update_time', 'disabled'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 255],
            [['login_ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'password' => 'Password',
            'create_time' => 'Create Time',
            'login_ip' => 'Login Ip',
            'update_time' => 'Update Time',
            'disabled' => 'Disabled',
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
                'SELECT COUNT(*) FROM '.TAdmin::tableName().' AS t1 WHERE '.$condition
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TAdmin::tableName().' AS t1 '.
                'WHERE '.$condition.' ORDER BY '.$order.' LIMIT '.$start.','.$pageSize
            )->queryAll();
        }else{
            $model['count'] = self::getDb()->createCommand(
                'SELECT COUNT(*) FROM '.TAdmin::tableName()
            )->queryScalar();
            $model['list'] = self::getDb()->createCommand(
                'SELECT t1.* '.
                'FROM '.TAdmin::tableName().' AS t1 '.
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
