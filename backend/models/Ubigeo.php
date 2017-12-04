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
        $result =  $api->get('/index'); 
        $model = $result->decode_response(true);
        //$data = json_decode($result->response,true);                         
//        $model = new Usuariocliente(); 
//        $responseapi = new Reponseapi();
//        $responseapi =json_decode($result->response,true);          
//        //$model->attributes = $data;   
//        $status=ArrayHelper::getValue($responseapi, 'status');
//        if($status==true){
//            $arrayatributo=ArrayHelper::getValue($responseapi, 'data');
//            $model->attributes = $arrayatributo;                                                  
//            //$model->attributes = $data;  
//           // $this->mensaje='';
//           // echo 'respuesta despues del registro ';print_r($modelusu);die;
//        }else{
//            $model=null;
//            //$this->mensaje=$responseapi->data;           
//        }  
        
        //echo 'lista ubigeo ';print_r($model);die();
         return $model;        
    }
    
}
