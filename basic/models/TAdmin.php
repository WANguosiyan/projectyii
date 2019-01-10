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
            'login_count' => 'Login Count',
            'update_time' => 'Update Time',
            'disabled' => 'Disabled',
        ];
    }
}
