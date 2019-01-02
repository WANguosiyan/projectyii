<?php
use app\backend\components\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <?php Html::csrfMetaTags(); ?>
        <title><?php echo \yii::$app->session['title'].'后台管理系统-登录页面'; ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">
        <?php $this->beginBody();?>
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="/index.html">
                <img src="<?php echo \yii\helpers\Url::to('@web/themes/dm/images/logo.png');?>" alt="" />
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php echo Html::csrfMetaTags() ?>
            <?php echo $content;?>
        </div>
        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>