<?php
$this->title = '管理员';
$this->params['breadcrumbs'] = [['label'=>'管理员','url'=>'?r=administrators/default/index'],['label'=>'编辑']];
?>

    <h3 class="page-title"> </h3>
<?php echo $this->render('_form', $this->context->data);?>

