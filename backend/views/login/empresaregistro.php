<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\UsuarioempresaReg*/

$this->title = 'Registrar';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions4 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-registration-mark form-control-feedback'></span>"
];


?>

<div  class="login-page-empresa"> 
    
    <div class="login-page-empresa-container">
        
        <div class="login-page-empresa-container-imagen">            
            <?= Html::img('@web/imagenes/f3.jpg', ['alt'=>'login expoboda']);?>
        </div>
        <div class="login-page-empresa-container-caption">
            <h4 class="login-page-empresa-container-caption-title">
                <i class="fa fa-diamond text-success"> </i> 
                Expoboda
            </h4>
            <p>
                Muestrate,y sirve de inspiracion.
                Realiza los sueños de tus clientes.
            </p>
        </div> 
        
        
    </div>    
       
    
<div class="login-page-empresa-content">

    <div class="login-box-body no-padding">
                    <p class="login-box-msg no-margin no-padding"><br>Registrar empresa</p>
                    <div id="idfrmLogin" class="pad-all-40">
                        
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>


        <?= $form
            ->field($model, 'vchNombreComercial', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchNombreComercial'),'maxlength' => true]) ?>   
    
        <?= $form
            ->field($model, 'vchRuc', $fieldOptions4)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchRuc'),'maxlength' => true]) ?> 
    
        <?= $form
            ->field($model, 'vchCorreo', $fieldOptions2)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchCorreo'),'maxlength' => true]) ?>  

        <?= $form
            ->field($model, 'vchClave', $fieldOptions3)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('vchClave'),'maxlength' => true]) ?>      
                

        
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-block btn-lg btn-primary btn-flat mar-top-20', 'name' => 'login-button']) ?>
        
        <?php ActiveForm::end(); ?>
        </div>
                    
        <div class="div-login-social">            
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
                <i class="fa fa-facebook"></i>
                <div class="text-center">
                    Ingresar con <strong>Facebook</strong>
                </div> 
            </a>
        </div>
        <!-- /.social-auth-links -->                
    </div>  
    <div class="link-registrar-empresa" id="id_registrar_link">
        ¿Ya eres miembro?        
        <?= Html::a(
            '<u>Ingresa aqui</u>',
            ['/login/empresa'],
            ['class' => 'text-color-primario-no-link']
        ) ?>        
    </div>
    
</div>
    
    </div>
