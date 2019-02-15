<style>
    .clear {
        clear: both;
    }
    .layui-layer-close{
        display:none !important;
    }
</style>
<div class="portlet light bordered dataTables_wrapper">
    <div class="portlet-body">
<!--        <div class="portlet-title margin-bottom-20">处理说明</div>-->
        <div class="form-group">
            <label class="control-label col-md-4">处理说明</label>
            <div class="col-md-8">
                <textarea name="memo"  class="handle_comment form-control" rows="10"><?php echo isset($row['memo'])?$row['memo']:'';?></textarea>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form-actions margin-top-20">
            <input type="hidden" id="_csrf" value="<?php echo Yii::$app->request->getCsrfToken();?>"/>
           <input type="button" data-id="<?php echo isset($id)?$id:''; ?>" class="col-md-offset-6 btn green handle-submit"  value="提交"/>
           <input type="button" class="btn btn-default handle-cancel" value="取消"/>
        </div>
    </div>
</div>