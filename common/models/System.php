<?php

namespace common\models;

/**
 * system表 模型类
 *
 * @property int $id
 * @property string $name 名称
 * @property string $key 键
 * @property string $value 值
 */
class System extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'value'], 'trim'],
            [['key'], 'required'],
            [['name', 'key', 'value'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'key' => '键',
            'value' => '值',
        ];
    }
}
