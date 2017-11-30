<?php

use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
/* @var $form kartik\form\ActiveForm */

$this->title = '修改个人信息';
$this->params['breadcrumbs'][] = '更新个人信息';
?>

<div class="personal-update">
    <div class="personal-form col-md-11">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-primary">提交</button>
                    <button type="reset" class="btn btn-danger">重置</button>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
