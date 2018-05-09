<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\systemsetting\Systemsetting */

$this->title = 'Update Systemsetting: ' . ' ' . $model->system_setting;
$this->params['breadcrumbs'][] = ['label' => 'Systemsettings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->system_setting, 'url' => ['view', 'id' => $model->system_setting]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="systemsetting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
