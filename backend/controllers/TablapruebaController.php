<?php

namespace backend\controllers;

use Yii;
use backend\models\Tablaprueba;
use backend\models\TablapruebaBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use restclient;
use yii\web\Response;
use yii\helpers\Json;

/**
 * TablapruebaController implements the CRUD actions for Tablaprueba model.
 */
class TablapruebaController extends Controller
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
     * Lists all Tablaprueba models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TablapruebaBuscar();
        $model = new Tablaprueba(); 
        
        // ->REST        
        $api = new RestClient([
            'base_url' =>'http://localhost:8099/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result =  $api->get('/index');
        //$data =Json::decode($result->response,true);
        $model = $result->decode_response(true);
         
        //echo '<pre>'; print_r($model);die;            
        $searchModel->dataApi = $model;
        //echo '<pre>'; print_r($model);die;     
        // <-REST
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tablaprueba model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
       $model = new Tablaprueba(); 
       // ->REST
       $api = new RestClient([
            'base_url' =>'http://localhost:8099/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result =  $api->get('/view/?id='.$id);        
        //$model=Json::decode($result->response);
        $model=json_decode($result->response);
        // <-REST
        
        //echo '<pre>'; print_r($data);die;                                    
        return $this->render('view', [
            'model' => $model,
        ]);        

        //return $this->render('view', [
        //    'model' => $this->findModel($id),
        //]);
    }

    /**
     * Creates a new Tablaprueba model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tablaprueba();       
        if ($model->load(Yii::$app->request->post())) {
            //echo 'response';print_r(Yii::$app->request->post());die;                         
            // ->REST
            $api = new RestClient([
                    'base_url' =>'http://localhost:8099/solorest',
                    'header' =>[
                    'Accept' => 'application/json'                    
                    ]              
                
            ]);            
            $result = $api->post('/create', json_encode(Yii::$app->request->post('Tablaprueba')),array('Content-Type' => 'application/json'));    
            //$model = $result->decode_response();                        
            $model=json_decode($result->response);
            //echo 'response';print_r($model);die;
            //echo '<pre>'; print_r(json_encode(Yii::$app->request->post()));die;   
        // <-REST                         
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
           // echo 'no post' ;print_r($model);die;
            
            return $this->render('create', [
                'model' => $model,
                'isCreated' => true,
            ]);
        }
        
        
      // if ($model->load(Yii::$app->request->post()) && $model->save()) {
      //        return $this->redirect(['view', 'id' => $model->id]);
      //    } else {
      //        return $this->render('create', [
      //            'model' => $model,
      //        ]);
      //    }
        
    }

    /**
     * Updates an existing Tablaprueba model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        
    public function actionUpdate($id)
    {
        //$model = $this->findModel($id);                
        $model = new Tablaprueba(); 
       // ->REST
       $api = new RestClient([
            'base_url' =>'http://localhost:8099/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result = $api->get('/view/?id='.$id);                
        //$model=Json::decode($result->response,true);
        //$data=$result->decode_response();
        $data = json_decode($result->response,true);
       // $model =$this->arrayToObject($data,'Tablaprueba');
       // echo 'response::  ';print_r($data);die;                
        $model->attributes = $data;
        $model->id=$id;       
         //$model->nombre='nombre10';
         //$model->descripcion='descripcion10';                
        if ($model->load(Yii::$app->request->post())) {                                             
            $result = $api->put('/update/?id='.$id, json_encode(Yii::$app->request->post('Tablaprueba')),array('Content-Type' => 'application/json'));    
            $model=json_decode($result->response);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'isCreated' => false,
            ]);
        }
        
        
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //    return $this->redirect(['view', 'id' => $model->id]);
        //} else {
        //    return $this->render('update', [
        //        'model' => $model,
        //    ]);
        //}
        
    }

    /**
     * Deletes an existing Tablaprueba model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();        
        $api = new RestClient([
            'base_url' =>'http://localhost:8099/solorest',
            'header' =>[
                'Accept' => 'application/json'
            ]
        ]);
        $result = $api->delete('/delete/?id='.$id);        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Tablaprueba model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tablaprueba the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tablaprueba::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
