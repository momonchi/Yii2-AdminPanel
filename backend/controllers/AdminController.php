<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\admin\Admin;
use backend\models\admin\AdminUser;
use backend\models\admin\AdminSearch;
use backend\models\admin\AdminPageAccess;
use yii\db;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for admin model.
 */
class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'update', 'delete','index','passchange', 'userpasswordchange'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all admin models.
     * @return mixed
     */
    public function actionIndex()
    {                                     
        if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/index")){  
                                   
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }   
        /*if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/index")){
            throw new NotFoundHttpException('You have no access to this resource.');
        }
         */
        $searchModel = new AdminSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/view")){
            throw new NotFoundHttpException('You have no access to this resource.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/create")){
            throw new NotFoundHttpException('You have no access to this resource.');
        }

        $model = new admin();

        if ($model->load(Yii::$app->request->post()) ) {

            //create user first
            $user = new AdminUser;
            $user->fname = $_POST["User"]["fname"];
            $user->lname = $_POST["User"]["lname"];
            $user->mname = $_POST["User"]["mname"];
            $user->email = $_POST["User"]["email"];
            $user->username = $_POST["User"]["email"];
            $new_passhash = Yii::$app->security->generatePasswordHash($_POST["User"]["password"]);
            $user->password_hash = $new_passhash;
            $new_authkey = Yii::$app->security->generateRandomString();
            $user->auth_key = $new_authkey;
            $user->created_at = strtotime(date("Y-m-d H:i:s"));
            $user->status = 10;
            $result = $user->save();

            if (count($user->errors) > 0){
                foreach($user->errors as $err){
                       Yii::$app->getSession()->setFlash('success', $err[0]);
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                $model->userid = $user->id;
                $model->role_id = $_POST["Admin"]["role_id"];
                $model->position= $_POST["Admin"]["position"];
                $model->save();
                return $this->redirect(['view', 'id' => $model->admin_id]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/update")){
            throw new NotFoundHttpException('You have no access to this resource.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ){
            $model->role_id = $_POST["role_id"];
            
            if ($model->save()){

                //save changes in name
                if(isset($_POST["AdminUser"])){
                    $model->user->fname = $_POST["AdminUser"]["fname"];
                    $model->user->lname = $_POST["AdminUser"]["lname"];
                    $model->user->mname = $_POST["AdminUser"]["mname"];
                    $model->user->email = $_POST["AdminUser"]["email"];    
                    $model->user->username = $_POST["AdminUser"]["email"];
                    
                    
                    if($model->user->save()){
                        Yii::$app->getSession()->setFlash('success', 'Successfully saved record!');
                        return $this->redirect(['view', 'id' => $model->admin_id]);    
                    }else{
                        Yii::$app->getSession()->setFlash('error', 'Erro saving record!');
                    }    
                }
                

                
                
            }else{
                Yii::$app->getSession()->setFlash('error', 'Erro saving record!');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }


        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->admin_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }                                                                */
    }

    /**
     * Deletes an existing admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        User::find()->where(['id' =>$id])->one()->delete();

        return $this->redirect(['index']);
    }

    public function actionUserpasswordchange($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","admin/userpasswordchange")){
            throw new NotFoundHttpException('You have no access to this resource.');
        }

        $model = $this->findModel($id);

        if (isset($_POST["saveon"]) && $_POST["saveon"] != "") {

            $userid = $model->user->id ;

            if (strlen($_POST["passwd"]) < 4){
                Yii::$app->getSession()->setFlash('error', 'Password must be at least 4 characters with letters and numbers only');
                return $this->redirect('passchange');
            }

            $new_passhash = Yii::$app->security->generatePasswordHash($_POST["passwd"]);
            $connection = Yii::$app->db;
            $result = $connection->createCommand()
                        ->update('user', ['password_hash' => $new_passhash], 'id = ' .$userid  )
                        ->execute();

            if ($result) {
                Yii::$app->getSession()->setFlash('success', 'Successfully changed password!');
            }else{
                Yii::$app->getSession()->setFlash('error', 'Errors found on your request');
            }
            return $this->render('user_passwordchange', ['model' => $model,]);
        }else{
            return $this->render('user_passwordchange', ['model' => $model,]);
        }


    }

    public function actionPasschange()
    {
        if (isset($_POST["saveon"]) && $_POST["saveon"] != "") {
            $userid = Yii::$app->user->identity->id ;
            if (strlen($_POST["passwd"]) < 4){
                Yii::$app->getSession()->setFlash('error', 'Password must be at least 4 characters with letters and numbers only');
                return $this->redirect('passchange');
            }

            $new_passhash = Yii::$app->security->generatePasswordHash($_POST["passwd"]);
            $connection = Yii::$app->db;
            $result = $connection->createCommand()
                        ->update('user', ['password_hash' => $new_passhash], 'id = ' .$userid  )
                        ->execute();

            if ($result) {
                Yii::$app->getSession()->setFlash('success', 'Successfully changed password!');
            }else{
                Yii::$app->getSession()->setFlash('error', 'Errors found on your request');
            }
            return $this->redirect('passchange');

        } else {
            return $this->render('passchange', []);
        }
    }

    /**
     * Finds the admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
