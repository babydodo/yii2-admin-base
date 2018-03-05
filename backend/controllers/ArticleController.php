<?php

namespace backend\controllers;

use backend\models\ArticleSearch;
use common\models\Article;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * Article 模型控制器.
 */
class ArticleController extends Controller
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
     * 首页（显示记录列表）Article.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel  = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 查看详情 Article.
     * @param integer $id
     * @return mixed
     * @throws \Exception
     */
    public function actionView($id)
    {
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'   => '文章详情',
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
     * 插入一条记录 Article.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $model->status = Article::STATUS_SHOW;
        $model->sort = Article::DEFAULT_SORT;

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->title_image = UploadedFile::getInstance($model, 'title_image');
            $model->images = UploadedFile::getInstances($model, 'images');

            //文件上传存放的目录
            $dir = Yii::getAlias('@upload/article');
            if (!is_dir($dir))
                mkdir($dir, '0777', true);

            if ($model->validate()) {
                // 保存主图片
                $fileName = time() . '-' . rand(0,99999) . '.' . $model->title_image->extension;
                $fileDir = $dir.DIRECTORY_SEPARATOR. $fileName;
                $model->title_image->saveAs($fileDir);
                $model->title_image = $fileName;

                // 保存图片集
                $res = [];
                foreach ($model->images as $image) {
                    $fileName = time() . '-' . rand(0,99999) . '.' . $image->extension;
                    $fileDir = $dir.DIRECTORY_SEPARATOR. $fileName;
                    $image->saveAs($fileDir) && $res[] = $fileName;
                }
                $model->images = json_encode($res);

                // 写入数据库
                if($model->save(false)) {
                    Yii::$app->getSession()->setFlash('info', '添加成功...');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * 修改记录：Article .
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if(Yii::$app->request->isPost) {
            $title_image = $model->title_image; // 临时保存title_image的值

            // 如果有文件上传
            if(!empty($_FILES['Article']['name']['title_image'])) {
                // 保存上传文件
                $model->title_image = UploadedFile::getInstance($model, 'title_image');
                $dir = Yii::getAlias('@upload/article'); // 文件上传存放的目录
                if (!is_dir($dir))
                    mkdir($dir, '0777', true);
                $fileName = time() . '-' . rand(0,9999) . '.' . $model->title_image->extension;
                $fileDir = $dir.'/'. $fileName;
                if($model->title_image->saveAs($fileDir)) {
                    // 删除旧的图片
                    @unlink(Yii::getAlias('@upload/article/').$title_image);
                    $title_image = $fileName;

                };
            }

            $model->load(Yii::$app->request->post());
            $model->title_image = $title_image;
            unset($model->images);

            if($model->save()){
                Yii::$app->getSession()->setFlash('info', '修改成功...');
                return $this->redirect(['index']);
            }
        }

        // @param $preview Array 需要预览的图片集的url地址
        // @param $previewConfig Array 对应图片的设置
        $preview = $previewConfig = [];
        $imageUrl = Yii::getAlias('@uploadUrl/article');
        foreach (json_decode($model->images) as $k => $v) {
            $preview[$k] = $imageUrl.DIRECTORY_SEPARATOR.$v;
            $previewConfig[$k] = [
                // 要删除图片集的地址
                'url' => Url::toRoute(['delete-img', 'i'=>$k]),
                // 活动id
                'key' => $id,
            ];
        }

        return $this->render('update', [
            'preview' => $preview,
            'previewConfig' => $previewConfig,
            'model' => $model,
        ]);
    }

    /**
     * 异步上传图片集
     */
    public function actionAsyncImg ()
    {
        // 合伙人ID
        $id = Yii::$app->request->post('id');

        // $preview $previewConfig 是处理完图片之后需要返回的信息
        // @param $preview Array 需要预览的图片集的url地址
        // @param $previewConfig Array 对应图片的设置
        $preview = $previewConfig = [];

        // 如果没有图片或者合伙人id非真, 返回空
        if (empty($_FILES['Article']['name']) || empty($_FILES['Article']['name']['images']) || empty($id)) {
            echo '{}';
            return;
        }

        // 循环多张图片进行上传和上传后的处理
        for ($i=0; $i<count($_FILES['Article']['name']['images']); $i++) {
            $model = $this->findModel($id);
            // 保存图片
            $dir = Yii::getAlias('@upload/article'); //文件上传目录
            if (!is_dir($dir))
                mkdir($dir, '0777', true);

            $index = null;
            $fileName = time() . '-' . rand(0,99999);
            $fileDir = $dir.DIRECTORY_SEPARATOR. $fileName;
            if(move_uploaded_file($_FILES['Article']['tmp_name']['images'][$i], $fileDir)) {
                // 更新数据库
                $images = json_decode($model->images);
                $images[] = $fileName;
                $model->images = json_encode($images);
                if($model->save(false)) {
                    $index = count($images)-1;
                }
            }

            $preview[$i] = Yii::getAlias('@uploadUrl/article').DIRECTORY_SEPARATOR.$fileName;
            $previewConfig[$i] = [
                // 指定上传后的图片的异步删除请求地址
                'url' => $url = Url::toRoute(['delete-img', 'i'=>$index]),
                // 请求异步删除请求地址时附带的参数
                'key' => $id
            ];
        }

        // 返回上传成功后的图片信息
        echo json_encode([
            'initialPreview' => $preview,
            'initialPreviewConfig' => $previewConfig,
            'append' => true,
        ]);
        return;
    }

    /**
     * 异步删除图片集
     * @param integer $i images字段中图片的索引
     * @return array
     */
    public function actionDeleteImg ($i = null)
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        if(is_numeric($i)) {
            // key为合伙人的id
            if ($id = Yii::$app->request->post('key')) {
                $model = $this->findModel($id);
                $images = json_decode($model->images);
                array_splice($images, $i, 1);
                $model->images = json_encode($images);

                if($model->save(false)) {
                    return ['success' => true];
                }
            }
        }
        return ['error' => '删除失败'];
    }

    /**
     * 删除记录 Article (从列表删除，删除后刷新列表页面).
     * @param integer $id
     * @return mixed
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete() !== false) {
            @unlink(Yii::getAlias('@upload/article/').$model->title_image);
            foreach(json_decode($model->images) as $image) {
                @unlink(Yii::getAlias('@upload/article/').$image);
            }
        }

        if(Yii::$app->request->isAjax){
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
     * 批量删除记录 Article.
     * @return mixed
     * @throws \Exception
     */
    public function actionBulkDelete()
    {
        $pks     = explode(',', Yii::$app->request->post( 'pks' ));
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            if($model->delete() !== false) {
                @unlink(Yii::getAlias('@upload/article/').$model->title_image);
                foreach(json_decode($model->images) as $image) {
                    @unlink(Yii::getAlias('@upload/article/').$image);
                }
            }
        }

        if(Yii::$app->request->isAjax) {
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
     * 根据 Article 模型主键查询一行记录.
     * 如果记录不存在, 抛出404异常.
     * @param integer $id
     * @return Article
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在~');
        }
    }
}
