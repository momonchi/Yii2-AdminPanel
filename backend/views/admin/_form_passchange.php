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

<div class="admin-form">

    <?php

    $form = ActiveForm::begin([
        'id' => 'passchange',
        'options' => [
            'class' =>'',
        ],
        'validateOnChange' => true,
        'enableClientValidation'=> true,
        'enableAjaxValidation'=> false,
        'validateOnSubmit' => true,
    ]);

    ?>
    <?= Html::hiddenInput('saveon','true') ?>

    <?php        
    if(isset($_POST['passwd']) && isset($_POST['passwd']) != ""){ 
    ?>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><span class='glyphicon glyphicon-user'></span></span>
        <input type="password" name="passwd" value="<?= $_POST['passwd'] ?>" class="form-control" placeholder="Password" aria-describedby="basic-addon1" style="width:40%">
    </div>
    <?php }else{ ?>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class='glyphicon glyphicon-user'></span></span>
            <input type="password" name="passwd" value="" class="form-control" placeholder="Password" aria-describedby="basic-addon1" style="width:40%">
        </div>
    <?php } ?>

    <br/><br/>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success'] ) ?>
        <?= Html::a('Cancel','/admin', ['class' => 'btn'] ) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
