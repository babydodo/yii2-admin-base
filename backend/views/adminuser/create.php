<?php

use common\models\Adminuser;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \backend\models\AddAdminForm */
/* @var $form kartik\form\ActiveForm */
?>

<div class="adminuser-create">
    <div class="adminuser-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_repeat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->radioButtonGroup(Adminuser::allStatus()) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>

