<?php

namespace backend\controllers;

use Yii;
use backend\models\systemsetting\Systemsetting;
use backend\models\systemsetting\SystemsettingSearch;
use backend\models\admin\AdminPageAccess;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SystemsettingsController implements the CRUD actions for Systemsetting model.
 */
class SystemsettingsController extends Controller
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
     * Lists all Systemsetting models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","systemsettings/index")){  
                                   
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }

    	return $this->render('view', [
            'model' => $this->findModel(1),
        ]);


        // $searchModel = new SystemsettingSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    /**
     * Displays a single Systemsetting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","systemsettings/view")){  
                                   
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Systemsetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Systemsetting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->system_setting]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Systemsetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!AdminPageAccess::ifHasAccess("AdminUsers","systemsettings/update")){  
                                   
            throw new NotFoundHttpException('You have no access to this resource.'); 
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    protected function findModel($id)
    {
        if (($model = Systemsetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
