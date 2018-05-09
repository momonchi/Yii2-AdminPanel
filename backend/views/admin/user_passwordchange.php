<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\admin */

$this->title = 'Change Password of user ';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => '#'];
$this->params['breadcrumbs'][] = 'Change Password';
?>

<?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
?>

<div class="admin-update">

    <h3><span><?= Html::encode($this->title) ?></span><span style="color:black"><?= $model->user->fname. " ". $model->user->lname ?></span></h3>

    <?= $this->render('_form_passchange', [
        'model' => $model,
    ]) ?>

</div>
