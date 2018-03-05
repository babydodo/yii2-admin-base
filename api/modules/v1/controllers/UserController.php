<?php

namespace api\modules\v1\controllers;

use api\models\LoginForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * @method authenticate($user, $request, $response)
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * @return array
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                    'class' => HttpBearerAuth::className(),
                    // 不需要认证的方法
                    'optional' => [
                        'login',
                    ],
                ]
            ],
            // 跨域访问配置
            [
            'corsFilter'  => [
                'class' => Cors::className(),
                'cors'  => [
                    'Origin' => ['*'], // 允许访问来源
                    'Access-Control-Request-Headers' => ['authorization'],
                ],
            ],
        ]);
    }

    /**
     * 登录
     */
    public function actionLogin ()
    {
        $model = new LoginForm;
        $model->setAttributes(Yii::$app->request->post());
        if (($user = $model->login())) {
            return [
                'code' => 0,
                'data' => [
                    'token' => $user->access_token
                ],
            ];
        } else {
            $errors = $model->errors;
            $firstError = current($errors);
            return [
                'code' => 10001,
                'msg' => $firstError[0]
            ];
        }
    }

    /**
     * 获取用户信息
     */
    public function actionUserProfile ()
    {
        // 到这一步，token都认为是有效的了
        // 下面只需要实现业务逻辑即可
        $user = $this->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->response);
        return [
            'code' => 0,
            'data' => [
                'username' => $user->username,
                'email' => $user->email,
            ],
        ];
    }


}
