<?php
use app\backend\widgets\LinkPager;
use app\backend\components\AppAdminAcl;
use app\backend\modules\txt\models\TwNewsList;
$this->title = '课程体系';
$this->params['breadcrumbs'] = [['label'=>'品牌方案','url'=>'?r=brandplan/default/index'],['label'=>'编辑']];
?>
<style>
    .lang{
        clear:both;
    }
    .form1{
        display:none;
    }
    .show{
        display:block;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">编辑品牌方案</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="?r=brandplan/default/update&id=<?php echo $row['id']; ?>" class="form-horizontal" id="validation-form"
                      method="post">
                    <?php echo $this->render('@app/backend/views/common/form_tip'); ?>

                    <div class="form-body form1 show">
                        <div class="form-group">
                            <label class="control-label col-md-3">方案名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Brandplan[name]" class="form-control"
                                       value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"/>
                            </div>
                        </div>

                        <?php
                        \app\backend\components\AppAsset::addEdit($this);
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">方案详情<span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <script id="container" name="Brandplan[content]"
                                        type="text/plain"><?php echo isset($row['content']) ? $row['content'] : ''; ?></script>
                            </div>
                        </div>


                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">提交</button>
                                <button type="reset" class="btn default">取消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken() ?>"/>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        UE.getEditor('container');
    }
</script>

