<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\UsuarioClienteRegConf*/

$this->title = 'Confirmar registro';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-ok-sign form-control-feedback'></span>"
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
                    <p class="login-box-msg no-margin no-padding"><br>Confirmar registro</p>
                    <div id="idfrmLogin" class="pad-all-40">
                        
                        <?= Yii::$app->session->getFlash('msg') ?>   
                        
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>


       <?= $form->field($model, 'intIdUsuario')->hiddenInput()->label(false) ?>
       <?= $form->field($model, 'vchCorreo')->hiddenInput()->label(false) ?>
       <?= $form->field($model, 'vchCodigoVerUsu')->hiddenInput()->label(false) ?>
                            
        <?= $form
            ->field($model, 'vchCodigoVer', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('vchCodigoVer'),'maxlength' => true]) ?>
                                                
        <?= Html::submitButton('Confirmar', ['class' => 'btn btn-block btn-lg btn-personalizado-2 btn-flat mar-top-20', 'name' => 'login-button']) ?>
        
        <?php ActiveForm::end(); ?>
        </div>
                    
        <!-- /.social-auth-links -->                
    </div>  
   
</div>

</div>