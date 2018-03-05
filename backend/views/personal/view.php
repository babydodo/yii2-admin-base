<?php

use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '个人信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <a href="<?= Url::to(['personal/update'])?>" class="btn btn-default">更新资料</a>
    <a href="<?= Url::to(['personal/change-pwd'])?>" class="btn btn-default">修改密码</a>
</p>
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
                'format' => 'html',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>