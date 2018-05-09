<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminRole */

$this->title = 'Admin Role: ';
$this->params['breadcrumbs'][] = ['label' => 'Admin Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_id, 'url' => ['view', 'id' => $model->role_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-role-update">


    <h3><span><?= Html::encode($this->title) ?></span><span style="color:black"><?= $model->role_title  ?></span></h3>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
