<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use backend\models\Ubigeo;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\usuariocliente */

$this->title = 'Mi Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Usuarioclientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->intIdUsucliente, 'url' => ['view', 'id' => $model->intIdUsucliente]];
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
      radioClass: 'iradio_square-pink',
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
<div class="usuariocliente-update">
 
    <?php $form = ActiveForm::begin(['id' => 'usuariocliente-form']); ?>

    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom" id="idnavcustom-cliente">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos Personales</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Datos de ubicacion</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Datos de contacto</a></li>
<!--              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?= $form->field($model, 'vchNombres', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchNombres'),'maxlength' => true]) ?>

                <?= $form->field($model, 'vchApellidoPaterno', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchApellidoPaterno'),'maxlength' => true]) ?>

                <?= $form->field($model, 'vchApellidoMaterno', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchApellidoMaterno'),'maxlength' => true]) ?>

                
              <div class="form-group">              
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>                                  
                 <?= $form->field($model, 'dtmFechaNacimiento',$fieldOptionsdpck)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('dtmFechaNacimiento'),'class' => 'form-control pull-right','id'=>'datepicker']) ?>                  
                </div>                
              </div>
                                  
                                                                       
                <div class="form-group">
                    <div class="clearfix" id="UserLogin-gender">                         
                        <p> Genero </p>
                        <?=
                        $form->field($model, 'intCodigoSexo')
                            ->radioList(
                                [1 => 'Hombre', 0 => 'Mujer'],
                                [
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $return = '<div class="radio"><label style="padding-left:2px;">';
                                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" >';
                                        $return .= '<i></i>';
                                        $return .= '<span style="margin-left:6px;">' . ucwords($label) . '</span>';
                                        $return .= '</label></div>';
                                        return $return;
                                    }
                                    
                                ]                                
                            )
                        ->label(false);
                        ?>
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

                <?= $form->field($model, 'vchDomicilioReferencia', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchDomicilioReferencia'),'maxlength' => true]) ?>

    
                  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
  
                <?= $form->field($model, 'vchCelular', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchCelular'),'maxlength' => true]) ?>


                <?= $form->field($model, 'vchTelefonoFijo', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('vchTelefonoFijo'),'maxlength' => true]) ?>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
                              
              <div class="form-group">
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-personalizado-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>
          
        </div>
        <!-- /.col -->


      </div>
    

      
        

</div>
