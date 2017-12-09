<?php
use yii\helpers\Html;
use backend\models\Usuario;
/* @var $this \yii\web\View */
/* @var $content string */


if ((Yii::$app->controller->action->id === 'login') 
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'cliente'))
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'empresa'))                
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'administrador'))                
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'clienteregistro'))                                  
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'clienteconfirmaregistro'))
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'clienterecuperarcontrasenia'))
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'empresaregistro')) 
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'empresaconfirmaregistro'))                
        OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'empresarecuperarcontrasenia'))
                
    ) 
{ 
/**
 *   OR (((Yii::$app->controller->id === 'login')) AND (Yii::$app->controller->action->id === 'clienteregistro')) 
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
//    echo $this->render(
//        'main-login',
//        ['content' => $content]
//    );
    
    
    if((Yii::$app->controller->action->id === 'cliente')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    }
    
    if((Yii::$app->controller->action->id === 'empresa')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    }
    
    if((Yii::$app->controller->action->id === 'administrador')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    }
    
    if((Yii::$app->controller->action->id === 'clienteregistro')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    } 
    
    if((Yii::$app->controller->action->id === 'clienteconfirmaregistro')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    }      
    
    if((Yii::$app->controller->action->id === 'clienterecuperarcontrasenia')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    } 
    
    if((Yii::$app->controller->action->id === 'empresaregistro')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    } 

    if((Yii::$app->controller->action->id === 'empresaconfirmaregistro')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    } 
    
    if((Yii::$app->controller->action->id === 'empresarecuperarcontrasenia')){
    echo $this->render(
        'main-login',
        ['content' => $content]
    );        
    } 
    
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
        backend\assets\LoginAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);        
    


    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
            
<?php if (Yii::$app->session->get('ss_user')): ?>   
    <?php $usersession = new Usuario(); 
           $usersession =Yii::$app->session->get('ss_user');
           switch($usersession->intCodigoRol) {
               case 10: ?>
                    <body class="hold-transition skin-cliente sidebar-mini">
    <?php            break;
               case 11: ?>
                    <body class="hold-transition skin-empresa sidebar-mini">
    <?php            break;
               case 12: ?>
                    <body class="hold-transition skin-blue sidebar-mini">
    <?php            break;            
               default : ?>
                    <body class="hold-transition skin-blue sidebar-mini">               
    <?php       }?>
<?php else: ?>
    <body class="hold-transition skin-blue sidebar-mini">
<?php endif; ?>
        
        
        
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
