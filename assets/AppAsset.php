<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/';
    public $css = [
        //        'css/site.css',
        'theme/adminlte3/plugins/fontawesome-free/css/all.min.css',
        'theme/adminlte3/dist/css/adminlte.min.css',
        //'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'theme/adminlte3/plugins/pace-progress/themes/black/pace-theme-flat-top.css'
    ];
    public $js = [
        'theme/adminlte3/dist/js/adminlte.min.js',
        '//cdn.jsdelivr.net/npm/sweetalert2@11',
        // 'theme/adminlte3/plugins/pace-progress/pace.min.js',
        // 'theme/adminlte3/plugins/pace-progress/pace.min.js',
        'js/keperluan.js',
        'js/site.js',
        'js/yii-overide.js'
    ];
    public $jsOptions = [
    'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'app\assets\VueAssets',
        'app\assets\SweetAlertAsset',
        //        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
