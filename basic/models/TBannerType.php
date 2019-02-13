<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_banner_type".
 *
 * @property string $id
 * @property int $pid
 * @property string $type_name
 * @property string $sort
 * @property int $create_time
 * @property int $update_time
 */
class TBannerType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_banner_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'create_time', 'update_time'], 'integer'],
            [['type_name', 'sort'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'type_name' => 'Type Name',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
