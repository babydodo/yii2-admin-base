<?php
namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * 前台登陆表单模型
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    /**
     * 字段验证规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            // 自定义验证密码规则
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 字段名
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'   => '用户名',
            'password'   => '密码',
            'rememberMe' => '自动登陆',
        ];
    }

    /**
     * 验证密码 (rule)
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误.');
            }
        }
    }

    /**
     * 登陆验证
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * 根据username查询用户账号
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
