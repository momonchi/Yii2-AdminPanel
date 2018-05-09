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

    <div class="form-group field-admin-user-fname has-success">
        <?= Html::label('First Name*','',['class'=>'col-sm-2 control-label'] ) ?>
        <?= Html::input('text','User[fname]',"",["class"=>'form-control col-sm-2 control-label', "style" => 'text-align:left;width:30%', "required"=>true ] )  ?>
    </div>

    <div class="form-group field-admin-user-lname has-success">
        <?= Html::label('Last Name*','',['class'=>'col-sm-2 control-label'] ) ?>
        <?= Html::input('text','User[lname]',"",["class"=>'form-control col-sm-2 control-label', "style" => 'text-align:left;width:30%', "required"=>true ] )  ?>
    </div>

    <div class="form-group field-admin-user-mname has-success">
        <?= Html::label('Middle Name','',['class'=>'col-sm-2 control-label'] ) ?>
        <?= Html::input('text','User[mname]',"",["class"=>'form-control col-sm-2 control-label', "style" => 'text-align:left;width:30%'] )  ?>
    </div>

    <div class="form-group field-admin-user-email has-success">
        <?= Html::label('Email*','',['class'=>'col-sm-2 control-label'] ) ?>
        <?= Html::input('email','User[email]',"",["class"=>'form-control col-sm-2 control-label', "style" => 'text-align:left;width:30%', "required"=>true, "data-error="=>"Please enter a valid email address" ] )?>
    </div>

    <div class="form-group field-admin-user-password has-success">
        <?= Html::label('Password*','',['class'=>'col-sm-2 control-label'] ) ?>
        <?= Html::input('password','User[password]',"",["class"=>'form-control col-sm-2 control-label', "style" => 'text-align:left;width:30%', "required"=>true ] )  ?>
    </div>

    <?= $form->field($model, 'role_id')
             ->dropDownList(
                ArrayHelper::map(AdminRole::find()->all(), 'role_id', 'role_title'),
                ['style'=>'width:30%']
             )->label('Role',['class'=>'col-sm-2 control-label'])
    ?>
    <?= $form->field($model, 'position')->textInput(['style'=>'width:30%',"required"=>false], ['maxlength' => 45])->label('Position',['class'=>'col-sm-2 control-label']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
