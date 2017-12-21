<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Restaurar Password';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

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
                    <p class="login-box-msg no-margin no-padding">                        
                        <br>Restaurar password  <span data-toggle="tooltip" data-title="Se restaurará con una contraseña generada por nosotros, y se lo enviaremos por correo." class='glyphicon glyphicon-info-sign'></span>
                    </p>
                    <div id="idfrmLogin" class="pad-all-40">
                        
                        
                        <?= Yii::$app->session->getFlash('msg') ?>   
                    

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        
        <?= Html::submitButton('Restaurar', ['class' => 'btn btn-block btn-lg btn-personalizado-2 btn-flat mar-top-20', 'name' => 'login-button']) ?>
        
        <?php ActiveForm::end(); ?>
        </div>
                                
    </div>  

    
</div>

    </div>


               
