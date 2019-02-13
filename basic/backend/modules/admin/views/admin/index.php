<?php
$this->title = '初始页';
$this->params['breadcrumbs'] = [['label'=>'站点','url'=>'index'],['label'=>'业务概览']];
?>
<h3 class="page-title"> 初始页
    <small>总控 & 统计</small>
</h3>

<?php echo $this->render('view',$this->context->data);?>
<div class="row">

</div>