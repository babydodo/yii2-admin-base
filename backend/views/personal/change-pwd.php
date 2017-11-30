<?php

use common\models\Adminuser;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
/* @var $form kartik\form\ActiveForm */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = '个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminuser-change-pwd">
    <div class="adminuser-form col-md-11">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-primary">提交</button>
                    <button type="reset" class="btn btn-danger">重置</button>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
