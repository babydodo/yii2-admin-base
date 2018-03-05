<?php
$params = array_merge(require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php');

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [
        // yii2-admin插件配置
        'admin'       => [
            'class'  => 'mdm\admin\Module',
//            'layout' => false
        ],
        // 富文本编辑器redactor
        'redactor' => [
            'class' => 'common\components\RedactorModule',
            'uploadDir' => '@upload',
            'uploadUrl' => '@uploadUrl',
            'imageAllowExtensions'=>['jpg', 'png', 'gif'],
        ],
        // gii配置 正式环境请注释 todo
        'gii' => [
            'generators' => [
                'kartikcrud' => [
                    'class'     => 'shmilyzxt\kartikcrud\generators\Generator',
                    'templates' => [
                        '基础模板' => '@common/gii/base',
                        '基础模板-ajax' => '@common/gii/base-ajax',
                    ],
                ],
            ],
        ],
        'gridview'    => [
            'class' => 'kartik\grid\Module',
        ],
        'datecontrol' => [
            'class'           => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date'     => 'd-m-Y',
                'time'     => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings'    => [
                'date'     => 'Y-m-d',
                'time'     => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            // automatically use kartik\widgets for each of the above formats
            'autoWidget'      => true,
        ]
    ],
    'components' => [
        'request'      => [
            'csrfParam' => '_csrf-backend',
        ],
        'user'         => [
            'identityClass'   => 'common\models\Adminuser',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            // 是否开启URL美化功能
            'enablePrettyUrl' => true,
            // 是否启用严格解析
            'enableStrictParsing' => false,
            // 是否在URL中显示入口脚本index.php
            'showScriptName' => false,
            // 指定续接在URL后面的后缀，如.html
            'suffix' => '',
            'rules' => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
            ],
        ],

        // yii2-admin插件配置
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 或者使用 'yii\rbac\PhpManager'
            'defaultRoles' => ['guest'],
        ],

        // 加载脚本管理
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        '/js/jquery-2.2.4-min.js'
                    ],
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
            ],
        ],
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        // 设置允许访问路由
        'allowActions' => [
//            '*',
            'site/*',
        ]
    ],

    'params' => $params,
];
