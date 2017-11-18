<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Pruebarest;
use backend\models\PruebarestBuscar;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use restclient;

/**
 * PruebarestController implements the CRUD actions for Pruebarest model.
 */
class PruebarestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pruebarest models.
     * @return mixed
     */
    public function actionIndex()
    {
        // consumiendo un servicio.
        
        $api = new RestClient([
            'base_url' =>'http://localhost:9090/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result =  $api->get('/index');
        echo '<pre>'; print_r($result->response);die;
        
        
        $searchModel = new PruebarestBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pruebarest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pruebarest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pruebarest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idpruebarest]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pruebarest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idpruebarest]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pruebarest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pruebarest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pruebarest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pruebarest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPrueba()
    {
        $api = new RestClient([
            'base_url' =>'http://localhost:9090/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result =  $api->get('/index');
        echo '<pre>'; print_r($result->response);die;
        return $this->render('prueba');
        
    }
    
    
}
