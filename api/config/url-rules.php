<?php
/**
 * 基本的url规则配置
 * @param $unit
 * @return array
 */
function baseUrlRules($unit)
{
    $config = [
        'class' => 'yii\rest\UrlRule',
    ];
    return array_merge($config, $unit);
}

/**
 * 路由规则配置
 */
$urlRuleConfigs = [
    [
        'controller' => ['v1/system']
    ],
    [
        'controller' => ['v1/user'],
        'extraPatterns' => [
            'POST login' => 'login',
            'GET,OPTIONS user-profile' => 'user-profile', // OPTIONS配合支持跨域请求
        ],
    ],
];

return array_map('baseUrlRules', $urlRuleConfigs);