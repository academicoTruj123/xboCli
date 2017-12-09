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
        
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],            
            'authcliente' => [
                        'class' => 'yii\authclient\AuthAction',
                        'successCallback' => [$this, 'successCallbackcliente'],
                    ],  
            'authempresa' => [
                        'class' => 'yii\authclient\AuthAction',
                        'successCallback' => [$this, 'successCallbackempresa'],
                    ],             
        ];
    }
    
    public function successCallbackcliente($client)
    {
//            $user = \common\modules\auth\models\User::find()->where(['email'=>$attributes['email']])->one();                                                            
//            if(!empty($user)){
//                Yii::$app->user->login($user);
//
//            }else{
//                // Save session attribute user from FB
//                $session = Yii::$app->session;
//                $session['attributes']=$attributes;
//                // redirect to form signup, variabel global set to successUrl
//                $this->successUrl = \yii\helpers\Url::to(['signup']);
//            }
        
        $attributes = $client->getUserAttributes();
        //die(print_r($attributes));            
        // $attributes  IMPORTANTE :: ver la manera de validar el atributo o cuando facebook no este disponible
        $model = new UsuarioClienteReg();
        $model->vchNombres=$attributes['name'];
        $model->vchCorreo=$attributes['email'];
        $model->vchClave='';        
        $model->vchTipoLogin=UsuarioClienteReg::LOGIN_CUENTA_FACEBOOK;        
        $modelUser = new Usuario();
        $modelUser =  $model->registrar($model);            
        
        
        if($modelUser != null){  
              Yii::$app->session['ss_user'] =$modelUser;
              return $this->redirect(\Yii::$app->urlManager->createUrl("dashboard/indexcliente"));                     
              
        }else{
              
              
                   Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede ingresar al sistema con la cuenta de facebook.Intentarlo nuevamente!</strong></div>'
                     );                 
                            return $this->render('cliente', [
                    'model' => $model,
                ]); 
                    
        }                     
    }
    
    public $successUrl = 'Success';

    public function successCallbackempresa($client)
    {
        $attributes = $client->getUserAttributes();
        $model = new UsuarioempresaReg();
        $model->vchNombreComercial =$attributes['name'];
        $model->vchRuc ='0000000000';
        $model->vchCorreo =$attributes['email'];
        $model->vchClave ='XXXXXX';    
        $model->intTipoLogin =0;
        $model->vchTipoLogin=UsuarioempresaReg::LOGIN_CUENTA_FACEBOOK;     
        $modelUser = new Usuario();
        $modelUser =  $model->registrar($model);    
        if($modelUser != null){                    
              //return  Yii::$app->runAction('dashboard/indexempresa');   
              //return  $this->redirect('dashboard/indexempresa'); 
             Yii::$app->session['ss_user'] =$modelUser;            
             return $this->redirect(\Yii::$app->urlManager->createUrl("dashboard/indexempresa"));
             
        }else{
             Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede ingresar al sistema con la cuenta de facebook.Intentarlo nuevamente!</strong></div>'
                     );                 
            return $this->render('cliente', [
                    'model' => $model,
                ]);             
        }
    }
    
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
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>Credenciales incorrectas</strong></div>'
                 ); 
                // .$model->mensaje.
                return $this->render('cliente', [
                    'model' => $model,
                ]);                
            }else{   
               $codigoestadocuenta= $modeltablacodigo->getCodigo($modelUser->intCodigoEstado);               
                if($codigoestadocuenta == Usuario::STATUS_CUENTA_ACTIVADA){
                        Yii::$app->session['ss_user'] =$modelUser;
                        return  Yii::$app->runAction('dashboard/indexcliente');                        
                }
                if( $codigoestadocuenta == Usuario::STATUS_PENDIENTE_ACTIVACION){                   
                        
                            $model = new UsuarioClienteRegConf();
                            $model->intIdUsuario=$modelUser->intIdUsuario;
                            $model->vchCorreo=$modelUser->vchCorreo;
                            $model->vchCodigoVerUsu=$modelUser->vchCodVerificacion;                                                                    
                           return $this->redirect(['clienteconfirmaregistro', 'model' => $model]);
                }
                               
//                        echo "login correcto-cuenta otro esatdo de cuenta no administrada";
//                        return true;                                               
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
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>Credenciales incorrectas</strong></div>'
                 ); 
                // .$model->mensaje.
                return $this->render('empresa', [
                    'model' => $model,
                ]); 
                
            }else{   
               $codigoestadocuenta= $modeltablacodigo->getCodigo($modelUser->intCodigoEstado);               
                if($codigoestadocuenta == Usuario::STATUS_CUENTA_ACTIVADA){    
                        Yii::$app->session['ss_user'] =$modelUser;
                        return  Yii::$app->runAction('dashboard/indexempresa');
                }
                if( $codigoestadocuenta == Usuario::STATUS_PENDIENTE_ACTIVACION){                   
                        
                          $model = new Usuarioempresaregconf();
                            $model->intIdUsuario=$modelUser->intIdUsuario;
                            $model->vchCorreo=$modelUser->vchCorreo;
                            $model->vchCodigoVerUsu=$modelUser->vchCodVerificacion;                                                                    
                           return $this->redirect(['empresaconfirmaregistro', 'model' => $model]);
                }
//                               
//                        echo "login correcto-cuenta otro estado de cuenta no administrada";
//                        return true;                                               
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
                
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>Credenciales incorrectas</strong></div>'
                 );                 
                return $this->render('administrador', [
                    'model' => $model,
                ]); 
              
            }else{
                Yii::$app->session['ss_user'] =$modelUser;
                return  Yii::$app->runAction('dashboard/indexadministrador');   
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
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>No se pudo realizar el registro</strong>'.$model->mensaje.'</div>'
                 );                 
                return $this->render('clienteregistro', [
                    'model' => $model,
                ]);                 
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
                     
                    Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>Confirmacion incorrecta,cuenta no se puede activar</strong>'.$model->mensaje.'</div>'
                     );                 
                    return $this->render('clienteconfirmaregistro', [
                        'model' => $model,
                    ]);  

                 }else{

                  $model = new LoginForm();
                  return $this->redirect(['cliente', 'model' => $model]);                     
                    
                 }                
                    
              }else{
                    
                  
                    Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede realizar la confirmacion</strong></div>'
                     );                 
                    return $this->render('clienteconfirmaregistro', [
                        'model' => $model,
                    ]);  
                    
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
               
                    Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede recuperar el password</strong></div>'
                     );                 
                    return $this->render('clienterecuperarcontrasenia', [
                        'model' => $model,
                    ]);  
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
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>No se pudo realizar el registro</strong>'.$model->mensaje.'</div>'
                 );                 
                return $this->render('empresaregistro', [
                    'model' => $model,
                ]);                 
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
                      
                    Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>Confirmacion incorrecta,cuenta no se puede activar</strong>'.$model->mensaje.'</div>'
                     );                 
                    return $this->render('empresaconfirmaregistro', [
                        'model' => $model,
                    ]); 
                    
                 }else{ 
                     
                     
                  $model = new LoginForm();
                  return $this->redirect(['empresa', 'model' => $model]);
                     
                  
                 }                                     
              }else{
                  
                    Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede realizar la confirmacion</strong></div>'
                     );                 
                    return $this->render('empresaconfirmaregistro', [
                        'model' => $model,
                    ]);                                                      
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
               
                   Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        <strong>No se puede recuperar el password</strong></div>'
                     );                 
                    return $this->render('empresarecuperarcontrasenia', [
                        'model' => $model,
                    ]);                      
            }                                
        } else {           
            return $this->render('empresarecuperarcontrasenia', [
                'model' => $model                
            ]);
        } 
    }
    
}
