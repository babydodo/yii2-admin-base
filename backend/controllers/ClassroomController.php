<?php

namespace backend\controllers;

use Yii;
use common\models\Classroom;
use backend\controllers\ClassroomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * Classroom 模型控制器.
 */
class ClassroomController extends Controller
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
     * 首页（显示记录列表）Classroom.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel  = new ClassroomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 查看详情 Classroom.
     * @param integer $id
     * @return mixed
     * @throws \Exception
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'   => "Classroom #".$id,
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
     * 插入一条记录 Classroom.
     * 只允许Ajax请求
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model   = new Classroom();

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                return [
                    'title'   => "创建 Classroom",
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
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 修改记录：Classroom .
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
                    'title'   => "更新 Classroom #".$id,
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
     * 删除记录 Classroom (从列表删除，删除后刷新列表页面).
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
     * 批量删除记录 Classroom.
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
     * 根据 Classroom 模型主键查询一行记录.
     * 如果记录不存在, 抛出404异常.
     * @param integer $id
     * @return Classroom
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Classroom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在~');
        }
    }
}
