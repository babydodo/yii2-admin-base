<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $title_image 主图片
 * @property string $images 图片集
 * @property string $content 内容
 * @property int $sort 排序
 * @property int $status 状态 0隐藏 1显示
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Article extends ActiveRecord
{
    const STATUS_HIDE = 0;
    const STATUS_SHOW = 1;

    const DEFAULT_SORT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['sort', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],

            ['title_image', 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'gif'], 'checkExtensionByMimeType' => false],
            ['images', 'file', 'maxFiles' => 20, 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'gif'], 'checkExtensionByMimeType' => false],

            ['sort', 'default', 'value' => self::DEFAULT_SORT],
            ['status', 'default', 'value' => self::STATUS_SHOW],
            ['status', 'in', 'range' => [self::STATUS_SHOW, self::STATUS_HIDE]],
        ];
    }

    /**
     * 验证场景
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['title', 'content', 'sort', 'status'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'title_image' => '主图片',
            'images' => '图片集',
            'content' => '内容',
            'sort' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 所有状态
     * @return array
     */
    public static function allStatus()
    {
        return [
            self::STATUS_SHOW => '显示',
            self::STATUS_HIDE => '隐藏',
        ];
    }

    /**
     * 增加statusStr属性, 状态图标
     * @return string
     */
    public function getStatusStr()
    {
        if($this->status == self::STATUS_SHOW) {
            return '<span class="glyphicon glyphicon-ok" style="color:#3c763d"></span>';
        } elseif($this->status == self::STATUS_HIDE) {
            return '<span class="glyphicon glyphicon-remove" style="color:#a94442"></span>';        }
        return '';
    }
}
