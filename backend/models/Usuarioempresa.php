<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarioempresa".
 *
 * @property integer $intIdUsuempresa
 * @property integer $intIdUsuario
 * @property string $vchRazonSocial
 * @property string $vchRuc
 * @property string $vchContacto
 * @property string $vchContactoCorreo
 * @property string $vchNombreComercial
 * @property string $dtmFechaCreacion
 * @property integer $intIdUbigeo
 * @property string $vchDomicilioUbigeo
 * @property string $vchDomicilioDireccion
 * @property string $vchCelular
 * @property string $vchTelefonoFijo
 * @property string $dtiFechaAlta
 * @property string $dtiFechaBaja
 * @property integer $intCodigoEstado
 * @property boolean $bitActivo
 * @property integer $intIdUsuarioReg
 * @property string $dtiFechaReg
 * @property integer $intIdUsuarioUltMod
 * @property string $dtiFechaUltMod
 */
class Usuarioempresa extends Model
{

    public $intIdUsuempresa;
    public $intIdUsuario;
    public $vchRazonSocial;
    public $vchRuc;
    public $vchContacto;
    public $vchContactoCorreo;
    public $vchNombreComercial;
    public $dtmFechaCreacion;
    public $intIdUbigeo;
    public $vchDomicilioUbigeo;
    public $vchDomicilioDireccion;
    public $vchCelular;
    public $vchTelefonoFijo;
    public $dtiFechaAlta;
    public $dtiFechaBaja;
    public $intCodigoEstado;
    public $bitActivo;
    public $intIdUsuarioReg;
    public $dtiFechaReg;
    public $intIdUsuarioUltMod;
    public $dtiFechaUltMod ;

    private $urlapiLogin ='http://localhost:8099/empresarest';
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intIdUsuario', 'dtiFechaReg', 'dtiFechaUltMod'], 'required'],
            [['intIdUsuempresa','intIdUsuario', 'intIdUbigeo', 'intCodigoEstado', 'intIdUsuarioReg', 'intIdUsuarioUltMod'], 'integer'],
            [['dtmFechaCreacion', 'dtiFechaAlta', 'dtiFechaBaja', 'dtiFechaReg', 'dtiFechaUltMod'], 'safe'],
            [['bitActivo'], 'boolean'],
            [['vchRazonSocial', 'vchNombreComercial', 'vchDomicilioUbigeo', 'vchDomicilioDireccion'], 'string', 'max' => 200],
            [['vchRuc'], 'string', 'max' => 11],
            [['vchContacto', 'vchContactoCorreo'], 'string', 'max' => 150],
            [['vchCelular', 'vchTelefonoFijo'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intIdUsuempresa' => 'Int Id Usuempresa',
            'intIdUsuario' => 'Int Id Usuario',
            'vchRazonSocial' => 'Ingresar razon social',
            'vchRuc' => 'Ingresar nro ruc',
            'vchContacto' => 'Ingresar nombre contacto',
            'vchContactoCorreo' => 'Ingresar correo de contacto',
            'vchNombreComercial' => 'Ingresar nombre comercial',
            'dtmFechaCreacion' => 'Ingresar fecha de creacion',
            'intIdUbigeo' => 'Int Id Ubigeo',
            'vchDomicilioUbigeo' => 'Ingresar domicilio ubigeo',
            'vchDomicilioDireccion' => 'Ingresar direccion de domicilio',
            'vchCelular' => 'Ingresar nro celular',
            'vchTelefonoFijo' => 'Ingresar nro Telefono Fijo',
            'dtiFechaAlta' => 'Dti Fecha Alta',
            'dtiFechaBaja' => 'Dti Fecha Baja',
            'intCodigoEstado' => 'Int Codigo Estado',
            'bitActivo' => 'Bit Activo',
            'intIdUsuarioReg' => 'Int Id Usuario Reg',
            'dtiFechaReg' => 'Dti Fecha Reg',
            'intIdUsuarioUltMod' => 'Int Id Usuario Ult Mod',
            'dtiFechaUltMod' => 'Dti Fecha Ult Mod',
        ];
    }
    
    public function update($model){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);     
         
        $result = $api->put('/update/?id='.$model->intIdUsuempresa, json_encode($model),array('Content-Type' => 'application/json'));                            
        $model = new Usuarioempresa(); 
        //echo 'modelo update'; print_r($result);die;
        $model->attributes=json_decode($result->response,true);  
        return $model;       
    }    
    
    public function findxIdPk($id){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);                   
        $result = $api->get('/view/?id='.$id);                        
        $data = json_decode($result->response,true);
        $model = new Usuarioempresa(); 
        $model->attributes = $data;                                
       // echo print_r($model);die;
       return $model;
    }
    
    public function findxIdUsuario($id){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);            
        $result = $api->post('/findusuarioempresaxiduser', json_encode($id),array('Content-Type' => 'application/json'));                                         
        //$data = json_decode($result->response,true);                         
        $model = new Usuarioempresa(); 
        $responseapi = new Reponseapi();
        $responseapi =json_decode($result->response,true);          
        //$model->attributes = $data;   
        $status=ArrayHelper::getValue($responseapi, 'status');
        if($status==true){
            $arrayatributo=ArrayHelper::getValue($responseapi, 'data');
            $model->attributes = $arrayatributo;                                                  
            //$model->attributes = $data;  
           // $this->mensaje='';
           // echo 'respuesta despues del registro ';print_r($modelusu);die;
        }else{
            $model=null;
            //$this->mensaje=$responseapi->data;           
        }        
        return $model;        
    }
        
}
