<?php

namespace backend\controllers;
use Yii;
use common\models\LoginForm;
use common\models\Tablacodigo;
use backend\models\Usuario;
use backend\models\Usuarioempresa;
use backend\models\Ubigeo;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * UsuarioempresaController implements the CRUD actions for Usuarioempresa model.
 */
class UsuarioempresaController extends Controller
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
     * Lists all Usuarioempresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioempresaBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarioempresa model.
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
     * Creates a new Usuarioempresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarioempresa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->intIdUsuempresa]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuarioempresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->intIdUsuempresa]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuarioempresa model.
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
     * Finds the Usuarioempresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarioempresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarioempresa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionUpdateperfil(){
        
        $modeluser = new Usuario();
        $modeluser =Yii::$app->session['ss_user']; 
        
        $model = New Usuarioempresa();        
        $model =  $model->findxIdUsuario($modeluser->intIdUsuario);        
        // ver porque no funciona el load 
        if ($model->load(Yii::$app->request->post())) { 
            
            if($model->dtmFechaCreacion == null){                
            }else
            {                
               $model->dtmFechaCreacion = date('Y-m-d',  strtotime($model->dtmFechaCreacion)); 
            }            
    
            if($model->intIdUbigeo == null){
                $model->intIdUbigeo = 0;
                $model->vchDomicilioUbigeo = '';
            }else{
                $model->vchDomicilioUbigeo = $this->getTextUbigeo($model->intIdUbigeo);
            }
            
            $model->dtiFechaUltMod =date('Y-m-d H:i:s');                                    
            $model = $model->update($model);
            if($model==null){     
                
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    <strong>No se pudo actualizar el perfil</strong></div>'
                 ); 
                // .$model->mensaje.
                return $this->render('updateperfil', [
                    'model' => $model,
                ]); 
                
                //throw new NotFoundHttpException('Error al actualizar el perfil de la empresa');
            }else
            {  
                
               Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i> Aviso!</h4>
                    <strong>Perfil actualizado correctamente.</strong></div>'
                 );
               
                return $this->render('updateperfil', [
                    'model' => $model,
                ]);
            }                                
        } else {
            
            return $this->render('updateperfil', [
                'model' => $model,
            ]);
        }
                        
    }
    
    private function getTextUbigeo($idUbigeo){        
      $listaUbigeo=Ubigeo::getAll();  
     foreach ($listaUbigeo as $ubigeoItem) {      
            if($ubigeoItem->intIdubigeo==$idUbigeo){
                    return $ubigeoItem->vchUbigeo;
            }
     }
    
    }

    
}
