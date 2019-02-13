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
            <span class="font-18"><?= isset($today_order_num)?$today_order_num:0;?></span>
        </p>
        <p class="txt-right"><span class="font-16">预约试听</span></p>
        <div class="clearfix detail_more">
            <a class="more fl" href="?r=goods/order/index"> 查看更多</a>
            <i class="m-icon-swapright m-icon-white fr"></i>
        </div>
    </div>
    <div class="col-md-3 white text-center"
         style="background:#E7505A;padding-bottom:12px;margin-left:10px;padding-top:30px;border-radius:8px!important">
        <p class="txt-right">
            <span class="font-18"><?= isset($today_payed_money)?$today_payed_money:0;?></span>
        </p>
        <p class="txt-right"><span class="font-16">申请加盟</span></p>
        <div class="clearfix detail_more">
                <a class="more fl" href="?r=goods/order/index"> 查看更多</a>
            <i class="m-icon-swapright m-icon-white fr"></i>
        </div>
    </div>

</div>
<div style="clear:both"></div>

<div style="width:50%;margin-left: 10px;" class="content_box">
    <div class="clearfix">
        <div class="fl">
            <img width="20px" src="<?//= \yii::$app->params['img_host'].'/images/backend/share.png'?>" />
            <span>分享</span>
        </div>
        <div class="fr">
            <div class="actions">
                <div class="btn-group">
                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> 快速查看
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">

                        <li>
                                <a href="?r=goods/order/index"> 全部订单 </a>
                        </li>
                        <li>
                            <a href="?r=usercenter/default/index">全部会员</a>
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
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">新会员</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">最新订单</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content clearfix">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>会员名称</th>
                        <th>支付单数</th>
                        <th>注册时间</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($user_list)):?>
                    <?php foreach($user_list as $k => $v):?>
                        <tr>
                            <td><?= $v['name']; ?></td>
                            <td><?= $v['payed_order_num']?></td>
                            <td><?= $v['regtime']?></td>
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
                        <th>订单号</th>
                        <th>创建时间</th>
                        <th>订单状态</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($user_list)):?>
                    <?php foreach($order_list as $k => $v):?>
                        <tr>
                            <td><?= $v['order_id']?></td>
                            <td><?= date('Y-m-d H:i:s',$v['create_time'])?></td>
                            <td>
                                <?php if($v['status'] == 'dead'){
                                    echo "已取消";
                                }else if($v['status'] == 'active' && $v['pay_status'] == '0'){
                                    echo "待支付";
                                }else if($v['status'] == 'active' && $v['pay_status'] != '0'){
                                    echo "已支付";
                                }else if($v['status'] == 'finish'){
                                    echo "已完成";
                                }?>
                            </td>
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

