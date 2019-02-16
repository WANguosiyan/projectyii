<?php
$this->title = '初始页';
$this->params['breadcrumbs'] = [['label' => '站点', 'url' => 'index.php'], ['label' => '业务概览']];
?>
<style>
    .white {
        color: white;
    }

    .font-16 {
        font-size: 16px;
    }

    .font-18 {
        font-size: 30px;
    }

    .white p {
        margin: 0px;
    }

    .grey {
        color: #ccc;
        font-size: 20px;
        margin-left: 10px;
        margin-bottom: 10px;
    }
    .txt-right {
        text-align:right!important;
    }
    .fl{
        float:left
    }
    .fr{
        float:right;
    }
    .detail_more{
        margin-top:5px;
    }
    .col-md-3{
        width:22%;
    }
    .content_box{
        padding: 10px;
        width: 50%;
        border: 1px solid #ccc;
        margin-top:20px;
    }
    .content_box>div:first-of-type{
        border-bottom: 1px solid #ccc;
        height: 50px;
        line-height: 50px;
        margin-bottom: 13px;
    }
    .more{
        color:white;
    }
</style>

<!--用户统计开始-->
<div class="row col-md-11">
    <div class="col-md-3 white text-center"
         style="background:#3598DC;padding-bottom:12px;margin-left:10px;padding-top:30px;border-radius:8px!important">
        <p class="txt-right">
            <span class="font-18"><?= isset($today_appointment_num)?$today_appointment_num:0;?></span>
        </p>
        <p class="txt-right"><span class="font-16">今日预约试听数</span></p>
        <div class="clearfix detail_more">
            <a class="more fl" href="?r=appointment/default/index"> 查看更多</a>
            <i class="m-icon-swapright m-icon-white fr"></i>
        </div>
    </div>
    <div class="col-md-3 white text-center"
         style="background:#E7505A;padding-bottom:12px;margin-left:10px;padding-top:30px;border-radius:8px!important">
        <p class="txt-right">
            <span class="font-18"><?= isset($today_joinin_num)?$today_joinin_num:0;?></span>
        </p>
        <p class="txt-right"><span class="font-16">今日申请加盟数</span></p>
        <div class="clearfix detail_more">
                <a class="more fl" href="?r=joinin/default/index"> 查看更多</a>
            <i class="m-icon-swapright m-icon-white fr"></i>
        </div>
    </div>

</div>
<div style="clear:both"></div>

<div style="width:50%;margin-left: 10px;" class="content_box">
    <div class="clearfix">
        <div class="fl">

        </div>
        <div class="fr">
            <div class="actions">
                <div class="btn-group">
                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> 快速查看
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">

                        <li>
                                <a href="?r=appointment/default/index"> 全部预约试听 </a>
                        </li>
                        <li>
                            <a href="?r=joinin/default/index">全部申请加盟</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--            <button class="btn btn-primary">快速查看</button>-->
        </div>
    </div>

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs"  role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">预约试听</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">申请加盟</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content clearfix">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>宝宝姓名</th>
                        <th>联系方式</th>
                        <th>预约时间</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($appointment_list)):?>
                    <?php foreach($appointment_list as $k => $v):?>
                        <tr>
                            <td><?= $v['name']; ?></td>
                            <td><?= $v['tel']?></td>
                            <td><?= $v['create_time']?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>姓名</th>
                        <th>联系方式</th>
                        <th>申请时间</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($joinin_list)):?>
                    <?php foreach($joinin_list as $k => $v):?>
                        <tr>
                            <td><?= $v['name']?></td>
                            <td><?= $v['tel']?></td>
                            <td><?= $v['create_time']?></td>

                        </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">

    // var job_data = '<?php //echo json_encode($job_num);?>';
    // var num1 = '<?php //echo $new_job_num;?>';
    // var total_job_data = '<?php //echo json_encode($total_job_num);?>';
    // var num2 = '<?php //echo $total_num;?>';
</script>

