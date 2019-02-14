<?php
$this->title = '精彩回顾';
$this->params['breadcrumbs'] = [['label'=>'精彩回顾','url'=>'?r=review/default/index'],['label'=>'编辑']];
?>

    <h3 class="page-title"> </h3>
<?php echo $this->render('_form', $this->context->data);?>

