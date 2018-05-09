<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\admin\AdminRole;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\admin */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.help-block{float:left;margin-left:5px;}
.form-control{float:left}
</style>

<div class="admin-form inline">

    <?php
    $form = ActiveForm::begin([
        'id' => 'update_adminuser',
        'options' => [
            'class' =>'form-horizontal',
        ],
        'validateOnChange' => true,
        'enableClientValidation'=> true,
        'enableAjaxValidation'=> false,
        'validateOnSubmit' => true,
    ]);

    ?>

    <?= $form->field($model, 'userid')->hiddenInput()->label('')  ?>

    <?= $form->field($model->user, 'fname')->textInput(['style'=>'width:40%'], ['maxlength' => 100])->label('First Name*',['class'=>'col-sm-2 control-label']) ?>
    <?= $form->field($model->user, 'lname')->textInput(['style'=>'width:40%'], ['maxlength' => 100])->label('Last Name*',['class'=>'col-sm-2 control-label']) ?>
    <?= $form->field($model->user, 'mname')->textInput(['style'=>'width:40%'], ['maxlength' => 100])->label('Middle Name',['class'=>'col-sm-2 control-label']) ?>
    <?= $form->field($model->user, 'email')->textInput(['style'=>'width:30%'], ['maxlength' => 100])->label('Email*',['class'=>'col-sm-2 control-label']) ?>
    
    <div class="form-group field-adminuser-email required">
        <label class="col-sm-2 control-label" for="admin-role_id">Role</label>
        <select  id="admin-role_id" class="form-control" name="role_id" style="width:30%">
        <?php 
            $roles = AdminRole::find()->all();
            foreach($roles as $role){
                $roleid = $role["role_id"];
                $roletitle = $role["role_title"];
                if($roletitle !== "Admin"){
                    echo "<option id='$roleid' value='$roleid'>$roletitle</option>";
                }     
            }
        ?>
        </select>
    </div>
    <?= $form->field($model, 'position')->textInput(['style'=>'width:30%'], ['maxlength' => 45])->label('Position',['class'=>'col-sm-2 control-label']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
