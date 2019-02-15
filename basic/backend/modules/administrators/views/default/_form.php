<form action="?r=administrators/default/<?php echo $action; ?>" class="form-horizontal" id="validation-form"
      method="post">
    <?php echo $this->render('@app/backend/views/common/form_tip'); ?>

    <div class="form-body form1 show">

            <?php if(isset($row['id'])){?>
                <input type="hidden" class="form-control" name="Admin[id]" id="banner_id" value="<?php echo $row['id'];?>">
            <?php }?>
        <div class="form-group">
            <label class="control-label col-md-3">用户名
                <span class="required"> * </span>
            </label>
            <div class="col-md-4">
                <input type="text" id="name" name="Admin[name]" class="form-control"
                       value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">密码
                <span class="required"> * </span>
            </label>
            <div class="col-md-4">
                <input type="password" name="Admin[password]" class="form-control"
                       value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>"/>
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
