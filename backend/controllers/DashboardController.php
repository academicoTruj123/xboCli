<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Usuario;


class DashboardController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndexcliente()
    {
        $modeluser = new Usuario();
        $modeluser =Yii::$app->session['ss_user'];                
        return $this->render('indexcliente');
    }

    public function actionIndexempresa()
    {
        $modeluser = new Usuario();
        $modeluser =Yii::$app->session['ss_user']; 
        return $this->render('indexempresa');
    }    

    public function actionIndexadministrador()
    {
        return $this->render('indexadministrador');
    }    

}
