<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
       'position' => \yii\web\View::POS_HEAD
    );
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',
        'css/site.css',
        'dist/css/app.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
        'dist/js/app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
