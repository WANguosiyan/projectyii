<?php
use app\backend\widgets\LinkPager;
use app\backend\components\AppAdminAcl;
$this->title = '预约试听';
$this->params['breadcrumbs'] = [['label'=>'预约试听','url'=>'?r=appointment/default/index'],['label'=>'预约试听列表']];
?>
<h3 class="page-title"> 预约列表
    <small>
            <a href="?r=appointment/default/index" class="btn btn-sm default"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
    </small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered dataTables_wrapper">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <?php echo AppAdminAcl::filterButton('appointment/default/batch-del',
                                    '<a data-href="?r=appointment/default/batch-del" class="btn sbold btn-danger batch-del"> 批量删除</a>');
                                ?>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <?php echo $this->render('_search', $this->context->data);?>
                        </div>
                    </div>

                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />
                            </th>
                            <th width="250"> 操作 </th>
                            <th>ID</th>
                            <th> 宝宝姓名 </th>
                            <th> 性别 </th>
                            <th> 出生日期 </th>
                            <th> 联系方式 </th>
                            <th> 所属省 </th>
                            <th> 所属市 </th>
                            <th> 创建时间 </th>
                            <th> 更新时间 </th>
                            <th> 处理说明 </th>
                            <th> 状态 </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($dataProvider)):?>
                        <?php foreach ($dataProvider as $v):?>

                            <tr class="odd gradeX now-cat-<?php echo $v['id'];?>">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="<?php echo $v['id'];?>" />
                                </td>
                                <td>
                                    <?php echo AppAdminAcl::filterButton('appointment/default/handle', '<a data-href="?r=appointment/default/handle&id='.$v['id'].'" type="button" class="btn btn-sm btn-info handle">处理</a>');?>
                                    <?php echo AppAdminAcl::filterButton('appointment/default/delete', '<a data-href="?r=appointment/default/delete" data-id="'.$v['id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $v['id'];?>">
                                </td>
                                <td><?= $v['id'];?></td>
                                <td>
                                    <?php echo $v['name'];?>
                                </td>
                                <td>
                                    <?php echo $v['sex'] == 1?'男':'女';?>
                                </td>
                                <td>
                                    <?php echo $v['birth_date'];?>
                                </td>
                                <td>
                                    <?php echo $v['tel'];?>
                                </td>
                                <td>
                                    <?php echo $v['province'];?>
                                </td>
                                <td>
                                    <?php echo $v['city'];?>
                                </td>
                                <td>
                                    <?php echo isset($v['create_time'])?date("Y-m-d H:i:s",$v['create_time']):'';?>
                                </td>
                                <td>
                                    <?php echo isset($v['update_time'])?date("Y-m-d H:i:s",$v['update_time']):'';?>
                                </td>
                                <td>
                                    <?php echo $v['memo'];?>
                                </td>
                                <td>
                                    <?php if($v['status'] == 1){?>
                                        <span style="color: red;">未处理</span>
                                    <?php }else{?>
                                        <span style="color: darkseagreen;">已处理</span>
                                    <?php }?>
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
                bootbox.alert('没有选中的预约试听');
                return false;
            }

            bootbox.confirm("是否确定删除选中的预约试听！", function(result) {
                if (result == true) {
                    var csrf = $('.request-csrf').val();
                    $.post(
                        '?r=appointment/default/batch-del',
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