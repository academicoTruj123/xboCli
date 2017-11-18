<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "tablaprueba".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 */
// al migrar: cambiar la linea \yii\db\ActiveRecord  por Model
class Tablaprueba extends Model
{     
    public $id;
    public $nombre;
    public $descripcion;    
        
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }
    
    
    function grabar(){
        //
    }
    
    function actualizar(){
        
    }
    
    
    //mejorar abstraer la funcionalidad
    
}
