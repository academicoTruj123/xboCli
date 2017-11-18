<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pruebarest;

/**
 * PruebarestBuscar represents the model behind the search form about `app\models\Pruebarest`.
 */
class PruebarestBuscar extends Pruebarest
{
    
    
    public $dataApi;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpruebarest'], 'integer'],
            [['nombre', 'descripcion', 'fecha'], 'safe'],
            [['estado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        
        //Este query es reemplazo por la consulta al API
        $query = $dataApi;
        //$query = Pruebarest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idpruebarest' => $this->idpruebarest,
            'estado' => $this->estado,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
