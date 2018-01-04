<?php
// 菜单回调函数
$callback = function($menu){
    $data   = json_decode($menu['data'], true);
    $return = [
        'label' => $menu['name'],
        'url'   => [$menu['route']],
        'items' => $menu['children'],
    ];

    // 处理data数据
    if ($data) {
        // icon图标
        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
        // options选项
        isset($data['options']) && $data['options'] && $return['options'] = $data['options'];
    }

    return $return;
};
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <?= \common\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => array_merge(
                    [
                        ['label' => '管理菜单', 'options' => ['class' => 'header']],
                    ],
                    mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null, $callback)
                ),
            ]
        ) ?>

    </section>

</aside>