<?php
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form kartik\form\ActiveForm */

$this->title = '添加文章';
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = '新增';
?>

<div class="article-create">
    <div class="article-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_image')->widget(FileInput::classname(), [
                'options' => ['multiple' => false],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['png', 'jpg', 'gif'],
                    'showUpload' => false, // 是否显示上传按钮
                    'msgPlaceholder' => '请选择文件',
                    'showRemove' => false,
                ]
            ]) ?>

            <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['png', 'jpg', 'gif'],
                    'msgPlaceholder' => '请选择文件',
                    'showUpload' => false,
                ]
            ]) ?>

            <?= $form->field($model, 'content')->widget(Redactor::className(), [
                'clientOptions' => [
                    'minHeight' => 500,
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['fontsize','fontcolor','imagemanager','table','video'],
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

