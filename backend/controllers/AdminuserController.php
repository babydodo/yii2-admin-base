<?php

namespace backend\controllers;

use backend\models\AddAdminForm;
use backend\models\AdminuserSearch;
use backend\models\ResetpwdForm;
use Yii;
use common\models\Adminuser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * Adminuser 模型控制器.
 */
class AdminuserController extends Controller
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
                    'delete'      => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 首页（显示记录列表）Adminuser.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel  = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 查看详情 Adminuser.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'   => "管理员 #".$id,
                'size'    => 'normal',
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                    'class'        => 'btn btn-danger',
                    'data-dismiss' => 'modal',
                ])
            ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * 插入一条记录 Adminuser.
     * 只允许Ajax请求
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model   = new AddAdminForm();
        $model->status = Adminuser::STATUS_ACTIVE;

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($model->load($request->post())){
                if($model->addAdminuser()) {
                    return [
                        'forceClose'  => true,
                        'forceReload' => '#crud-datatable-pjax',
                    ];
                }
            }

            return [
                'title'   => '新增管理员',
                'size'    => 'large',
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' => Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                        'class'        => 'btn btn-danger',
                        'data-dismiss' => 'modal'
                    ])
                    .Html::button('<i class="glyphicon glyphicon-ok"></i> 保存', [
                        'class' => 'btn btn-primary',
                        'type'  => 'submit'
                    ])
            ];

        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 修改记录：Adminuser .
     * 只允许Ajax请求
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model   = $this->findModel($id);

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                 return [
                    'title'   => "更新管理员 #".$id,
                    'size'    => 'large',
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                        'class'        => 'btn btn-danger',
                        'data-dismiss' => 'modal',
                    ])
                    . Html::button('<i class="glyphicon glyphicon-ok"></i> 保存', [
                        'class' => 'btn btn-primary',
                        'type'  => "submit"
                    ])
                ];        
            }
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 修改密码：Adminuser .
     * 只允许Ajax请求
     * @param integer $id
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionResetPwd($id)
    {
        $request = Yii::$app->request;
        $adminuser = $this->findModel($id);
        $model   = new ResetpwdForm($adminuser);
        $model->setScenario('resetPwd');

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->resetPassword()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                return [
                    'title'   => '修改密码: '.$adminuser->username,
                    'size'    => 'normal',
                    'content' => $this->renderAjax('reset-pwd', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                            'class'        => 'btn btn-danger',
                            'data-dismiss' => 'modal',
                        ])
                        . Html::button('<i class="glyphicon glyphicon-ok"></i> 保存', [
                            'class' => 'btn btn-primary',
                            'type'  => "submit"
                        ])
                ];
            }
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 删除记录 Adminuser (从列表删除，删除后刷新列表页面).
     * @param integer $id
     * @return mixed
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose'  => true,
                'forceReload' => '#crud-datatable-pjax'
            ];
        }else{
            return $this->redirect(['index']);
        }

    }

    /**
     * 批量删除记录 Adminuser.
     * @return mixed
     * @throws \Exception
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks     = explode(',', $request->post( 'pks' ));
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose'  => true,
                'forceReload' => '#crud-datatable-pjax'
            ];
        } else {
            return $this->redirect(['index']);
        }
       
    }

    /**
     * 根据 Adminuser 模型主键查询一行记录.
     * 如果记录不存在, 抛出404异常.
     * @param integer $id
     * @return Adminuser
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在~');
        }
    }
}
