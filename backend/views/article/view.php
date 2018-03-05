<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
?>

<div class="article-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                // 'label' => 'ID',
            ],
            [
                'attribute' => 'title',
                // 'label' => '标题',
            ],
            [
                'attribute' => 'title_image',
                'format' => 'raw',
                'value' => Html::img(Url::to('@uploadUrl/article/').$model->title_image, ['height' => 200]),
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusStr(),
                'format' => 'html',
            ],
            'sort',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>