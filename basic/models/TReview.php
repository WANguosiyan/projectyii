<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_review".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $cover_img 封面图
 * @property string $content 内容
 * @property string $summary 简介
 * @property int $sort 排序
 * @property int $create_time
 * @property int $update_time
 */
class TReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['sort', 'create_time', 'update_time'], 'integer'],
            [['title', 'cover_img', 'summary'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'cover_img' => 'Cover Img',
            'content' => 'Content',
            'summary' => 'Summary',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
