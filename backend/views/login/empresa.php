<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Ingresar';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$script = <<< JS
    
  $(function () {        
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-blue',
      increaseArea: '10%' 
    });
  });        
JS;
$this->registerJs($script);

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
                    <p class="login-box-msg no-margin no-padding"><br>Iniciar session</p>
                    <div id="idfrmLogin" class="pad-all-40">
                        
                        
                        
                    <?= Yii::$app->session->getFlash('msg') ?>  

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                
        <div class="clearfix" style="vertical-align: middle;margin-top:-10px;">   
            <div class="login-page-cliente-recordar"> 
                    <?= $form                            
                            ->field($model, 'rememberMe')
                            ->checkbox(['class' => 'icheck','id'=>'chkLoginClienteRecuerdame'])
                            ->label('Recuerdame') ?>                
            </div>
                   
<!--            <a href="#" class="login-page-cliente-recuperar" id="page-signin-forgot-link">
                Recuperar password               
            </a>-->

        <?= Html::a(
            'Restaurar password',
            ['/login/empresarecuperarcontrasenia'],
            ['class' => 'login-page-cliente-recuperar']
        ) ?>
            
        </div>
        
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-block btn-lg btn-personalizado-2 btn-flat mar-top-20', 'name' => 'login-button']) ?>
        
        <?php ActiveForm::end(); ?>
        </div>
                   
                    
<!--        <div class="div-login-social">            
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
                <i class="fa fa-facebook"></i>
                <div class="text-center">
                    Ingresar con <strong>Facebook</strong>
                </div> 
            </a>
        </div>-->
                    
        <div class="div-login-social-empresa">            
            <?php use yii\authclient\widgets\AuthChoice; ?>
            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['login/authempresa'], 'autoRender' => false]); ?>
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <?= Html::a( '<i class="fa fa-facebook"></i>
                            <div class="text-center">
                                Ingresar con <strong>'. $client->title.'</strong>                    
                            </div>', 
                    ['login/authempresa', 'authclient'=> $client->name, ], 
                    ['class' => "btn btn-block btn-social btn-facebook btn-flat $client->name "]
                    ) ?>
            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>
        <!-- /.social-auth-links -->                
    </div>  
    <div class="link-registrar-empresa" id="id_registrar_link">
        ¿Aún no eres miembro?        
        <?= Html::a(
            '<u>Unete a nosotros ahora</u>',
            ['/login/empresaregistro'],
            ['class' => 'text-color-primario-no-link']
        ) ?>        
    </div>
    
</div>


</div>
               
