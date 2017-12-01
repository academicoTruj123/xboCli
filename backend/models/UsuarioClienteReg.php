<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use backend\models\Usuario;
use common\models\Reponseapi;


/**
 * @property string $vchNombres
 * @property string $vchCorreo
 * @property string $vchClave  
 * @property integer $intTipoLogin
 */
class UsuarioClienteReg extends Model
{    
    public $vchNombres;
    public $vchCorreo;
    public $vchClave;
    public $intTipoLogin;   
    public $urlapiLogin ='http://localhost:8099/loginrest';
    public $mensaje='';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchCorreo', 'vchClave', 'vchNombres'], 'required'],
            [['intTipoLogin'], 'integer'],
            [['vchCorreo'], 'string', 'max' => 250],
            [['vchClave'], 'string', 'max' => 128],            
            [['vchNombres'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [            
            'vchNombres' => 'Ingresar nombre',
            'vchCorreo' => 'Ingresar correo',
            'vchClave' => 'Ingresar clave',                        
            'intTipoLogin' => 'Int Tipo Login',            
        ];
    }

    public function registrar($model){                        
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]                              
        ]);                          
        $result = $api->post('/registrarlogincliente', json_encode($model),array('Content-Type' => 'application/json'));                         
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
