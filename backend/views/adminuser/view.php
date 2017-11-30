<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
?>

<div class="adminuser-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                // 'label' => 'Id',
            ],
            [
                'attribute' => 'username',
                // 'label' => 'Username',
            ],
            [
                'attribute' => 'email',
                // 'label' => 'Email',
            ],
            [
                'attribute' => 'statusStr',
                // 'label' => 'Status',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>