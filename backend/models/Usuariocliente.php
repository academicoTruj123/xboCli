<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;
use yii\helpers\ArrayHelper;



/**
 *
 * @property integer $intIdUsucliente
 * @property integer $intIdUsuario
 * @property string $vchNombres
 * @property string $vchApellidoPaterno
 * @property string $vchApellidoMaterno
 * @property integer $intCodigoSexo
 * @property string $dtmFechaNacimiento
 * @property integer $intIdUbigeo
 * @property string $vchDomicilioUbigeo
 * @property string $vchDomicilioDireccion
 * @property string $vchDomicilioReferencia
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
class Usuariocliente extends Model
{
    
    public $intIdUsucliente;
    public $intIdUsuario;
    public $vchNombres;
    public $vchApellidoPaterno;
    public $vchApellidoMaterno;
    public $intCodigoSexo;
    public $dtmFechaNacimiento;
    public $intIdUbigeo;
    public $vchDomicilioUbigeo;
    public $vchDomicilioDireccion;
    public $vchDomicilioReferencia;
    public $vchCelular;
    public $vchTelefonoFijo;
    public $dtiFechaAlta;
    public $dtiFechaBaja;
    public $intCodigoEstado;
    public $bitActivo;
    public $intIdUsuarioReg;
    public $dtiFechaReg;
    public $intIdUsuarioUltMod;
    public $dtiFechaUltMod;
        
    //private $urlapiLogin ='';
    private $urlapiLogin ='http://localhost:8099/clienterest';
    //public $mensaje;
    
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intIdUsuario', 'dtiFechaReg'], 'required'],
            [['intIdUsucliente','intIdUsuario', 'intCodigoSexo', 'intIdUbigeo', 'intCodigoEstado', 'intIdUsuarioReg', 'intIdUsuarioUltMod'], 'integer'],
            [['dtmFechaNacimiento', 'dtiFechaAlta', 'dtiFechaBaja', 'dtiFechaReg', 'dtiFechaUltMod'], 'safe'],
            [['bitActivo'], 'boolean'],
            [['vchNombres', 'vchDomicilioUbigeo', 'vchDomicilioDireccion', 'vchDomicilioReferencia'], 'string', 'max' => 200],
            [['vchApellidoPaterno', 'vchApellidoMaterno'], 'string', 'max' => 100],
            [['vchCelular', 'vchTelefonoFijo'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intIdUsucliente' => 'Int Id Usucliente',
            'intIdUsuario' => 'Int Id Usuario',
            'vchNombres' => 'Ingresar Nombres',
            'vchApellidoPaterno' => 'Ingresar Apellido Paterno',
            'vchApellidoMaterno' => 'Ingresar Apellido Materno',
            'intCodigoSexo' => 'Codigo Sexo',
            'dtmFechaNacimiento' => 'Fecha de Nacimiento',
            'intIdUbigeo' => 'Int Id Ubigeo',
            'vchDomicilioUbigeo' => 'Ingresar Domicilio Ubigeo',
            'vchDomicilioDireccion' => 'Ingresar Direccion',
            'vchDomicilioReferencia' => 'Ingresar Referencia',
            'vchCelular' => 'Ingresar Celular',
            'vchTelefonoFijo' => 'Ingresar Telefono Fijo',
            'dtiFechaAlta' => 'Fecha Alta',
            'dtiFechaBaja' => 'Fecha Baja',
            'intCodigoEstado' => 'Codigo Estado',
            'bitActivo' => 'Activo',
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
        //$result = $api->put('http://flowers.pe/expoapi/web/index.php?r=clienterest%2Fupdate&id='.$model->intIdUsucliente, json_encode($model),array('Content-Type' => 'application/json'));
        $result = $api->put('/update/?id='.$model->intIdUsucliente, json_encode($model),array('Content-Type' => 'application/json'));                            
        $model = new Usuariocliente(); 
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
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=clienterest%2Fview&id=', json_encode($id),array('Content-Type' => 'application/json'));
        $result = $api->get('/view/?id='.$id);                        
        $data = json_decode($result->response,true);
        $model = new Usuariocliente(); 
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
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=clienterest%2Ffindusuarioclientexiduser', json_encode($id),array('Content-Type' => 'application/json'));
        $result = $api->post('/findusuarioclientexiduser', json_encode($id),array('Content-Type' => 'application/json'));                                         
        //$data = json_decode($result->response,true);                         
        $model = new Usuariocliente(); 
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
