<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pruebarest".
 *
 * @property integer $idpruebarest
 * @property string $nombre
 * @property string $descripcion
 * @property boolean $estado
 * @property string $fecha
 */
class Pruebarest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pruebarest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'boolean'],
            [['fecha'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpruebarest' => 'Idpruebarest',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
        ];
    }
}
