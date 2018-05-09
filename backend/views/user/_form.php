<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'verify_code')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'title_prefix')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'user_type')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'accountid')->textInput() ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
