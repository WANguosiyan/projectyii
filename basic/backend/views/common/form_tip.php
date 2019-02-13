<div class="alert alert-danger validation-danger display-hide">
    <button class="close" data-close="alert"></button> 你有一些表单错误，请检查表单！
</div>
<div class="alert alert-success validation-success display-hide">
    <button class="close" data-close="alert"></button> 表单验证成功！
</div>

<?php if ($this->context->data['submit'] == 200):?>
    <div class="alert alert-block alert-success fade in form-success">
        <button type="button" class="close" data-dismiss="alert"></button>
        <h4 class="alert-heading">成功!</h4>
        <p> 表单提交成功,继续添加/编辑 </p>
        <p>
            <?php
            $str = '';
            if(isset($product_id)){
                $str .= "&product_id=".$product_id;
            }else{
                $str .= "";
            }
            if(isset($db_id)){
                $str .= "&db_id=".$db_id;
            }else{
                $str .= "";
            }
            if(isset($module_id)){
                $str .= "&module_id=".$module_id;
            }else{
                $str .= "";
            }
            ?>
            <?php if (isset($url) && $url):?>
                <a class="btn green"
                   href="<?php echo $url;?><?php echo $str;?>"
                > 返回列表 </a>
            <?php else:?>
                <a class="btn green"
                   href="?r=<?php echo $this->context->data['module_id'];?>/<?php echo $this->context->data['controller_id'];?>/<?php echo $this->context->data['action_list'];?><?php echo $str; ?>"
                > 返回列表 </a>
            <?php endif;?>
        </p>
    </div>
<?php endif;?>

<?php if ($this->context->data['submit'] == 500):?>

<div class="alert alert-block alert-danger fade in form-error">
    <button type="button" class="close" data-dismiss="alert"></button>
    <h4 class="alert-heading">失败!</h4>
    <p> 表单提交失败,请检查后重新提交</p>
    <p> <?php echo $this->context->data['err'];?></p>
    <p>
        <?php if (isset($url) && $url):?>
            <a class="btn red"
               href="<?php echo $url;?>"
            > 返回列表  </a>
        <?php else:?>
        <a class="btn red"
           href="?r=<?php echo $this->context->data['module_id'];?>/<?php echo $this->context->data['controller_id'];?>/<?php echo $this->context->data['action_list'];?>"
        > 返回列表  </a>
        <?php endif;?>
    </p>
</div>
<?php endif;?>

