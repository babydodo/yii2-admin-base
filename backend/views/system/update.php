<?php
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\System */
/* @var $form kartik\form\ActiveForm */
?>

<div class="system-update">
    <div class="system-form">

        <?php $form = ActiveForm::begin(['type' => 'horizontal']); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
