<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',

    // 模块
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],

    // 组件
    'components' => [
        // 请求
        'request' => [
            'cookieValidationKey' => '',
            // 增加Json参数解析
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        // 响应
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $data = [];
                if ($event->sender->getStatusCode() != 200) {
                    $data['code'] = $event->sender->getStatusCode();
                    $data['msg'] = $event->sender->statusText;
                    $event->sender->setStatusCode(200);
                } else {
                    if (isset($event->sender->data['code'])) {
                        $data['code'] = $event->sender->data['code'];
                    }
                    if (isset($event->sender->data['data'])) {
                        $data['data'] = $event->sender->data['data'];
                    }
                    if (isset($event->sender->data['msg'])) {
                        $data['msg'] = $event->sender->data['msg'];
                    }
                }
                $event->sender->data = $data;
                $event->sender->format = yii\web\Response::FORMAT_JSON;
            },
        ],
        // 用户组件
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        // 日志
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // URL
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/url-rules.php'),
        ],

    ],
    'params' => $params,
];
