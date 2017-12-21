<?php

namespace common\models;
use Yii;
use yii\base\NotSupportedException;
use yii\base\Model;
use restclient;
use common\models\Reponseapi;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tablacodigo".
 *
 */
class Tablacodigo extends Model
{

    public $intIdTablaCodigo;
    public $vchCodigo;
    public $vchTexto;
    public $vchDescripcion;
    public $bitActivo;
    public $intIdUsuarioReg;
    public $dtiFechaReg;
    public $intIdUsuarioUltMod;
    public $dtiFechaUltMod ;
    public $urlapiLogin ='http://localhost:8099/tablacodigorest';
    //public $urlapiLogin ='';
    public $mensaje='';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchCodigo', 'vchTexto', 'dtiFechaReg'], 'required'],
            [['bitActivo'], 'boolean'],
            [['intIdTablaCodigo','intIdUsuarioReg', 'intIdUsuarioUltMod'], 'integer'],
            [['dtiFechaReg', 'dtiFechaUltMod'], 'safe'],
            [['vchCodigo'], 'string', 'max' => 6],
            [['vchTexto'], 'string', 'max' => 200],
            [['vchDescripcion'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intIdTablaCodigo' => 'Int Id Tabla Codigo',
            'vchCodigo' => 'Vch Codigo',
            'vchTexto' => 'Vch Texto',
            'vchDescripcion' => 'Vch Descripcion',
            'bitActivo' => 'Bit Activo',
            'intIdUsuarioReg' => 'Int Id Usuario Reg',
            'dtiFechaReg' => 'Dti Fecha Reg',
            'intIdUsuarioUltMod' => 'Int Id Usuario Ult Mod',
            'dtiFechaUltMod' => 'Dti Fecha Ult Mod',
        ];
    }

    /**
     * @inheritdoc
     * @return TablacodigoQuery the active query used by this AR class.
     */
   
    public function getCodigo($idcodigo) {            
       $model = new Tablacodigo();        
       $api = new RestClient([
            'base_url' =>$this->urlapiLogin,
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        //$result =  $api->get('http://flowers.pe/expoapi/web/index.php?r=tablacodigorest%2Fview&id='.$idcodigo);        
        $result =  $api->get('/view/?id='.$idcodigo);                        
        $data = json_decode($result->response,true);
        $model->attributes = $data;        
        return $model->vchCodigo;           
    }
    
    
    public function findxcodigo($codigo){
        //llamada al servicio web
        $api = new RestClient([
                'base_url' =>$this->urlapiLogin,
                'header' =>[
                'Accept' => 'application/json'                    
               ]              
                
        ]);
        //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=tablacodigorest%2Ffindtablacodigoxcodigo', json_encode($codigo),array('Content-Type' => 'application/json'));
        $result = $api->post('/findtablacodigoxcodigo', json_encode($codigo),array('Content-Type' => 'application/json'));        
        $model = new Tablacodigo(); 
        $responseapi = new Reponseapi();
        $responseapi =json_decode($result->response,true);                    
        $status=ArrayHelper::getValue($responseapi, 'status');
        if($status==true){
            $arrayatributo=ArrayHelper::getValue($responseapi, 'data');
            $model->attributes = $arrayatributo;    
            
          //  echo 'tabla codio - $responseapi :: ';   print_r($model); die();
        }else{
            $model=null;                      
        }        
        return $model;        
    }
    
    

    
    
}
