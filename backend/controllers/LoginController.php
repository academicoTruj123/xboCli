<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\Tablacodigo;
use backend\models\Usuario;
use backend\models\UsuarioClienteReg;
use backend\models\UsuarioClienteRegConf;
use yii\helpers\ArrayHelper;

/**
 * Description of LoginController
 *
 * @author Christian
 */
class LoginController extends Controller{
        
    public function actionCliente()
    {        
       // if (!Yii::$app->user->isGuest) {
       //     return $this->goHome();
       // }
        $modeltablacodigo = new Tablacodigo();
        $model = new LoginForm();
        $modelUser = new Usuario();
        if ($model->load(Yii::$app->request->post())) {                                     
            $modelUser =  $model->login($model);
            if( $modelUser== null)
            {
                echo "login incorrecto " .$model->mensaje;                
            }else{   
               $codigoestadocuenta= $modeltablacodigo->getCodigo($modelUser->intCodigoEstado);               
                if($codigoestadocuenta == Usuario::STATUS_CUENTA_ACTIVADA){                   
                        echo "login correcto-cuenta activada";
                        return true;
                }
                if( $codigoestadocuenta == Usuario::STATUS_PENDIENTE_ACTIVACION){                   
                        
                          $model = new UsuarioClienteRegConf();
                            $model->intIdUsuario=$modelUser->intIdUsuario;
                            $model->vchCorreo=$modelUser->vchCorreo;
                            $model->vchCodigoVerUsu=$modelUser->vchCodVerificacion;                                                                    
                           return $this->redirect(['clienteconfirmaregistro', 'model' => $model]);
                }
                               
                        echo "login correcto-cuenta otro esatdo de cuenta no administrada";
                        return true;
               
                
                
            }                                
        } else {
            return $this->render('cliente', [
                'model' => $model,
            ]);
        }
    }    

    public function actionEmpresa()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('empresa', [
                'model' => $model,
            ]);
        }
    } 

    public function actionAdministrador()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('administrador', [
                'model' => $model,
            ]);
        }
    }     
    
    
    public function actionClienteregistro(){                 
        $model = new UsuarioClienteReg();       
        $modelusu = new Usuario();
        $modelconfusu = new UsuarioClienteRegConf();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {                       
            $modelusu = $model->registrar($model);
            if($modelusu != null){                    
                  $modelconfusu->intIdUsuario=$modelusu->intIdUsuario;
                  $modelconfusu->vchCodigoVerUsu=$modelusu->vchCodVerificacion;                  
                  $modelconfusu->vchCorreo=$modelusu->vchCorreo;                                    
                 return $this->redirect(['clienteconfirmaregistro', 'model' => $modelconfusu]);
           }else{
                
            }                                
        } else {           
            return $this->render('clienteregistro', [
                'model' => $model                
            ]);
        }                       
    }
    
    
    public function actionClienteconfirmaregistro(){        
       
       
       
       if(Yii::$app->request->post()){ 
           
           $model = new UsuarioClienteRegConf();
           $modelusu = new Usuario();
           //echo print_r(Yii::$app->request->post());die();
           
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
            
            
            
              if($model->vchCodigoVer == $model->vchCodigoVerUsu  ){  
                 $modelusu= $model->activarcuenta($model->intIdUsuario);
                 
                 
                 
                 if($modelusu == null){
                     echo "confirmacion incorrecta,cuenta no se puede activar" ; die();  
                 }else{
                     
                  $model = new LoginForm();
                  return $this->render('cliente', [
                            'model' => $model,
                    ]);                     
                 }
                 
                    
              }else{
                  echo "confirmacion incorrecta" ; die();                 
              }
         } else {                  
             return $this->render('clienteconfirmaregistro', [
                 'model' => $model                
             ]);
         }        
       }else
       {     
           
          $model = new UsuarioClienteRegConf();
          $model->intIdUsuario=ArrayHelper::getValue(Yii::$app->request->get(), 'model.intIdUsuario');          
          $model->vchCorreo=ArrayHelper::getValue(Yii::$app->request->get(), 'model.vchCorreo');                              
          $model->vchCodigoVerUsu=ArrayHelper::getValue(Yii::$app->request->get(), 'model.vchCodigoVerUsu');                                            
          return $this->render('clienteconfirmaregistro', [
                'model' => $model                
          ]);           
       }             
    }
    
}
