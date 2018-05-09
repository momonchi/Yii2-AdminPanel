<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\admin */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => '#'];
$this->params['breadcrumbs'][] = 'Change Password';
?>

<?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
?>

<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_passchange', [
        //'model' => $model,
    ]) ?>

</div>
