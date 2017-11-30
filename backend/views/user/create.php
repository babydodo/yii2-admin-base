<?php

use common\models\User;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form kartik\form\ActiveForm */
?>

<div class="user-create">
    <div class="user-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_repeat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->radioButtonGroup(User::allStatus()) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>

