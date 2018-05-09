<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\systemsetting\SystemsettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Systemsettings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemsetting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Systemsetting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'default_time_allowance',
                'default_time_zone'

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
