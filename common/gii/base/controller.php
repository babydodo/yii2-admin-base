<?php
/**
 * 生成控制器文件的模板.
 */

use yii\helpers\StringHelper;
use yii\db\ActiveRecordInterface;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * <?= $modelClass ?> 模型控制器.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
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
     * 首页（显示记录列表）<?= $modelClass ?>.
     * @return mixed
     */
    public function actionIndex()
    {    
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel  = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
    }

    /**
     * 查看详情 <?= $modelClass ?>.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws \Exception
     */
    public function actionView(<?= $actionParams ?>)
    {   
        $request = Yii::$app->request;
        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'   => "<?= $modelClass ?> #".<?= $actionParams ?>,
                'size'    => 'normal',
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel(<?= $actionParams ?>),
                ]),
                'footer' => Html::button('<i class="glyphicon glyphicon-ban-circle"></i> 关闭', [
                    'class'        => 'btn btn-danger',
                    'data-dismiss' => 'modal',
                ])
            ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel(<?= $actionParams ?>),
            ]);
        }
    }

    /**
     * 插入一条记录 <?= $modelClass ?>.
     * 只允许Ajax请求
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model   = new <?= $modelClass ?>();

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                return [
                    'title'   => "创建 <?= $modelClass ?>",
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
     * 修改记录：<?= $modelClass ?> .
     * 只允许Ajax请求
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws \Exception
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $request = Yii::$app->request;
        $model   = $this->findModel(<?= $actionParams ?>);

        if($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'  => true,
                    'forceReload' => '#crud-datatable-pjax',
                ];
            } else {
                 return [
                    'title'   => "更新 <?= $modelClass ?> #".<?= $actionParams ?>,
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
                        'type'  => 'submit'
                    ])
                ];        
            }
        }
        throw new NotFoundHttpException('页面不存在~');
    }

    /**
     * 删除记录 <?= $modelClass ?> (从列表删除，删除后刷新列表页面).
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws \Exception
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        $request = Yii::$app->request;
        $this->findModel(<?= $actionParams ?>)->delete();

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
     * 批量删除记录 <?= $modelClass ?>.
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
     * 根据 <?= $modelClass ?> 模型主键查询一行记录.
     * 如果记录不存在, 抛出404异常.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?= $modelClass . "\n"?>
     * @throws NotFoundHttpException
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在~');
        }
    }
}
