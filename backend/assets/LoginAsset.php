<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    //public $baseUrl = '@web';
    public $css = [                                
            'plugins/iCheck/square/blue.css',                                      
    ];
    public $js = [            
            'plugins/iCheck/icheck.min.js',   
    ];
    public $depends = [            
    ];
}
