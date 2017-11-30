<?php

use common\models\Adminuser;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
/* @var $form kartik\form\ActiveForm */
?>

<div class="adminuser-update">
    <div class="adminuser-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->radioButtonGroup(Adminuser::allStatus()) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
