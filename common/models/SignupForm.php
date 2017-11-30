<?php
namespace common\models;

use common\models\User;
use yii\base\Model;

/**
 * 注册表单(新增用户)
 *
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property string $email
 * @property integer $status
 */
class SignupForm extends Model
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
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '邮箱已被使用.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 5],

            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 5],
            ['password_repeat', 'compare', 'compareAttribute'=>'password','message'=>'两次密码不一致！'],

            ['status', 'default', 'value' => User::STATUS_ACTIVE],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_DELETED]],
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
     * 新增用户
     * @return User|null
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
