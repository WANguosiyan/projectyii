<?php
$this->title = '课程体系';
$this->params['breadcrumbs'] = [['label'=>'课程体系管理','url'=>'?r=curriculum/default/index'],['label'=>'编辑']];
?>

    <h3 class="page-title"> </h3>
<?php echo $this->render('_form', $this->context->data);?>

