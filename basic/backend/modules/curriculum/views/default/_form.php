<form action="?r=curriculum/default/<?php echo $action; ?>" class="form-horizontal" id="validation-form"
      method="post">
    <?php echo $this->render('@app/backend/views/common/form_tip'); ?>

    <div class="form-body form1 show">

            <?php if(isset($row['id'])){?>
                <input type="hidden" class="form-control" name="Curriculum[id]" id="banner_id" value="<?php echo $row['id'];?>">
            <?php }?>
        <div class="form-group">
            <label class="control-label col-md-3">体系名称
                <span class="required"> * </span>
            </label>
            <div class="col-md-4">
                <input type="text" id="name" name="Curriculum[name]" class="form-control"
                       value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"/>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label col-md-3">
                封面图
                <span class="required"> * </span>
            </label>
            <div class="col-md-9">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                         style="width: 360px; height: 180px;">
                        <?php if (isset($row['cover_img']) && $row['cover_img']): ?>
                            <img src="<?php echo $row['cover_img']; ?>">
                        <?php endif; ?>
                    </div>
                    <div>
                        <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> 选择图片 </span>
                        <span class="fileinput-exists"> 重选图片 </span>
                        <input type="file" name="Curriculum[cover_img]" id="cover_img"> </span>
                        <input type="hidden" name="Curriculum[cover_img]" value="<?php echo isset($row['cover_img'])?$row['cover_img']:''; ?>">
                        <a href="javascript:;" class="btn red fileinput-exists"
                           data-dismiss="fileinput"> 删除 </a>
                    </div>
                </div>
                <div class="clearfix margin-top-10">
                        <span class="label label-success">警告!</span> <span style="color:red">图片预览仅仅支持 IE10+,
                        FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.</span>
                </div>
            </div>
        </div>
<!--        --><?php
//        \app\backend\components\AppAsset::addEdit($this);
//        ?>
<!--        <div class="form-group">-->
<!--            <label class="control-label col-md-3">体系简介<span class="required"> * </span>-->
<!--            </label>-->
<!--            <div class="col-md-6">-->
<!--                <script id="container" name="Curriculum[content]"-->
<!--                        type="text/plain">--><?php //echo isset($row['content']) ? $row['content'] : ''; ?><!--</script>-->
<!--            </div>-->
<!--        </div>-->
        <div class="form-group">
            <label class="col-md-3 control-label">
                体系简介
                <span class="required"> * </span>
            </label>
            <div class="col-md-8">
                                <textarea class="form-control" rows="10" cols="10"
                                          name="Curriculum[content]"><?php echo isset($row['content']) ? $row['content'] : ''; ?></textarea>
            </div>
        </div>
    </div>


    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3">排序
                <span class="required"> * </span>
            </label>
            <div class="col-md-1">
                <input type="text" name="Curriculum[sort]" id="sort" class="form-control"
                       value="<?php echo isset($row['sort'])?$row['sort']:1;?>"/>
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
    <input type="hidden" name="_csrf" id="_csrf" value="<?php echo Yii::$app->request->getCsrfToken() ?>"/>
</form>
<script>
    window.onload = function(){
        UE.getEditor('container');
    }
</script>