<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

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

$script = <<< JS
    
  $(function () {        
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '10%' 
    });

        
  });   
      

        
JS;
$this->registerJs($script);

?>

<div class="login-page-cliente">   
<div class="login-page-cliente-modal">       
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="box box-solid no-margin">                                          
            <div class="box-row">
            <div class="box-cell col-md-5 login-page-cliente-background-color-primario login-page-cliente-text-color-primario pad-all-30">                
              <div class="text-center">
                <a class="login-page-cliente-brand login-page-cliente-brand-lg text-left" href="www.expoboda.com">
                    <span class="login-page-cliente-logo mar-top-0">
                        <span class="login-page-cliente-icon">                            
                            <?= Html::img('@web/imagenes/iconLoginCliente2.png',[ 'width'=>'48','height'=>'48']);?>
                        </span> 
                    </span>                   
                    <span class="font-size-20 line-height-1" style="float: right;vertical-align: middle;margin-top: 14px;">Expobodas</span>
                </a>
                <div class="font-size-15 mar-top-10 line-height-1">Drisfuta,vive,goza.</div>
              </div>

              <ul class="list-group mar-top-20 mar-bottom-0 visible-md visible-lg">
                <li class="list-group-item list-group-item-li-login">
                    <i class="list-group-icon-login fa fa-sitemap "></i> Organice sus eventos </li>
                <li class="list-group-item list-group-item-li-login">
                    <i class="list-group-icon-login fa fa-file-text-o"></i> Listado de actividades</li>
                <li class="list-group-item list-group-item-li-login">
                    <i class="list-group-icon-login fa fa-outdent "></i> Presupuestos a escoger</li>
                <li class="list-group-item list-group-item-li-login">
                    <i class="list-group-icon-login fa fa-heart "></i> y mucho amor... </li>
              </ul>                    
                              
            </div>
                <div class="box-cell col-md-7 no-padding">


                <div class="login-box-body no-padding">
                    <p class="login-box-msg no-margin no-padding"><br>Registrar Cliente</p>
                    <div id="idfrmLogin" class="pad-all-20">     
                        <?= Yii::$app->session->getFlash('msg') ?>   
                                                
    <?php $form = ActiveForm::begin(['id' => 'login-registro-form', 'enableClientValidation' => false]); ?>
                            
        <?= $form
            ->field($model, 'vchNombres', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchNombres'),'maxlength' => true]) ?>                        

        <?= $form
            ->field($model, 'vchCorreo', $fieldOptions2)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchCorreo'),'maxlength' => true]) ?>  

        <?= $form
            ->field($model, 'vchClave', $fieldOptions3)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('vchClave'),'maxlength' => true]) ?>  
                            
    <div class="form-group">        
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-block btn-lg btn-personalizado-1 btn-flat mar-top-20', 'name' => 'login-registro-button']) ?>
    </div>

    <?php ActiveForm::end();?>
                        
                        
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
            </div>
          </div>                                                                                
        </div>
      </div>        
        
        
      <div class="link-registrar-cliente" id="id_registrar_link">
        ¿Ya eres miembro?        
        <?= Html::a(
            '<u>Ingresa aqui</u>',
            ['/login/cliente'],
            ['class' => 'login-page-cliente-text-color-primario']
        ) ?>
        
      </div>
        
    </div>        
  </div>
</div>

               
<div class="login-page-cliente-background" >
    <div class="login-page-cliente-background-overlay" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; opacity: 0.2;"></div>    
    <?= Html::img('@web/imagenes/f7.jpg', ['alt'=>'login expoboda', 'class'=>'style="width: 100%; left: 0px;"']);?>
</div>
