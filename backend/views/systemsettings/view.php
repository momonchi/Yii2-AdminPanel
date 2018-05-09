<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\systemsetting\Systemsetting */

$this->title = "System Settings";
$this->params['breadcrumbs'][] = ['label' => 'Systemsettings', 'url' => ['index']];
?>
<div class="systemsetting-view">

    <h1>System Settings</h1>
    <hr/>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->system_setting], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="col-md-4" style="padding: 0">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'default_time_allowance',
                'default_time_zone'
            ],
        ]) ?>
    </div>
</div>
