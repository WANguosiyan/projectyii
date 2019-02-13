<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_curriculum".
 *
 * @property string $id
 * @property string $name 课程体系名称
 * @property string $cover_img 封面图
 * @property string $content 内容
 * @property int $create_time
 * @property int $update_time
 * @property int $sort
 */
class TCurriculum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_curriculum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_time', 'update_time', 'sort'], 'integer'],
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
            'sort' => 'Sort',
        ];
    }
}
