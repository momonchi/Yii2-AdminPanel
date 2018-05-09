<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\systemsetting\Systemsetting */

$this->title = 'Create Systemsetting';
$this->params['breadcrumbs'][] = ['label' => 'Systemsettings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemsetting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
