<?php

namespace backend\controllers;

use Yii;
use common\models\System;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * System 模型控制器.
 */
class SystemController extends Controller
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
     * 首页（显示记录列表）System.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel  = new SystemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 插入一条记录 System.
     * 只允许Ajax请求
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model   = new System();

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                return [
                    'title'   => '添加配置项',
                    'size'    => 'normal',
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
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 修改记录：System .
     * 只允许Ajax请求
     * @param integer $id
     * @return mixed
     * @throws \Exception
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
                    'title'   => '更新: '.($model->name ? $model->name : $model->key),
                    'size'    => 'normal',
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                        'class'        => 'btn btn-danger',
                        'data-dismiss' => 'modal',
                    ])
                    . Html::button('<i class="glyphicon glyphicon-ok"></i> 保存', [
                        'class' => 'btn btn-primary',
                        'type'  => 'submit'
                    ])
                ];        
            }
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 删除记录 System (从列表删除，删除后刷新列表页面).
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
     * 批量删除记录 System.
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
     * 根据 System 模型主键查询一行记录.
     * 如果记录不存在, 抛出404异常.
     * @param integer $id
     * @return System
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = System::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在~');
        }
    }
}
