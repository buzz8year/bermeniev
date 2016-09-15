<?php
namespace yii\easyii\assets;

class FancyboxAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/fancybox/source';

    public $css = [
        'jquery.fancybox.css',
        'jquery.fancybox-thumbs.css',
    ];
    public $js = [
        'jquery.event.move.js',
        'jquery.event.swipe.js',
        'jquery.fancybox.js',
        // 'jquery.fancybox.pack.js',
        'jquery.fancybox-thumbs.js'
    ];

    public $depends = ['yii\web\JqueryAsset'];
}
