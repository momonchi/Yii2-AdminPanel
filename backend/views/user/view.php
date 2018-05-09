<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'password_hash' => $model->password_hash], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'password_hash' => $model->password_hash], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'create_date',
            'created_at',
            'updated_at',
            'date_verified',
            'is_verified',
            'verify_code',
            'status',
            'title_prefix',
            'fname',
            'mname',
            'lname',
            'user_type',
            'accountid',
            'role',
            'avatar',
        ],
    ]) ?>

</div>
