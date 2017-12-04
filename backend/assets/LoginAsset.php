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
            'plugins/iCheck/square/green.css',    
            'plugins/iCheck/square/pink.css', 
            'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 
            'bower_components/select2/dist/css/select2.min.css', 
    ];
    public $js = [            
            'plugins/iCheck/icheck.min.js',   
            'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',  
            'bower_components/select2/dist/js/select2.full.min.js',  
    ];
    public $depends = [            
    ];
}
