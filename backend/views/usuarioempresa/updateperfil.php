<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use backend\models\Ubigeo;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\usuarioempresa */

$this->title = 'Mi Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Usuarioempresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->intIdUsuempresa, 'url' => ['view', 'id' => $model->intIdUsuempresa]];
$this->params['breadcrumbs'][] = 'Datos';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}"
];

$fieldOptionsdpck = [
    'options' => ['tag' => null],
    'inputTemplate' => "{input}"
];


//$fieldOptions1 = [
//    'options' => ['class' => 'form-group has-feedback'],
//    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
//];

$script = <<< JS
    
  $(function () {
      
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-pink',
      radioClass: 'iradio_square-green',
      increaseArea: '10%' 
    });
        
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });  
        
    $('.select2').select2();
        
  });   
            
        
JS;
$this->registerJs($script);

?>
<div class="usuarioempresa-update">
 
    <?php $form = ActiveForm::begin(['id' => 'usuarioempresa-form']); ?>

    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom" id="idnavcustom-empresa">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos Personales</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Datos de ubicacion</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Datos de contacto</a></li>
<!--              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                  
                <?= $form->field($model, 'vchRazonSocial', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchRazonSocial'),'maxlength' => true]) ?>

                <?= $form->field($model, 'vchRuc', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchRuc'),'maxlength' => true]) ?>

                <?= $form->field($model, 'vchNombreComercial', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchNombreComercial'),'maxlength' => true]) ?>

                
                <div class="form-group">              
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>                                  
                   <?= $form->field($model, 'dtmFechaCreacion',$fieldOptionsdpck)
                          ->label(false)
                          ->textInput(['placeholder' => $model->getAttributeLabel('dtmFechaCreacion'),'class' => 'form-control pull-right','id'=>'datepicker']) ?>                  
                  </div>                
                </div>
                                                                                                                                                             
              </div>                                
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                        
                      
              <?= $form->field($model, 'intIdUbigeo', $fieldOptions1)
                        ->label(false)
                        ->dropDownList(
                                ArrayHelper::map(Ubigeo::getAll(),'intIdubigeo','vchUbigeo'),
                                [   
                                    'style' => 'width:100% !important',
                                    'prompt'=>'Seleccionar ubigeo',
                                    'class'=>'form-control select2',                                    
                                ]
                               )
              ?>
                  
                <?= $form->field($model, 'vchDomicilioDireccion', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchDomicilioDireccion'),'maxlength' => true]) ?>

   
                  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
  
                <?= $form->field($model, 'vchCelular', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchCelular'),'maxlength' => true]) ?>


                <?= $form->field($model, 'vchTelefonoFijo', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchTelefonoFijo'),'maxlength' => true]) ?>

              
                <?= $form->field($model, 'vchContacto', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchContacto'),'maxlength' => true]) ?>

                <?= $form->field($model, 'vchContactoCorreo', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchContactoCorreo'),'maxlength' => true]) ?>
                                                      
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
                              
    <div class="form-group">
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-personalizado-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
          
        </div>
        <!-- /.col -->


      </div>
    

      
        

</div>
