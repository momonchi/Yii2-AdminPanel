<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\admin */

$this->title = 'Update Admin User : ' . ' ' . $model->user->fname . " ". $model->user->lname;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->admin_id, 'url' => '#'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
