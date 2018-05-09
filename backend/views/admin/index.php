<?php

use backend\models\admin\AdminRole; 
use backend\models\admin\AdminUser;  
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\admin\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?> -->
        <?= Html::a('Create Admin User', ['/admin/create'], ['class'=>'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*'userid',*/ 
            [                      
                'label' => 'Admin ID',  
                'format' => 'html', 
                'value' => function ($model) {   
                    return $model->admin_id;
                },
            ],  
            [
                 'attribute' => 'fname',
                 'format' => 'raw',
                     'value'=>function ($data) {
                        return Html::a(Html::encode($data->user->fname),'view?id='.$data->admin_id);
                    },
             ],
             [
                 'attribute' => 'lname',
                 'value' => 'user.lname'
             ], 
             [
                 'attribute' => 'email',
                 'value' => 'user.email'
             ],      
             [
                //'attribute'=>'role_id',
                'label' => 'Role ID',  
                'format' => 'html',
                'filter' => AdminRole::getRoles(),
                 'value' => 'role.role_title'
            ],

             /*[
                'attribute' => 'some_title',
                'format' => 'raw',
                'value' => function ($model) {
                        return '<div>'.$model->admin_id.' and other html-code</div>';
                },
            ],      */
            /*'role_id', */
            [                      
                'label' => 'Position',  
                'format' => 'html', 
                'value' => function ($model) {   
                    return $model->position;
                },
            ],         

/*            ['class' => 'yii\grid\ActionColumn'],*/
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {password} ',
                'buttons' => [
                    'password' => function ($url, $model) {
                            $url = "userpasswordchange?id=". $model->admin_id;
                        return Html::a(
                            '<span class="glyphicon glyphicon-lock"</span>',
                            $url,
                            [
                                'title' => 'Password',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
