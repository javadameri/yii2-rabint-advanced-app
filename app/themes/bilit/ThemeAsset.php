<?php

namespace app\themes\bilit;

use Yii;
use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{

    public $publishOptions = ['forceCopy' => true];
    public $sourcePath = '@app/themes/bilit/web';
    public $css = [
        'css/bootstrap-custom.css',
        'vendor/fonts/tabler/tabler-icons.css',
        'vendor/fonts/vazir/css/Vazirmatn-FD-font-face.css',
        'css/style.css',
        "vendor/lib/nouislider/nouislider.min.css",
        "vendor/lib/tom-select/tom-select.min.css",
        "vendor/lib/jalaliDatePicker/jalalidatepicker.min.css",
        "vendor/lib/swiper/swiper-bundle.min.css",
    ];
    public $js = [
        "vendor/lib/jalaliDatePicker/jalalidatepicker.min.js",
        "js/script.js",
        "vendor/lib/nouislider/nouislider.min.js",
        "vendor/lib/tom-select/tom-select.complete.min.js",
        "vendor/lib/swiper/swiper-bundle.min.js",
        "vendor/lib/bootstrap/js/bootstrap.bundle.min.js",
        "vendor/lib/lozad/lozad.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
//        'rabint\assets\Bootstrap4RtlAsset',
        'rabint\assets\CommonAsset',
        'rabint\assets\font\VazirAsset',
        //        'rabint\assets\FontAwesomeAsset',
    ];


}


