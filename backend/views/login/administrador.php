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



?>

<div class="login-page-cliente">
    
    <div class="login-page-cliente-modal">
        
        <div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar Session</p>
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



                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-block btn-lg btn-personalizado-3 btn-flat mar-top-20', 'name' => 'login-button']) ?>

                    <?php ActiveForm::end(); ?>


    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

        
        
        
         
    </div>
    
    
</div>


               
<div class="login-page-cliente-background" >
    <div class="login-page-cliente-background-overlay" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; opacity: 0.2;"></div>    
    <?= Html::img('@web/imagenes/f6.jpg', ['alt'=>'login expoboda', 'class'=>'style="width: 100%; left: 0px;"']);?>
</div>
