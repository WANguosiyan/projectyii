<?php
use app\backend\widgets\LinkPager;
use app\backend\components\AppAdminAcl;
use app\backend\modules\txt\models\TwNewsList;
$this->title = '课程体系';
$this->params['breadcrumbs'] = [['label'=>'课程体系管理','url'=>'?r=curriculum/default/index'],['label'=>'列表']];
?>
<h3 class="page-title">课程体系列表
    <small>
            <a href="?r=curriculum/default/index" class="btn btn-sm default"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
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
                                    <?php echo AppAdminAcl::filterButton('banner/default/create',
                                        '<a href="?r=banner/default/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
                                    ?>
                            </div>
                            <div class="btn-group">
                                <?php echo AppAdminAcl::filterButton('banner/default/batch-del',
                                    '<a data-href="?r=banner/default/batch-del" class="btn sbold btn-danger batch-del"> 批量删除</a>');
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
                            <th> 名称 </th>
                            <th> 图片 </th>
                            <th> 创建时间 </th>
                            <th> 更新时间 </th>
                            <th> 链接 </th>
                            <th> 排序 </th>
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
                                    <?php echo AppAdminAcl::filterButton('banner/default/update', '<a href="?r=banner/default/update&id='.$v['id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <?php echo AppAdminAcl::filterButton('banner/default/delete', '<a data-href="?r=banner/default/delete" data-id="'.$v['id'].'" type="button" class="btn btn-sm btn-danger delete-banner">删除</a>');?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $v['id'];?>">
                                </td>
                                <td><?= $v['id'];?></td>
                                <td>
                                    <?php echo $v['name'];?>
                                </td>
                                <td>
                                    <?php if($v['img_url']){?>
                                        <img style="width: 60px;height: 50px;" src="<?php echo $v['img_url'];?>">
                                    <?php }?>


                                </td>
                                <td>
                                    <?php echo isset($v['create_time'])?date("Y-m-d H:i:s",$v['create_time']):'';?>
                                </td>
                                <td>
                                    <?php echo isset($v['update_time'])?date("Y-m-d H:i:s",$v['update_time']):'';?>
                                </td>
                                <td>
                                    <?php echo $v['link_url'];?>
                                </td>
                                <td>
                                    <?php echo $v['sort'];?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
<!--                --><?php
//                echo \app\backend\widgets\LinkPager::widget([
//                    'pagination' => $pages,
//                ]);
//                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function(){
        //删除功能
        $('.delete-banner').click(function(){
            var data_href = $(this).attr('data-href');
            var id = $(this).attr('data-id');
            console.log(data_href);
            console.log(id);
            bootbox.confirm("是否确定删除", function(result) {
                    if(result == true){
                        $.get(data_href, {'id': id}, function (res) {
                                App.unblockUI('.page-container');
                                if (res.code == 500) {
                                    bootbox.alert(res.msg);
                                } else location.reload();
                            }, 'json');
                    }

                })
            });
        //批量删除能
        $('.batch-del').on('click', function(){
            var banners_id = '';
            $('.checkboxes:checked').each(function(){
                banners_id += $(this).val()+',';
            });

            if (banners_id == '') {
                bootbox.alert('没有选中的轮播图');
                return false;
            }

            bootbox.confirm("是否确定删除选中的轮播图！", function(result) {
                if (result == true) {
                    var csrf = $('.request-csrf').val();
                    $.post(
                        '?r=banner/bannermanage/batch-del',
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