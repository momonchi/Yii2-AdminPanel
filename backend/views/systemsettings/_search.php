<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\systemsetting\SystemsettingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="systemsetting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'system_setting') ?>

    <?= $form->field($model, 'minimum_purchase') ?>

    <?= $form->field($model, 'invite_credits_per_purchase') ?>

    <?= $form->field($model, 'points_level_1') ?>

    <?= $form->field($model, 'points_level_2') ?>

    <?php // echo $form->field($model, 'points_level_3') ?>

    <?php // echo $form->field($model, 'points_level_4') ?>

    <?php // echo $form->field($model, 'points_level_5') ?>

    <?php // echo $form->field($model, 'points_level_6') ?>

    <?php // echo $form->field($model, 'points_level_7') ?>

    <?php // echo $form->field($model, 'points_level_8') ?>

    <?php // echo $form->field($model, 'points_level_9') ?>

    <?php // echo $form->field($model, 'points_level_10') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
