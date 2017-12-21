<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use backend\models\Ubigeo;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\Usuariocliente */

$this->title = 'Mi Cuenta';
//$this->params['breadcrumbs'][] = ['label' => 'Usuarioclientes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->intIdUsucliente, 'url' => ['view', 'id' => $model->intIdUsucliente]];
//$this->params['breadcrumbs'][] = 'Datos';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}",
    'labelOptions' => [ 'class' => 'label-input-text' ]
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<span data-toggle='tooltip' data-title='Al actualizar la clave se lo enviaremos por correo.' class='glyphicon glyphicon-info-sign'></span>{input}",
    'labelOptions' => [ 'class' => 'label-input-text' ]    
];

$script = <<< JS
    
  $(function () {        
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-pink',      
      increaseArea: '10%' 
    });
    $('#btnmodalclave').click(function(){        
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    }); 
   $("[data-toggle='tooltip']").tooltip(); 
  });        
JS;
$this->registerJs($script);

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
                  
                <?= $form->field($model, 'vchCorreo', $fieldOptions1)
                        ->label(true)
                        ->textInput(['placeholder' => 'Ingresar '.$model->getAttributeLabel('vchCorreo'),'maxlength' => true,'readOnly'=> true]) ?>

                <?= $form->field($model, 'vchClave', $fieldOptions2)
                        ->label(true)
                        ->passwordInput(['placeholder' => 'Ingresar '.$model->getAttributeLabel('vchClave'),'maxlength' => true]) ?>
                  
                                                          
                <?= $form->field($model, 'bitActivo',$fieldOptions1)
                         ->label('Dar de baja?')             
                         ->checkbox(['class' => 'icheck','id'=>'chkLoginClienteRecuerdame'])
                          ?>  
                  
                  
                  

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
                              
              <div class="form-group">
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-personalizado-1']) ?>
    </div>

          
          
    <?php ActiveForm::end(); ?>
          
    
 
<!--    Html::button('Ver clave', ['id' => 'btnmodalclave', 'value' => \yii\helpers\Url::to(['usuariocliente/verclavecuenta']), 'class' => 'btn btn-success']) -->
          
        </div>
        <!-- /.col -->


      </div>
    

      
<?php            
    Modal::begin([
            'header' => '<h4>clave</h4>',
            'id'     => 'modal',
            'size'   => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    
    echo "<div id='modelContent'></div>";    
    echo 'ya pues';
    Modal::end();            
?>
    

</div>
