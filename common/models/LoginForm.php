<?php
namespace common\models;

use Yii;
use yii\base\Model;
use restclient;
use backend\models\Usuario;
use common\models\Reponseapi;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $intTipoLogin;   
    public $intTipoUsuario; 
    public $vchTipoUsuario; 

    private $_user;
    public $urlapiLogin ='http://localhost:8099/loginrest';
    //public $urlapiLogin ='';
    public $mensaje='';

    const LOGIN_CUENTA_SISTEMA = '0201';
    const LOGIN_CUENTA_FACEBOOK = '0202';
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
           // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login($model)
    {               
        //if ($this->validate()) {                           
                $api = new RestClient([
                        'base_url' =>$this->urlapiLogin,
                        'header' =>[
                        'Accept' => 'application/json'                    
                       ]                              
                ]);    
                                               
                //echo 'validarlogin ';print_r($model);die;
                //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=loginrest%2Fvalidarlogin', json_encode($model),array('Content-Type' => 'application/json'));                
                $result = $api->post('/validarlogin', json_encode($model),array('Content-Type' => 'application/json'));                         
                $modelusu = new Usuario(); 
                $responseapi = new Reponseapi();
                $responseapi =json_decode($result->response);
                
                if($responseapi->status==true){
                    $modelusu=$responseapi->data;
                    $this->mensaje='';
                   // echo 'respuesta despues del registro ';print_r($modelusu);die;
                }else{
                    $modelusu=null;
                    $this->mensaje=$responseapi->data;
                   //echo 'respuesta despues del registro ';print_r($responseapi->data);die; 
                }        
                return $modelusu;                
        //} else {
         //   return null;
       // }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
           // $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
    
     public function getGeneratedPassRecuperacion()
    {                
        $this->password = Yii::$app->security->generateRandomString(6);
    }
                       
    public function recuperarcontrasenia($model)
    {               
        //if ($this->validate()) {                           
                $api = new RestClient([
                        'base_url' =>$this->urlapiLogin,
                        'header' =>[
                        'Accept' => 'application/json'                    
                       ]                              
                ]);  
                
                //$result = $api->post('http://flowers.pe/expoapi/web/index.php?r=loginrest%2Frecuperarcontrasena', json_encode($model),array('Content-Type' => 'application/json'));
                $result = $api->post('/recuperarcontrasena', json_encode($model),array('Content-Type' => 'application/json'));                         
                $modelusu = new Usuario(); 
                $responseapi = new Reponseapi();                                                
                $responseapi =json_decode($result->response);                
                if($responseapi->status==true){
                    $modelusu=$responseapi->data;
                    $this->mensaje='';                   
                }else{
                    $modelusu=null;
                    $this->mensaje=$responseapi->data;                  
                }        
                return $modelusu;                
        //} else {
         //   return null;
       // }
    }
    
}
