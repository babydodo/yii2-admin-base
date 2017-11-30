<?php

namespace backend\models;

use common\models\Adminuser;
use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

/**
 * 重置密码表单
 *
 * @property string $old_password
 * @property string $new_password
 * @property string $password_repeat
 */
class ResetpwdForm extends Model
{
    public $old_password;
    public $new_password;
    public $password_repeat;

    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param User|Adminuser $user
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException
     */
    public function __construct($user, $config = [])
    {
        if (empty($user)) {
            throw new InvalidParamException('用户模型不能为空.');
        }
        $this->_user = $user;
        parent::__construct($config);
    }

    /**
     * 属性验证规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['old_password', 'required'],
            ['old_password', 'string', 'min' => 5],
            // 自定义验证密码规则
            ['old_password', 'validatePassword'],

            ['new_password', 'required'],
            ['new_password', 'string', 'min' => 5],

            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'new_password', 'message' => '两次密码不一致！'],

        ];
    }

    /**
     * 验证场景
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['resetPwd'] = ['new_password', 'password_repeat'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password'    => '原密码',
            'new_password'    => '新密码',
            'password_repeat' => '确认密码',
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
            if (!$this->_user || !$this->_user->validatePassword($this->old_password)) {
                $this->addError($attribute, '原密码不正确.');
            }
        }
    }

    /**
     * 更新密码
     * @return bool
     */
    public function resetPassword()
    {
        if(!$this->validate()) {
            return false;
        }

        $this->_user->setPassword($this->new_password);
        $this->_user->removePasswordResetToken();

        return $this->_user->save() ? true : false;
    }

}
