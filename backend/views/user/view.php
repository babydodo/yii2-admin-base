<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */
?>

<div class="user-view">
 
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
                'attribute' => 'status',
                'value' => $model->getStatusStr(),
                'format' => 'html',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>