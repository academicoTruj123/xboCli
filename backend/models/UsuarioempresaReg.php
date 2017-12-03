<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;

class UsuarioempresaReg extends Model
{
    
    public $vchNombreComercial;
    public $vchRuc;
    public $vchCorreo;
    public $vchClave;
    public $intTipoLogin;  
    public $vchTipoLogin;
    
    public $urlapiLogin ='http://localhost:8099/loginrest';
    public $mensaje=''; 
    
    const LOGIN_CUENTA_SISTEMA = '0201';
    const LOGIN_CUENTA_FACEBOOK = '0202';
        
    /**
     * @inheritdoc
     */
    public function rules()
    {         
         return [
            [['vchCorreo', 'vchClave', 'vchNombreComercial','vchRuc'], 'required'],
            [['intTipoLogin'], 'integer'],
            [['vchCorreo'], 'string', 'max' => 250],
            [['vchClave'], 'string', 'max' => 20],            
            [['vchRuc'], 'string', 'max' => 11],
            [['vchNombreComercial'], 'string', 'max' => 200],
            [['vchTipoLogin'], 'string', 'max' => 6],
        ];                
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [            
            'vchNombreComercial' => 'Ingresar nombre comercial',
            'vchRuc' => 'Ingresar nro de ruc',
            'vchCorreo' => 'Ingresar correo',
            'vchClave' => 'Ingresar clave',
            'intTipoLogin' => 'Tipo de login',
        ];
    }
    
    public function registrar($model){                        
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]                              
        ]);           
        $result = $api->post('/registrarloginempresa', json_encode($model),array('Content-Type' => 'application/json'));                         
        $modelusu = new Usuario(); 
        $responseapi = new Reponseapi();
        $responseapi =json_decode($result->response);        
        if($responseapi->status==true){
            $modelusu=$responseapi->data;
            $this->mensaje='';
           // echo 'respuesta despues del registro ';print_r($modelusu);die;
        }else{
            $modelusu=null;
            $this->mensaje=$responseapi->data;
           //echo 'respuesta despues del registro ';print_r($responseapi->data);die; 
        }        
        return $modelusu;
    }
    
    
}