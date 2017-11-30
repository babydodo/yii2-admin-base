<?php

namespace backend\models;

use common\models\Adminuser;
use yii\base\Model;

/**
 * 新增管理员表单
 *
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property string $email
 * @property integer $status
 */
class AddAdminForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $status;

    /**
     * 字段验证规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已存在.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮箱已被使用.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 5],

            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 5],
            ['password_repeat', 'compare', 'compareAttribute'=>'password','message'=>'两次密码不一致！'],

            ['status', 'default', 'value' => Adminuser::STATUS_ACTIVE],
            ['status', 'in', 'range' => [Adminuser::STATUS_ACTIVE, Adminuser::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'        => '用户名',
            'email'           => '邮箱',
            'password'        => '密码',
            'password_repeat' => '确认密码',
            'status'          => '状态',
        ];
    }

    /**
     * 新增管理员
     * @return Adminuser|null
     * @throws \yii\base\Exception
     */
    public function addAdminuser()
    {
        if(!$this->validate()) {
            return null;
        }

        $adminuser           = new Adminuser();
        $adminuser->username = $this->username;
        $adminuser->email    = $this->email;
        $adminuser->status   = $this->status;
        $adminuser->setPassword($this->password);
        $adminuser->generateAuthKey();

        return $adminuser->save() ? $adminuser : null;
    }
}
