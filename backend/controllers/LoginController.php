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
use backend\models\UsuarioempresaReg;
use backend\models\Usuarioempresaregconf;
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
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {                                     
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

    public function actionEmpresa2()
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

    public function actionEmpresa()
    {        
       // if (!Yii::$app->user->isGuest) {
       //     return $this->goHome();
       // }
        $modeltablacodigo = new Tablacodigo();
        $model = new LoginForm();
        $modelUser = new Usuario();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {                                     
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
                        
                          $model = new Usuarioempresaregconf();
                            $model->intIdUsuario=$modelUser->intIdUsuario;
                            $model->vchCorreo=$modelUser->vchCorreo;
                            $model->vchCodigoVerUsu=$modelUser->vchCodVerificacion;                                                                    
                           return $this->redirect(['empresaconfirmaregistro', 'model' => $model]);
                }
                               
                        echo "login correcto-cuenta otro estado de cuenta no administrada";
                        return true;                                               
            }                                
        } else {
            return $this->render('empresa', [
                'model' => $model,
            ]);
        }
    }  

    
    public function actionAdministrador()
    {

       // if (!Yii::$app->user->isGuest) {
       //     return $this->goHome();
       // }
        $model = new LoginForm();
        $modelUser = new Usuario();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {                                     
            $modelUser =  $model->login($model);
            if( $modelUser== null)
            {
                echo "login incorrecto " .$model->mensaje;                
            }else{                                                 
                echo "login correcto-admin";
                return true;                                               
            }                                
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
    
    
    public function actionClienterecuperarcontrasenia(){
        $model = new LoginForm();       
        $modelusu = new Usuario();        //
        if ($model->load(Yii::$app->request->post()) && $model->validate()  ) {                       
            $modelusu = $model->recuperarcontrasenia($model);
            if($modelusu != null){                    
                  $model = new LoginForm();
                 return $this->redirect(['cliente', 'model' => $model]);
           }else{
                echo  "error al recuperar contrasenia";
                return true;
            }                                
        } else {           
            return $this->render('clienterecuperarcontrasenia', [
                'model' => $model                
            ]);
        } 
    }
    
    public function actionEmpresaregistro(){                 
        $model = new UsuarioempresaReg();       
        $modelusu = new Usuario();
        $modelconfusu = new Usuarioempresaregconf();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {                       
            $modelusu = $model->registrar($model);
            if($modelusu != null){                    
                  $modelconfusu->intIdUsuario=$modelusu->intIdUsuario;
                  $modelconfusu->vchCodigoVerUsu=$modelusu->vchCodVerificacion;                  
                  $modelconfusu->vchCorreo=$modelusu->vchCorreo;                                    
                 return $this->redirect(['empresaconfirmaregistro', 'model' => $modelconfusu]);
           }else{
                
            }                                
        } else {           
            return $this->render('empresaregistro', [
                'model' => $model                
            ]);
        }                       
    }
        
    public function actionEmpresaconfirmaregistro(){                             
       if(Yii::$app->request->post()){            
           $model = new Usuarioempresaregconf();
           $modelusu = new Usuario();                      
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) { 
              if($model->vchCodigoVer == $model->vchCodigoVerUsu  ){  
                 $modelusu= $model->activarcuenta($model->intIdUsuario);                                                   
                 if($modelusu == null){
                     echo "confirmacion incorrecta,cuenta no se puede activar" ; die();  
                 }else{                     
                  $model = new LoginForm();
                  return $this->render('empresa', [
                            'model' => $model,
                    ]);                     
                 }                                     
              }else{
                  echo "confirmacion incorrecta" ; die();                 
              }
         } else {                  
             return $this->render('empresaconfirmaregistro', [
                 'model' => $model                
             ]);
         }        
       }else
       {                
          $model = new Usuarioempresaregconf();
          $model->intIdUsuario=ArrayHelper::getValue(Yii::$app->request->get(), 'model.intIdUsuario');          
          $model->vchCorreo=ArrayHelper::getValue(Yii::$app->request->get(), 'model.vchCorreo');                              
          $model->vchCodigoVerUsu=ArrayHelper::getValue(Yii::$app->request->get(), 'model.vchCodigoVerUsu');                                            
          return $this->render('empresaconfirmaregistro', [
                'model' => $model                
          ]);           
       }             
    }
                          
    public function actionEmpresarecuperarcontrasenia(){
        $model = new LoginForm();       
        $modelusu = new Usuario();        //
        if ($model->load(Yii::$app->request->post()) && $model->validate()  ) {                       
            $modelusu = $model->recuperarcontrasenia($model);
            if($modelusu != null){                    
                  $model = new LoginForm();
                 return $this->redirect(['empresa', 'model' => $model]);
           }else{
                echo  "error al recuperar contrasenia";
                return true;
            }                                
        } else {           
            return $this->render('empresarecuperarcontrasenia', [
                'model' => $model                
            ]);
        } 
    }
    
}
