<?php


namespace backend\models;
use Yii;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;

/**
 * This is the model class for table "ubigeo".
 *
 * @property integer $intIdubigeo
 * @property string $vchCodigo
 * @property string $vchCodDepartamento
 * @property string $vchCodigoProvincia
 * @property string $vchCodigoDistrito
 * @property string $vchUbigeo
 * @property integer $intNivel
 */
class Ubigeo extends Model
{

    public $intIdubigeo;
    public $vchCodigo;
    public $vchCodDepartamento;
    public $vchCodigoProvincia;
    public $vchCodigoDistrito;
    public $vchUbigeo;
    public $intNivel;
            
    private static $urlapiLogin ='http://localhost:8099/ubigeorest';
    //private static $urlapiLogin ='';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intIdubigeo','intNivel'], 'integer'],
            [['vchCodigo'], 'string', 'max' => 6],
            [['vchCodDepartamento', 'vchCodigoProvincia', 'vchCodigoDistrito'], 'string', 'max' => 2],
            [['vchUbigeo'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intIdubigeo' => 'Int Idubigeo',
            'vchCodigo' => 'Vch Codigo',
            'vchCodDepartamento' => 'Vch Cod Departamento',
            'vchCodigoProvincia' => 'Vch Codigo Provincia',
            'vchCodigoDistrito' => 'Vch Codigo Distrito',
            'vchUbigeo' => 'Vch Ubigeo',
            'intNivel' => 'Int Nivel',
        ];
    }
    
    
    public static function getAll(){
        
        //llamada al servicio web        
        $api = new RestClient([
                'base_url' =>Ubigeo::$urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);   
        //$result =  $api->get('http://flowers.pe/expoapi/web/index.php?r=ubigeorest%2Findex'); 
        $result =  $api->get('/index'); 
        $model = $result->decode_response(true);
         return $model;        
    }
    
}
