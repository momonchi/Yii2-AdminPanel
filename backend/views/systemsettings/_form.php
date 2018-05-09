<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$Zonelist = \DateTimeZone::listIdentifiers();
$op = "<option value=''>Select Language:</option>";
foreach($Zonelist as $zone){ 
   $selected = "";
   if($model->default_time_zone == $zone){
     $selected = "selected";  
   }
    $op .= "<option value='$zone' $selected>$zone</option>";
}

?>

<div class="systemsetting-form">
    <div class="col-md-12" style="padding: 0">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">  
	    <?= $form->field($model, 'default_time_allowance', [
	                    'template' => "<div class='form-group'>
	                                      <label class='col-md-2 control-label' for='textinput' style='text-align: right;line-height: 30px;'>{label}</label>  
	                                      <div class='col-md-3'>
	                                      {input}
	                                      <span class='help-block'>\n{hint}\n{error}</span>  
	                                      </div>
	                                    </div>",
	                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]
	    ])->textInput(['maxlength' => true])?>
	    </div> 

		<div class="row">  
	    	<?= $form->field($model, 'default_time_zone', [
	            'template' => "<div class='form-group'>
	                              <label class='col-md-2 control-label' for='textinput' style='text-align: right;line-height: 30px;'>Default Timezone</label>  
	                              <div class='col-md-3'>
	                                    <select id='Systemsetting-default_time_zone' class='form-control' name='Systemsetting[default_time_zone]'>
	                                         $op
	                                    </select>
	                              <span class='help-block'>\n{hint}\n{error}</span>  
	                              </div>
	                            </div>",
	            'labelOptions' => [ 'class' => 'your_custom_class_name' ]
	            ])->textInput(['maxlength' => true])?>
	    </div>    

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
