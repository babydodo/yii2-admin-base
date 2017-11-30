<?php

use common\models\Adminuser;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
/* @var $form kartik\form\ActiveForm */
?>

<div class="adminuser-reset-pwd">
    <div class="adminuser-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_repeat')->textInput(['maxlength' => true]) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
