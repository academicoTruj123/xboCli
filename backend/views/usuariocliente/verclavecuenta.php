<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\Usuariocliente */

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}",
    'labelOptions' => [ 'class' => 'label-input-text' ]
];


?>
<div class="usuariocliente-update">
 
    <?= Yii::$app->session->getFlash('msg') ?> 
    <?php $form = ActiveForm::begin(['id' => 'usuariocliente-form']); ?>
    
    <div class="row">
        
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom" id="idnavcustom-cliente">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                  

                <?= $form->field($model, 'vchClave', $fieldOptions1)
                        ->label(true)
                        ->textInput(['placeholder' => 'Ingresar '.$model->getAttributeLabel('vchClave'),'maxlength' => true]) ?>
                  
                                   
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
          
    <?php ActiveForm::end(); ?>
          
    

        </div>
        <!-- /.col -->


      </div>
    

</div>
