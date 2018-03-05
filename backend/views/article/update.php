<?php
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form kartik\form\ActiveForm */
/* @var $preview array */
/* @var $previewConfig array */

$this->title = '修改文章信息';
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>

<div class="partner-update">
    <div class="partner-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_image')->widget(FileInput::classname(), [
                'options' => ['multiple' => false],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['png', 'jpg', 'gif'],
                    'showUpload' => false, // 是否显示上传按钮
                    'msgPlaceholder' => '请选择文件',
                    // 是否展示预览图
                    'initialPreviewAsData' => true,
                    // 需要预览的文件格式
                    'previewFileType' => 'image',
                    // 预览的文件
                    'initialPreview' => Url::to('@uploadUrl/article/').$model->title_image,
                    'showRemove' => false,
                    'initialPreviewShowDelete' => false,
                ]
            ]) ?>

            <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    // 'showUpload' => false, // 是否显示上传按钮
                    'showRemove' => false,
                    'allowedFileExtensions' => ['png', 'jpg', 'gif'],
                    'msgPlaceholder' => '请选择文件',
                    // 是否展示预览图
                    'initialPreviewAsData' => true,
                    // 需要预览的文件格式
                    'previewFileType' => 'image',
                    // 预览的文件
                    'initialPreview' => $preview,
                    // 需要展示的图片设置，比如图片的宽度等
                    'initialPreviewConfig' => $previewConfig,

                    // 异步上传的接口地址设置
                    'uploadUrl' => Url::toRoute(['async-img']),
                    // 异步上传需要携带的其他参数，比如商品id等
                    'uploadExtraData' => [
                        'id' => $model->id,
                    ],
                    'uploadAsync' => true, // 批量传输

                    'maxFileCount' => 20,
                    'overwriteInitial' => false,
                ]
            ]) ?>

            <?= $form->field($model, 'content')->widget(Redactor::className(), [
                'clientOptions' => [
                    'minHeight' => 500,
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['fontcolor','imagemanager','table','video'],
                ]
            ]) ?>

            <?= $form->field($model, 'status')->widget(SwitchInput::className(), [
                'pluginOptions' => [
                    'onText' => '显示',
                    'offText' => '隐藏',
                    'onColor' => 'success',
                    'offColor' => 'danger',
                ],
                'containerOptions' => ['class' => false],
            ]) ?>

            <?= $form->field($model, 'sort')->input('number')->hint('数值越大越靠前') ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-primary">提交</button>
                    <button type="reset" class="btn btn-danger">重置</button>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
