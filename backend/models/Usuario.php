<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;

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

    
    private $urlapiLogin ='http://localhost:8099/loginrest';
   // private $urlapiLogin ='';
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchCorreo', 'vchClave', 'vchCodVerificacion', 'intCodigoEstado', 'dtiFechaReg'], 'required'],
            [['intCodigoEstado', 'intTipoLogin', 'intCodigoRol'], 'integer'],
            [['dtiFechaAlta', 'dtiFechaBaja', 'dtiFechaReg', 'dtiFechaUltMod'], 'safe'],
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
            'vchCorreo' => 'Ingresar correo',
            'vchClave' => 'Ingresar clave',
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
    
}

