<?php
namespace backend\controllers;

use Yii;                       
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;           

require_once('GlobalVar.php'); 
/**
 * Site controller
 */
class DeveloperController extends Controller
{                                  
     public $enableCsrfValidation = false; 
     
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'sampleformupload', 'submitform'],
                'rules' => [
                    [
                        'actions' => ['signup', 'sampleformupload', 'submitform'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }          
    
    public static function validateToken(){
        
        $headers = ["devtoken",'userlang','Cache-Control', 'HTTP_X_REQUESTED_WITH','contentType'];
        $headers[] = 'accept';
        $headers[] = 'content-type';     
        $header = implode(",", $headers);                                          
        header('Access-Control-Allow-Headers: '.$header);    
        header('Access-Control-Allow-Origin: *'); 
        /*header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json'); */
        
        $devtoken = $_SERVER['HTTP_DEVTOKEN'];       
        
        //$devtoken = $_REQUEST["devtoken"];
        $developer = User::find()->where(['dev_token' => $devtoken, 'user_type'=>'Developer'])->one();        
        if (!$developer){                                                  
            $messages = array("Invalid Developer Token", "Please secure developer token first");
            $data = array();                         
            echo json_encode( array("Result" => "0", "Message" => $messages, "Data" => $data ) );
            exit;
        }
    }
    
    public static function setUserLanguage(){
        $lang = $_SERVER['HTTP_USERLANG'];
        if ($lang){
            Yii::$app->language = $lang;    
        }else{
           Yii::$app->language = 'en'; 
        }
        
        //echo Yii::t('app', 'Welcome_flag'); 
    }  
    
}
