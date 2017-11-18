<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use backend\models\Tablaprueba;

/**
 * TablapruebaBuscar represents the model behind the search form about `app\models\Tablaprueba`.
 */
class TablapruebaBuscar extends Tablaprueba
{
    
            
    public $dataApi;
    
    /**
     * @inheritdoc
     */        
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
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
        
        //echo '<pre>'; print_r($params);die;        
        //Este query es reemplazo por la consulta al API
        //$query = Tablaprueba::find();
        $query = $this->dataApi;
        //echo '<pre>'; print_r($query);die;  
        // add conditions that should always apply here

        
        //$dataProvider = new ActiveDataProvider([
        //    'query' => $query,
        //]);
        
        $dataProvider = new ArrayDataProvider([
              'allModels' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        //Los filtros y condiciones que aplican en ACtiveDataProvider es una suerte de filtro dentro de un query[tipo sql],
        //PAra el caso de los serivicios, podemos realizar la busqueda/filtrado consumiendo un servicio con estas caracteristicas
        //$query->andFilterWhere([
        //    'id' => $this->id,
        //]);
        //$query->andFilterWhere(['like', 'nombre', $this->nombre])
        //    ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
