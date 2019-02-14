<?php
$this->title = '师资团队';
$this->params['breadcrumbs'] = [['label'=>'师资团队','url'=>'?r=teacherteam/default/index'],['label'=>'编辑']];
?>

    <h3 class="page-title"> </h3>
<?php echo $this->render('_form', $this->context->data);?>

