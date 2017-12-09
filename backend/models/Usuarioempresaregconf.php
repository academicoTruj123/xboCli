<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use backend\models\Usuario;
use common\models\Reponseapi;


/**
 * @property int $intIdUsuario
 * @property string $vchCodigoVer
 * @property string $vchCodigoVerUsu  
 * @property string $vchCorreo
 */
class Usuarioempresaregconf extends Model
{    
   
    public $intIdUsuario;
    public $vchCodigoVer;    
    public $vchCodigoVerUsu;
    public $vchCorreo;    

    public $urlapiLogin ='http://localhost:8099/loginrest';
    //public $urlapiLogin ='';
    public $mensaje='';
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchCodigoVer'], 'required'],
            [['vchCodigoVer'], 'string', 'max' => 4],
            [['vchCodigoVerUsu'], 'string'],
            [['vchCorreo'], 'string'],
            [['intIdUsuario'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [            
            'vchCodigoVer' => 'Ingresar Cod. Verificacion'
        ];
    }

    public function activarcuenta($idUsuario){                        
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]                              
        ]);  
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=loginrest%2Factivarcuenta', json_encode($idUsuario),array('Content-Type' => 'application/json')); 
        $result = $api->post('/activarcuenta', json_encode($idUsuario),array('Content-Type' => 'application/json'));                                 
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
