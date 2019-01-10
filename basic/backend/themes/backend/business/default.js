//验证

validate(
    {
        'Business[name]':{'required':true},
        'business[business_type]':{'required':true},
        'business[logo]':{'required':true},
        'business[tel]':{'required':true},
        'Addres[address]':{'required':true},
        'Addres[location_x]':{'required':true},
        'Addres[location_y]':{'required':true},
        'Addres[province_id]':{'required':true},
        'Addres[area_id]':{'required':true},
    },
    {
        'Business[name]':{'required':'名称不能为空'},
        'business[business_type]':{'required':'请选择商铺类型'},
        'business[logo]':{'required':'请上传商铺logo'},
        'business[tel]':{'required':'电话不能为空'},
        'Addres[address]':{'required':'地址不能为空'},
        'Addres[location_x]':{'required':'经度不能为空'},
        'Addres[location_y]':{'required':'纬度不能为空'},
        'Addres[province_id]':{'required':'省份不能为空'},
        'Addres[area_id]':{'required':'地区不能为空'},
    }
);

// scoll();

//详细编辑
if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400,
    });
}
//营业时间
if ($('#validation-form').html()) {
    dateBusinessTimePicker($('.create_time_start'));
    dateBusinessTimePicker($('.create_time_end'));
}

$('.order-info').click(function(){
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/default/detail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    console.log(res);
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('订单信息');
    }
});
//查看申请详情
$('.apply-info').click(function(){
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/business-apply/detail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    console.log(res);
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('订单信息');
    }
});
var handle_layer;
//店铺申请处理
$('.handle').click(function(){
    var url = $(this).attr('data-href');
    $.get(url,function(res){
        handle_layer = layer.open({
            title:'处理说明',
            type:1,
            content:res,
            area:['500px','auto']
        })
    })
});
$('body').on('click','.handle-submit',function(){
   var memo = $('.handle_comment').val();
   var id = $(this).attr('data-id');
   if(memo != ''){
       $.post('?r=businesscenter/business-apply/handle',{id:id,memo:memo,_csrf:$('#_csrf').val()},function(res){
           layer.msg(res.msg,{time:1000});
           if(res.code == 200){
               layer.close(handle_layer);
               setTimeout(function(){
                   location.reload();
               },1000)
           }
       },'json');
   }
});
$('body').on('click','.handle-cancel',function(){
   layer.close(handle_layer);
});
$('.other-info').click(function(){
    console.log(11);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show1-'+id);
    var open = obj.parent().attr('data-open-oth');
    var show = obj.attr('data-show-oth');
    console.log(open);
    console.log(show);
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet1',
                animate: true
            });

            $.post(
                '?r=businesscenter/default/otherset',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show-oth', 'true');
                    obj.parent().show().attr('data-open-oth', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open-oth', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open-oth', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.order-info-decorate').click(function(){
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/decorate/detail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    console.log(res);
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('订单信息');
    }
});
$('.other-info-decorate').click(function(){
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show1-'+id);
    var open = obj.parent().attr('data-open-oth');
    var show = obj.attr('data-show-oth');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet1',
                animate: true
            });

            $.post(
                '?r=businesscenter/decorate/otherset',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show-oth', 'true');
                    obj.parent().show().attr('data-open-oth', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open-oth', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open-oth', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.order-info-house').click(function(){
    console.log(11);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/house/detail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.other-info-house').click(function(){
   console.log(11);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/house/otherset',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.order-info-design').click(function(){
    console.log(11);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/design/detail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.other-info-design').click(function(){
    console.log(11);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/design/otherset',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭其他设置');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('其他设置');
    }
});
$('.postal-info').click(function(){
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=businesscenter/default/postaldetail',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('查看详情');
    }
});
