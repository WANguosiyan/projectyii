<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_brandplan".
 *
 * @property string $id
 * @property string $name
 * @property string $content
 * @property int $create_time
 * @property int $update_time
 */
class TBrandplan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_brandplan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content','recommend','introduce','characteristic'], 'string'],
            [['create_time', 'update_time'], 'integer'],
            [['name','img'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'recommend'=>'Recommend',
            'introduce'=>'introduce',
            'characteristic'=>'characteristic',
            'img'=>'Img'
        ];
    }
}
