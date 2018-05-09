<?php

namespace backend\controllers;

use Yii;
use backend\models\admin\AdminRole;
use backend\models\admin\AdminRoleSearch;
use backend\models\admin\AdminPageAccess;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminRoleController implements the CRUD actions for AdminRole model.
 */
class AdminroleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'update', 'delete','index'],
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
     * Lists all AdminRole models.
     * @return mixed
     */
    public function actionIndex()
    {        
        if (!AdminPageAccess::ifHasAccess("AdminUsers","adminrole/index")){                                 
            throw new NotFoundHttpException('You have no access to this resource.'); 
        } 
        
                
        $searchModel = new AdminRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminRole model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","adminrole/view")){                           
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }

        $searchModel = new AdminRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Creates a new AdminRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","adminrole/create")){                           
            throw new NotFoundHttpException('You have no access to this resource.'); 
        } 
        
        $model = new AdminRole();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->role_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","adminrole/update")){                           
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $accessed_pages = "";
            if(isset($_POST["perms"])){
                $accessed_pages = implode(",", $_POST["perms"]);    
            }
            
            if($_POST["AdminRole"]["role_title"] == "Admin"){
                $model->page_permissions = "*";
            }else{
                $model->page_permissions = $accessed_pages;
            }
            
            $result = $model->save();
            return $this->redirect(['update', 'id' => $model->role_id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminRole model.
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
     * Finds the AdminRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
