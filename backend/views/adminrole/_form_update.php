<?php
use backend\models\admin\AdminPageAccess;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-role-form">

    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'role_title')->textInput(['maxlength' => 45],["required"=>true]) ?>

     <?php
    $access_pages = Yii::$app->params["access_pages"];
    $role_accesses = explode(",",$model->page_permissions);
    $page_control = new AdminPageAccess($access_pages, $role_accesses);
    $role_id = $model->role_id;

    ?>

    <div class="form-group col-md-12">
        <div class="col-md-12">
              <h3 style="margin-left:-21px;">Admin Users Management</h3>
               <?php
                $acc_page_count = count($access_pages["AdminUsers"]);
                $line_flag = 0;
                $session = Yii::$app->session;
                $page_permissions = $session->get('page_permissions');
                foreach($access_pages["AdminUsers"] as $key => $access_page){
                    $line_flag++;
                    echo "<div class='col-md-6'>";
                    echo "<h4>$key</h4>";
                    echo "<div style='margin-left:50px; padding-left:20px;'>";
                    $br_flag = 0;
                    foreach($access_page as $access_page_inner){
                        $is_checked = "";
                        $val = $access_page_inner[0];
                        $val_name = $access_page_inner[2];
                        if ($page_control->isChecked($access_page_inner[0]) ) {
                                $is_checked = 'checked="checked"'; 
                        }
                        if($role_id == 1){
                            $is_checked = 'checked="checked"';
                        }
                         ?>
                         <span class="checkbox indented"><input name="perms[]" type="checkbox" class="" value="<?= $val?>" <?= $is_checked ?> ><?= $val_name ?></span>
                         <?php
                         $br_flag++;
                         if($key != "Admin" && $key != "Members" && $br_flag == 4){
                             echo "<br>";
                             $br_flag = 0;
                         }  
                    }
                    echo "</div>";
                    echo "</div>";
                    if($line_flag == 2){
                        echo "<br>";
                        echo "<div class='col-md-12' style='width:100%; background:#999; height:1px;'></div>"; 
                        $line_flag = 0;   
                    }
                    
                }     
               ?>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
