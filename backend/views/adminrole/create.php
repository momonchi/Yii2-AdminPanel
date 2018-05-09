<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminRole */

$this->title = 'Create Admin Role';
$this->params['breadcrumbs'][] = ['label' => 'Admin Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>



</div>
