<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\System */
?>

<div class="system-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                // 'label' => 'ID',
            ],
            [
                'attribute' => 'name',
                // 'label' => '名称',
            ],
            [
                'attribute' => 'key',
                // 'label' => '键',
            ],
            [
                'attribute' => 'value',
                // 'label' => '值',
            ],
        ],
    ]) ?>

</div>