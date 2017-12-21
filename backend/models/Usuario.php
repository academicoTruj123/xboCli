<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $intIdUsuario
 * @property string $vchCorreo
 * @property string $vchClave
 * @property string $vchAuthKey
 * @property string $vchCodVerificacion
 * @property integer $intCodigoEstado
 * @property string $dtiFechaAlta
 * @property string $dtiFechaBaja
 * @property boolean $bitActivo
 * @property string $dtiFechaReg
 * @property string $dtiFechaUltMod
 * @property integer $intTipoLogin
 * @property integer $intCodigoRol
 * @property integer $intTipoUsuario;
 */
class Usuario extends Model
{    
    
    const STATUS_PENDIENTE_ACTIVACION = '0101';
    const STATUS_CUENTA_ACTIVADA = '0102';
    const STATUS_CUENTA_SUSPENDIDA = '0103';
    const STATUS_CUENTA_DESACTIVADA = '0104';
    
    const ROL_CLIENTE = '0301';
    const ROL_EMPRESA = '0302';
    const ROL_ADMINISTRADOR = '0303';
    
    const TIPO_CLIENTE = '0401';
    const TIPO_EMPRESA = '0402';
    const TIPO_ADMINISTRADOR = '0403'; 
    
    
    public $intIdUsuario;
    public $vchCorreo;
    public $vchClave;
    public $vchAuthKey;
    public $vchCodVerificacion;
    public $intCodigoEstado;
    public $dtiFechaAlta;
    public $dtiFechaBaja;
    public $bitActivo;
    public $dtiFechaReg;
    public $dtiFechaUltMod;
    public $intTipoLogin;
    public $intCodigoRol;
    public $intTipoUsuario;
    
    private $urlapiLogin ='http://localhost:8099/loginrest';
   // private $urlapiLogin ='';
    private $urlapiUser ='http://localhost:8099/usuariorest';
   // private $urlapiUser ='';    
            
    /**
     * @inheritdoc dtiFechaBaja
     */
    public function rules()
    {
        return [
            [['vchCorreo', 'vchClave', 'vchCodVerificacion', 'intCodigoEstado', 'dtiFechaReg'], 'required'],
            [['intIdUsuario','intCodigoEstado', 'intTipoLogin', 'intCodigoRol','intTipoUsuario'], 'integer'],
            [['dtiFechaAlta', 'dtiFechaReg', 'dtiFechaUltMod','dtiFechaBaja'], 'safe'],
            [['bitActivo'], 'boolean'],
            [['vchCorreo'], 'string', 'max' => 250],
            [['vchClave'], 'string', 'max' => 128],
            [['vchAuthKey', 'vchCodVerificacion'], 'string', 'max' => 200],
            [['vchCorreo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intIdUsuario' => 'Int Id Usuario',
            'vchCorreo' => 'Correo',
            'vchClave' => 'Clave',
            'vchAuthKey' => 'Vch Auth Key',
            'vchCodVerificacion' => 'Vch Cod Verificacion',
            'intCodigoEstado' => 'Int Codigo Estado',
            'dtiFechaAlta' => 'Dti Fecha Alta',
            'dtiFechaBaja' => 'Dti Fecha Baja',
            'bitActivo' => 'Bit Activo',
            'dtiFechaReg' => 'Dti Fecha Reg',
            'dtiFechaUltMod' => 'Dti Fecha Ult Mod',
            'intTipoLogin' => 'Int Tipo Login',
            'intCodigoRol' => 'Int Codigo Rol',
            'intTipoUsuario' => 'Int Tipo usuario',
        ];
    }


    public function registrar($model){
        //llamada al servicio web
                    // ->REST
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);            
       // echo print_r($model);die;
        //echo print_r(json_encode($model));die;        
        $result = $api->post('/registrarlogincliente', json_encode($model),array('Content-Type' => 'application/json'));    
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=loginrest%2Fregistrarlogincliente', json_encode($model),array('Content-Type' => 'application/json'));        
        $responseapi =json_decode($result->response);
        $model=json_decode($result->response);
        echo print_r($result);die;
       // echo print_r($model);die;
    }
    
    
    public function findxIdPk($id){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiUser,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);                          
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=usuariorest%2Fview&id=', json_encode($id),array('Content-Type' => 'application/json'));
        $result = $api->get('/view/?id='.$id);                        
        $data = json_decode($result->response,true);
        $model = new Usuario(); 
        $model->attributes = $data;                                
       // echo print_r($model);die;
       return $model;
    }
    
            
    public function findxIdUsuario($id){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiUser,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=usuariorest%2Ffindusuarioxiduser', json_encode($id),array('Content-Type' => 'application/json'));
        $result = $api->post('/findusuarioxiduser', json_encode($id),array('Content-Type' => 'application/json'));                                         
        //$data = json_decode($result->response,true);                         
        $model = new Usuario(); 
        $responseapi = new Reponseapi();
        $responseapi =json_decode($result->response,true);                   
        $status=ArrayHelper::getValue($responseapi, 'status');
        if($status==true){
            $arrayatributo=ArrayHelper::getValue($responseapi, 'data');
            $model->attributes = $arrayatributo;           
        }else{
            $model=null;
            //$this->mensaje=$responseapi->data;           
        }        
        return $model;        
    }
    
    
    public function update($model){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiUser,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);          
        //$result = $api->put('http://flowers.pe/expoapi/web/index.php?r=usuariorest%2Fupdate&id='.$model->intIdUsuario, json_encode($model),array('Content-Type' => 'application/json'));                               
        $result = $api->put('/update/?id='.$model->intIdUsuario, json_encode($model),array('Content-Type' => 'application/json'));                            
        
       echo '$model-$result :: ';  print_r($result); die() ;
        
        $model = new Usuario(); 
        $model->attributes=json_decode($result->response,true);  
        return $model;       
    } 
    
    // actualiza solo el password, estado(baja)
    public function updateCuentaTipouno($model){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiUser,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);                         
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=usuariorest%2Fupdatetipouno, json_encode($model),array('Content-Type' => 'application/json'));                               
        $result = $api->post('/updatetipouno', json_encode($model),array('Content-Type' => 'application/json'));                            
       //echo '$model-$result :: ';  print_r($result); die() ;        
        $model = new Usuario(); 
        $model->attributes=json_decode($result->response,true);        
        return $model;       
    } 
    
    
    
    
}

