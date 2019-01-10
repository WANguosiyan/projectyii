<?php
use app\backend\components\AppAsset;
use app\backend\widgets\Breadcrumbs;
use yii\helpers\Html;
AppAsset::register($this);
AppAsset::addScript($this,$this->context->data['js']);
AppAsset::addStyle($this,$this->context->data['css']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="Firefox" />
        <?php Html::csrfMetaTags(); ?>
        <title><?php echo \yii::$app->session['title'].'后台管理系统-'.Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <?php $this->beginBody();?>
        <?php echo $this->render('_common/page_header.php');?>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <?php echo $this->render('_common/page_sidebar');?>
            </div>
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content clearfix">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <?php echo Breadcrumbs::widget([
                            'links' =>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- END PAGE HEADER-->
                    <?php echo $content;?>

                    <script>
                        var web_url = '<?php echo Yii::$app->params['web_url'];?>';
                        var api_url = '<?php echo Yii::$app->params['api_url'];?>';
                    </script>
                    <input type="hidden" class="request-csrf" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                </div>
            </div>
        </div>
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
<!--            <div class="page-footer-inner"> 2016 &copy;  by .-->
<!--                <a href="" title="" target="_blank">辰到</a>-->
<!--            </div>-->
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>