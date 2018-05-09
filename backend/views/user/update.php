<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminUser */

$this->title = 'Update Admin User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'password_hash' => $model->password_hash]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
