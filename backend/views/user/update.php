<?php

use common\models\User;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form kartik\form\ActiveForm */
?>

<div class="user-update">
    <div class="user-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->widget(SwitchInput::className(), [
                'pluginOptions' => [
                    'onText' => '正常',
                    'offText' => '禁用',
                    'onColor' => 'success',
                    'offColor' => 'danger',
                ],
                'containerOptions' => ['class' => false],
            ]) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
