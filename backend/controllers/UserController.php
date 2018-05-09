<?php

namespace backend\controllers;

use Yii;  
use backend\models\admin\AdminUser;
use backend\models\admin\UserSearch;
use backend\models\admin\AdminPageAccess;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for AdminUser model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","user/index")){  
            if(AdminPageAccess::ifHasAccess("AdminUsers","user/index") == NULL){
                Yii::$app->user->logout();
                return $this->goHome();     
            }                       
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }     
          
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @param string $password_hash
     * @return mixed
     */
    public function actionView($id, $password_hash)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $password_hash),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'password_hash' => $model->password_hash]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $password_hash
     * @return mixed
     */
    public function actionUpdate($id, $password_hash)
    {
        $model = $this->findModel($id, $password_hash);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'password_hash' => $model->password_hash]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $password_hash
     * @return mixed
     */
    public function actionDelete($id, $password_hash)
    {
        $this->findModel($id, $password_hash)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $password_hash
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $password_hash)
    {
        if (($model = AdminUser::findOne(['id' => $id, 'password_hash' => $password_hash])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
