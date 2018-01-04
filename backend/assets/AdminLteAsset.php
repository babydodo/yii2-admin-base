<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
//    public $sourcePath = '@webroot';
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/AdminLTE.css',
        'css/skins/skin-blue.css',
    ];
    public $js = [
        'js/adminlte.min.js',
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
