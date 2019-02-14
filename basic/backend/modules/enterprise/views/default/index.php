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
                    <span class="caption-subject font-green sbold">编辑企业信息</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="?r=enterprise/default/update&id=<?php echo $row['id']; ?>" class="form-horizontal" id="validation-form"
                      method="post">
                    <?php echo $this->render('@app/backend/views/common/form_tip'); ?>

                    <div class="form-body form1 show">
                        <div class="form-group">
                            <label class="control-label col-md-3">企业名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Enterprise[name]" class="form-control"
                                       value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">
                                企业LOGO
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        <?php if (isset($row['logo']) && $row['logo']): ?>
                                            <img src="<?php echo $row['logo']; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                    <span class="btn red btn-outline btn-file">
                                        <span class="fileinput-new"> 选择图片 </span>
                                        <span class="fileinput-exists"> 重选图片 </span>
                                        <input type="file" name="Enterprise[logo]"> </span>
                                        <input type="hidden" name="Enterprise[logo]" value="<?php echo isset($row['logo']) ? $row['logo'] : ''; ?>">
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
                        <div class="form-group ">
                            <label class="control-label col-md-3">
                                企业二维码
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        <?php if (isset($row['qr_code']) && $row['qr_code']): ?>
                                            <img src="<?php echo $row['qr_code']; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                    <span class="btn red btn-outline btn-file">
                                        <span class="fileinput-new"> 选择图片 </span>
                                        <span class="fileinput-exists"> 重选图片 </span>
                                        <input type="file" name="Enterprise[qr_code]"> </span>
                                        <input type="hidden" name="Enterprise[qr_code]" value="<?php echo isset($row['qr_code']) ? $row['qr_code'] : ''; ?>">
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
                            <label class="control-label col-md-3">企业邮箱
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Enterprise[email]" class="form-control"
                                       value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">联系人
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Enterprise[linkman]" class="form-control"
                                       value="<?php echo isset($row['linkman']) ? $row['linkman'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">联系方式
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Enterprise[tel]" class="form-control"
                                       value="<?php echo isset($row['tel']) ? $row['tel'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                地址
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="3"
                                          name="Enterprise[address]"><?php echo isset($row['address']) ? $row['address'] : ''; ?></textarea>
                            </div>
                        </div>


                        <?php
                        \app\backend\components\AppAsset::addEdit($this);
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">企业简介<span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <script id="container" name="Enterprise[abstract]"
                                        type="text/plain"><?php echo isset($row['abstract']) ? $row['abstract'] : ''; ?></script>
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

