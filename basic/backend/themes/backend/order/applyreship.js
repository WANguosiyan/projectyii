//订单详情
$('.detail').click(function(){
    var obj_b = $(this);
    var apply_reship_id = obj_b.attr('data-id');
    var obj = $('.show-'+apply_reship_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=order/applyreship/detail',
                {'apply_reship_id':apply_reship_id, '_csrf':$('.request-csrf').val()},
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

//审核
$('.tab-content').on('click', '.reship-check', function(){
    var apply_reship_id = $(this).attr('data-id');
    var order_id = $('#order-id').val();

    bootbox.confirm("确定审核？", function(result) {
        if (result == true){
            $.post(
                '?r=order/applyreship/check',
                {'apply_reship_id':apply_reship_id, 'order_id':order_id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    alert(res.msg);
                    if (res.code == 200) {
                        location.reload();
                    }
                    return false;
                },'json'
            );
        }
    });
});

//确认
$('.tab-content').on('click', '.reship-confirm', function(){
    var apply_reship_id = $(this).attr('data-id');
    var order_id = $('#order-id').val();

    bootbox.confirm("确定确认？", function(result) {
        if (result == true){
            $.post(
                '?r=order/applyreship/confirm',
                {'apply_reship_id':apply_reship_id, 'order_id':order_id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    alert(res.msg);
                    if (res.code == 200) {
                        location.reload();
                    }
                    return false;
                },'json'
            );
        }
    });
});

//完成
$('.tab-content').on('click', '.reship-finish', function(){
    var apply_reship_id = $(this).attr('data-id');
    var order_id = $('#order-id').val();

    bootbox.confirm("确定完成？", function(result) {
        if (result == true){
            $.post(
                '?r=order/applyreship/finish',
                {'apply_reship_id':apply_reship_id, 'order_id':order_id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    alert(res.msg);
                    if (res.code == 200) {
                        location.reload();
                    }
                    return false;
                },'json'
            );
        }
    });
});

//拒绝
$('.tab-content').on('click', '.reship-refuse', function(){
    var apply_reship_id = $(this).attr('data-id');
    var order_id = $('#order-id').val();

    bootbox.confirm("确定拒绝？", function(result) {
        if (result == true){
            $.post(
                '?r=order/applyreship/refuse',
                {'apply_reship_id':apply_reship_id, 'order_id':order_id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    alert(res.msg);
                    if (res.code == 200) {
                        location.reload();
                    }
                    return false;
                },'json'
            );
        }
    });
});