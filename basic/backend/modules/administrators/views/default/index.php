<?php
use app\backend\widgets\LinkPager;
use app\backend\components\AppAdminAcl;
$this->title = '管理员';
$this->params['breadcrumbs'] = [['label'=>'管理员','url'=>'?r=administrators/default/index'],['label'=>'列表']];
?>
<h3 class="page-title"> 管理员列表
    <small>
            <a href="?r=administrators/default/index" class="btn btn-sm default"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
    </small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered dataTables_wrapper">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
<!--                            <div class="btn-group">-->
<!--                                    --><?php //echo AppAdminAcl::filterButton('teacherteam/default/create',
//                                        '<a href="?r=teacherteam/default/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
//                                    ?>
<!--                            </div>-->
<!--                            <div class="btn-group">-->
<!--                                --><?php //echo AppAdminAcl::filterButton('teacherteam/default/batch-del',
//                                    '<a data-href="?r=teacherteam/default/batch-del" class="btn sbold btn-danger batch-del"> 批量删除</a>');
//                                ?>
<!--                            </div>-->

                        </div>
                        <div class="col-md-6">
<!--                            --><?php //echo $this->render('_search', $this->context->data);?>
                        </div>
                    </div>

                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                        <tr>
<!--                            <th>-->
<!--                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />-->
<!--                            </th>-->
                            <th width="250"> 操作 </th>
                            <th>ID</th>
                            <th> 名称 </th>
                            <th> 最近登录时间 </th>
                            <th> 登录次数 </th>
                            <th> 登录ip </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($dataProvider)):?>
                        <?php foreach ($dataProvider as $v):?>

                            <tr class="odd gradeX now-cat-<?php echo $v['user_id'];?>">
<!--                                <td>-->
<!--                                    <input type="checkbox" class="checkboxes" value="--><?php //echo $v['user_id'];?><!--" />-->
<!--                                </td>-->
                                <td>
                                    <?php echo AppAdminAcl::filterButton('administrators/default/update', '<a href="?r=administrators/default/update&id='.$v['user_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $v['user_id'];?>">
                                </td>
                                <td><?= $v['user_id'];?></td>
                                <td>
                                    <?php echo $v['name'];?>
                                </td>
                                <td>
                                    <?php echo isset($v['update_time'])?date("Y-m-d H:i:s",$v['update_time']):'';?>
                                </td>
                                <td>
                                    <?php echo $v['login_count'];?>
                                </td>
                                <td>
                                    <?php echo $v['login_ip'];?>
                                </td>

                            </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <?php
                echo \app\backend\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function(){
        //批量删除能
        $('.batch-del').on('click', function(){
            var banners_id = '';
            $('.checkboxes:checked').each(function(){
                banners_id += $(this).val()+',';
            });

            if (banners_id == '') {
                bootbox.alert('没有选中的师资团队');
                return false;
            }

            bootbox.confirm("是否确定删除选中的师资团队！", function(result) {
                if (result == true) {
                    var csrf = $('.request-csrf').val();
                    $.post(
                        '?r=teacherteam/default/batch-del',
                        {'banners_id':banners_id, '_csrf': csrf},
                        function (res) {
                            if (res == 500) bootbox.alert(res.msg);
                            location.reload();
                        }, 'json'
                    );
                    return false;
                }
            });
            return false;
        });

    }
</script>