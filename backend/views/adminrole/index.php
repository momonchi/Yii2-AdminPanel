<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\admin\AdminRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],  
            [                      
                'label' => 'Role ID',  
                'format' => 'html', 
                'value' => function ($model) {                                                                                
                    return $model->role_id;
                },
            ],
            [                      
                'label' => 'Title',  
                'format' => 'html', 
                'value' => function ($model) {                                                                                
                    return $model->role_title;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} ',
                'buttons' => [

                ],
            ],
        ],
    ]); ?>

</div>
