<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_enterprise".
 *
 * @property string $id
 * @property string $name 公司名称
 * @property string $address 地址
 * @property string $email 邮箱
 * @property string $tel 联系方式
 * @property string $abstract 公司简介
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property string $linkman 联系人信息
 */
class TEnterprise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_enterprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['abstract'], 'string'],
            [['create_time', 'update_time'], 'integer'],
            [['name', 'address', 'email', 'tel', 'linkman','logo','qr_code','copyright','abstract_img'], 'string', 'max' => 255],
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
            'address' => 'Address',
            'email' => 'Email',
            'tel' => 'Tel',
            'abstract' => 'Abstract',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'linkman' => 'Linkman',
            'logo' => 'logo',
            'qr_code'=>'Qr code',
            'copyright'=>'Copyright',
            'abstract_img'=>'Abstract img'
        ];
    }
}
