<?php

namespace backend\controllers;

use backend\models\ResetpwdForm;
use common\models\Adminuser;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * 个人中心控制器.
 */
class PersonalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * 首页
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    /**
     * 个人信息
     * @return mixed
     * @throws \Exception
     */
    public function actionView()
    {
        $model = Adminuser::findOne(Yii::$app->user->id);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * 修改个人信息
     * @return mixed
     * @throws \Exception
     */
    public function actionUpdate()
    {
        $model = Adminuser::findOne(Yii::$app->user->id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->getSession()->setFlash('info', '修改成功...');
            return $this->redirect(['view']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * 修改密码
     * @return mixed
     * @throws \Exception
     */
    public function actionChangePwd()
    {
        $adminuser = Adminuser::findOne(Yii::$app->user->id);
        $model = new ResetpwdForm($adminuser);

        if($model->load(Yii::$app->request->post()) && $model->resetPassword()){
            Yii::$app->getSession()->setFlash('info', '修改成功...');
            return $this->redirect(['view']);
        }

        return $this->render('change-pwd', [
            'model' => $model,
        ]);
    }


}
