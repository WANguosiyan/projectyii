<?php
$this->title = '轮播图管理';
$this->params['breadcrumbs'] = [['label'=>'轮播模块','url'=>'?r=banner/bannermanage/index'],['label'=>'轮播图管理', 'url'=>'?r=banner/bannermanage/index'],['label'=>'编辑']];
?>

    <h3 class="page-title"> </h3>
<?php echo $this->render('_form', $this->context->data);?>

