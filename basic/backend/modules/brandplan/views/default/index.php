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
                        <div class="form-group ">
                            <label class="control-label col-md-3">
                                方案图片

                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        <?php if (isset($row['img']->img) && $row['img']->img): ?>
                                            <img src="<?php echo $row['img']->img; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                    <span class="btn red btn-outline btn-file">
                                        <span class="fileinput-new"> 选择图片 </span>
                                        <span class="fileinput-exists"> 重选图片 </span>
                                        <input type="file" name="Brandplan[img][img]"> </span>
                                        <input type="hidden" name="Brandplan[img][img]" value="<?php echo isset($row['img']->img) ? $row['img']->img : ''; ?>">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
<!--                                <div class="clearfix margin-top-10">-->
<!--                                    <span class="label label-success">警告!</span> 图片预览仅仅支持 IE10+,-->
<!--                                    FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">
<!--                                方案图片-->
<!---->
<!--                                <span class="required"> * </span>-->
                            </label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        <?php if (isset($row['img']->img1) && $row['img']->img1): ?>
                                            <img src="<?php echo $row['img']->img1; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                    <span class="btn red btn-outline btn-file">
                                        <span class="fileinput-new"> 选择图片 </span>
                                        <span class="fileinput-exists"> 重选图片 </span>
                                        <input type="file" name="Brandplan[img][img1]"> </span>
                                        <input type="hidden" name="Brandplan[img][img1]" value="<?php echo isset($row['img']->img1) ? $row['img']->img1 : ''; ?>">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
<!--                                <div class="clearfix margin-top-10">-->
<!--                                    <span class="label label-success">警告!</span> 图片预览仅仅支持 IE10+,-->
<!--                                    FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">
<!--                                方案图片-->
<!---->
<!--                                <span class="required"> * </span>-->
                            </label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        <?php if (isset($row['img']->img2) && $row['img']->img2): ?>
                                            <img src="<?php echo $row['img']->img2; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                    <span class="btn red btn-outline btn-file">
                                        <span class="fileinput-new"> 选择图片 </span>
                                        <span class="fileinput-exists"> 重选图片 </span>
                                        <input type="file" name="Brandplan[img][img2]"> </span>
                                        <input type="hidden" name="Brandplan[img][img2]" value="<?php echo isset($row['img']->img2) ? $row['img']->img2 : ''; ?>">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 图片预览仅仅支持 IE10+,
                                    FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                推荐理由
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="10" cols="10"
                                          name="Brandplan[recommend]"><?php echo isset($row['recommend']) ? $row['recommend'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                品牌介绍
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="10" cols="10"
                                          name="Brandplan[introduce]"><?php echo isset($row['introduce']) ? $row['introduce'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                教学特色
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="10" cols="10"
                                          name="Brandplan[characteristic]"><?php echo isset($row['characteristic']) ? $row['characteristic'] : ''; ?></textarea>
                            </div>
                        </div>

<!--                        --><?php
//                        \app\backend\components\AppAsset::addEdit($this);
//                        ?>
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3">方案详情<span class="required"> * </span>-->
<!--                            </label>-->
<!--                            <div class="col-md-6">-->
<!--                                <script id="container" name="Brandplan[content]"-->
<!--                                        type="text/plain">--><?php //echo isset($row['content']) ? $row['content'] : ''; ?><!--</script>-->
<!--                            </div>-->
<!--                        </div>-->


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

