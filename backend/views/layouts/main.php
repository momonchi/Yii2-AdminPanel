<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\icons\Icon;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="">
    .alert-error{color:red}
    h3{color:royalblue}
    p{color:#808080}
    </style>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Admin Panel',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],

            ]);

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {     
                                 
                $menuItems[] = ['label' => 'Admin', 'url' => ['#'], 'items' => [               
                    ['label' => 'Admin Users', 'url' => ['admin/index']],
                    ['label' => 'Admin Roles', 'url' => ['adminrole/index']] ,
                    ['label' => 'System Settings', 'url' => ['systemsettings/index']]                   
                    
                ]];  
                
                $menuItems[] = ['label' => "<span class='glyphicon glyphicon-user'></span> ". Yii::$app->user->identity->fname . ' '. Yii::$app->user->identity->lname, 'url' => ['#'], 'items' => [
                    ['label' => 'Change Password', 'url' => ['admin/passchange']],
                    ['label' => 'Logout','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']], 
                ]];

            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' =>false,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Admin Panel <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
