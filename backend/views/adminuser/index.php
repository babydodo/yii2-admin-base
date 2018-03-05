<?php

use common\models\Adminuser;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use shmilyzxt\kartikcrud\CrudAsset;
use shmilyzxt\kartikcrud\BulkButtonWidget;
use shmilyzxt\kartikcrud\ShmilyzxtHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\controllers\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id'           => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'pjax'         => true,
            'condensed'    => true,
            'hover'        => true,
            'bordered'     => false,

            // 布局设定
            'panel' => [
                'type'    => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> 管理员列表',
                'before'  => BulkButtonWidget::widget([
                    'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; 删除选中项', ['bulk-delete'], [
                        'class'                => 'btn btn-danger',
                        'role'                 => 'modal-remote-bulk',
                        'data-confirm'         => false,
                        'data-method'          => false,   // 覆盖Yii默认实现的方法
                        'data-request-method'  => 'post',
                        'data-confirm-title'   => '确认操作',
                        'data-confirm-message' => '你确定要执行删除操作吗？'
                    ]),
                ]),
                'after'   => false,
            ],

            // 工具组件
            'toolbar' => [
                [
                    'content' => Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                            'role'  => 'modal-remote',
                            'title' => '新增管理员',
                            'class' => 'btn btn-default'
                        ]) . Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], [
                            'data-pjax' => true,
                            'class'     => 'btn btn-default',
                            'title'     => '重置'
                        ]) . '{toggleData}' . '{export}'
                ],
            ],

            // 主体内容
            'columns' => [
                // 复选框列
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '40px',
                ],

                // 序号列
                [
                    'class' => 'kartik\grid\SerialColumn',
                ],

                // 数据列
                'username',
                'email',
                [
                    'attribute' => 'status',
                    'value'     => 'statusStr',
                    'filter'    => Adminuser::allStatus(),
                    'format'    => 'html',
                ],
                [
                    'attribute'           => 'created_at',
                    'format'              => 'datetime',
                    'filterType'          => \kartik\grid\GridView::FILTER_DATE_RANGE,
                    'filterWidgetOptions' => ([
                        'presetDropdown' => true,
                        'convertFormat'  => true,
                        'pluginOptions'  => [
                            'locale' => [
                                'format'      => 'Y/m/d',
                            ]
                        ],
                    ]),
                ],

                // 动作列按钮设定
                [
                    'class' => 'kartik\grid\ActionColumn', 'header' => '操作',
//                    'template' => ShmilyzxtHelper::filterActionColumn(['view', 'update', 'reset-pwd', 'delete']),
                    'template' => Helper::filterActionColumn('{view} {update} {reset-pwd} {delete}'),

                    // 重置密码按钮
                    'buttons'  => [
                        'reset-pwd' => function($url, $model) {
                            $options = [
                                'role'                 => 'modal-remote',
                                'title'                => '重置密码',
                                'data-confirm'         => false,
                                'data-method'          => false, // 覆盖yii默认实现的方法
                                'data-request-method'  => 'get',
                                'data-toggle'          => 'tooltip',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, $options);
                        },
                    ],

                    'viewOptions'   => ['role' => 'modal-remote', 'title' => '查看', 'data-toggle' => 'tooltip'],
                    'updateOptions' => ['role' => 'modal-remote', 'title' => '更新', 'data-toggle' => 'tooltip'],
                    'deleteOptions' => [
                        'role'                 => 'modal-remote',
                        'title'                => '删除',
                        'data-confirm'         => false,
                        'data-method'          => false, // 覆盖yii默认实现的方法
                        'data-request-method'  => 'post',
                        'data-toggle'          => 'tooltip',
                        'data-confirm-title'   => '确认操作',
                        'data-confirm-message' => '你确定要删除该记录吗？'
                    ],
                ],
            ],
        ]) ?>
    </div>
</div>

<!-- modal框 -->
<?php Modal::begin([
    'id'      => 'ajaxCrudModal',
    'footer'  => '', // 请不要删除
    'options' => [
        'data-backdrop' => 'static', // 点击空白处不隐藏
    ],
]) ?>
<?php Modal::end(); ?>

<?php CrudAsset::register($this); ?>


