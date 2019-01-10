//订单详情
$('.order-detail').click(function(){
    var obj_b = $(this);
    var order_id = obj_b.attr('data-id');
    var obj = $('.show-'+order_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=cloud_shop/order-default/detail',
                {'order_id':order_id, '_csrf':$('.request-csrf').val()},
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
//订单详情
$('.owe-order-detail').click(function(){
    var obj_b = $(this);
    var order_id = obj_b.attr('data-id');
    var obj = $('.show-'+order_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=goods/order/detail',
                {'order_id':order_id, '_csrf':$('.request-csrf').val()},
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
//订单支付
$('.tab-content').on('click','.order-pay',function(){
    var obj = $(this);
    var order_id = obj.attr('data-id');
    App.blockUI({
        target: '#portlet',
        animate: true
    });
    $.post(
        '?r=cloud_shop/order/pay',
        {'order_id':order_id, '_csrf':$('.request-csrf').val(), 'type':0},
        function (res) {
            App.unblockUI('#portlet');
            bootbox.dialog({
                message: res,
                title: "订单支付",
                buttons: {
                    success: {
                        label: "提交",
                        className: "green",
                        callback: function() {
                            //支付提交验证
                            var validate_res = payValidate();
                            if (validate_res) {
                                paySave(order_id);
                                return false;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            });
        }
    );
});

//支付验证
function payValidate()
{
    if ($('#payed_amount').val() == '') {
        alert("付款金额不能为空!");
        return false;
    }

    if ($('#pay_bank').val() == '') {
        alert("支付银行不能为空!");
        return false;
    }
    return true;
}

//订单支付操作
function paySave(order_id)
{
    $.post(
        '?r=cloud_shop/order/pay',
        {
            'order_id':order_id,
            'payment_id':$('#payment_id').val(),
            'payed_amount':$('#payed_amount').val(),
            'total_amount':$('#payed_amount').attr('data-amount'),
            'pay_type':$('#pay_type').val(),
            'pay_bank':$('#pay_bank').val(),
            'pay_account':$('#pay_account').val(),
            'pay_no':$('#pay_no').val(),
            'memo':$('#memo').val(),
            '_csrf':$('.request-csrf').val(),
            'type':1
        },
        function (res) {
            alert(res.msg);
            if (res.code == 200) {
                location.reload();
            } else {
                return false;
            }
        },'json'
    );
}

//订单退款
$('.tab-content').on('click','.order-refund',function(){
    var obj = $(this);
    var order_id = obj.attr('data-id');
    App.blockUI({
        target: '#portlet',
        animate: true
    });
    $.post(
        '?r=cloud_shop/order/refund',
        {'order_id':order_id, '_csrf':$('.request-csrf').val(), 'type':0},
        function (res) {
            App.unblockUI('#portlet');
            if (res.code == 400) {
                bootbox.alert(res.msg);
                return false;
            } else {
                bootbox.dialog({
                    message: res.data.partial,
                    title: "订单退款",
                    buttons: {
                        success: {
                            label: "提交",
                            className: "green",
                            callback: function() {
                                //支付提交验证
                                var validate_res = payValidate();
                                if (validate_res) {
                                    refundSave(order_id);
                                    return false;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                });
            }
        }
    );
});

//退款验证
function payValidate()
{
    if ($('#payed_amount').val() == '') {
        alert("退款金额不能为空!");
        return false;
    }

    if ($('#pay_bank').val() == '') {
        alert("收款银行不能为空!");
        return false;
    }
    return true;
}

//订单退款操作
function refundSave(order_id)
{
    $.post(
        '?r=cloud_shop/order/refund',
        {
            'order_id':order_id,
            'payment_id':$('#payment_id').val(),
            'payed_amount':$('#payed_amount').val(),
            'total_amount':$('#payed_amount').attr('data-amount'),
            'pay_type':$('#pay_type').val(),
            'pay_bank':$('#pay_bank').val(),
            'pay_account':$('#pay_account').val(),
            'pay_no':$('#pay_no').val(),
            'memo':$('#memo').val(),
            '_csrf':$('.request-csrf').val(),
            'type':1
        },
        function (res) {
            if (res.code == 200) {
                alert(res.msg);
                location.reload();
            } else {
                return false;
            }
        },'json'
    );
}

//订单发货
$('.tab-content').on('click','.order-delivery',function(){
    var obj = $(this);
    var order_id = obj.attr('data-id');
    App.blockUI({
        target: '#portlet',
        animate: true
    });
    // alert(11);return false;
    $.post(
        '?r=cloud_shop/order/delivery',
        {'order_id':order_id, '_csrf':$('.request-csrf').val(), 'type':0},
        function (res) {
            App.unblockUI('#portlet');
            bootbox.dialog({
                message: res,
                title: "订单发货",
                buttons: {
                    success: {
                        label: "提交",
                        className: "green",
                        callback: function() {
                            //支付提交验证
                            var validate_res = deliveryValidate();
                            if (validate_res) {
                                deliverySave(order_id);
                                return false;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            });
        }
    );
});
//发货验证
function deliveryValidate()
{
    if ($('#logi_no').val() == '') {
        alert('物流单号不能为空');
        return false;
    }

    if ($('#ship_name').val() == '') {
        alert('收货人姓名不能为空');
        return false;
    }

    if ($('#ship_area').val() == '') {
        alert('收货地区不能为空');
        return false;
    }

    if ($('#ship_mobile').val() == '') {
        alert('手机不能为空');
        return false;
    }

    if ($('#ship_address').val() == '') {
        alert('地址不能为空');
        return false;
    }

    // if ($('#ship_inject_bn').val() == '') {
    //     alert('注射器编码不能为空');
    //     return false;
    // }

    // if ($('#ship_card').val() == '') {
    //     alert('防伪保修码不能为空');
    //     return false;
    // }
    return true;
}

//发货操作
function deliverySave(order_id)
{
    $.post(
        '?r=cloud_shop/order/delivery',
        {
            'order_id':order_id,
            // 'dt_id':$('#dt_id').val(),
            'logi_id':$('#logi_id').val(),
            'logi_no':$('#logi_no').val(),
            'ship_name':$('#ship_name').val(),
            // 'ship_tel':$('#ship_tel').val(),
            'ship_mobile':$('#ship_mobile').val(),
            // 'ship_zip':$('#ship_zip').val(),
            'area':$('#ship_area').val(),
            'ship_address':$('#ship_address').val(),
            // 'ship_inject_bn':$('#ship_inject_bn').val(),
            // 'ship_card':$('#ship_card').val(),
            'memo':$('#memo').val(),
            '_csrf':$('.request-csrf').val(),
            'type':1
        },
        function (res) {
            if (res.code == 200) {
                alert(res.msg);
                location.reload();
            } else {
                return false;
            }
        },'json'
    );
}

//订单退货
$('.tab-content').on('click','.order-reship',function(){
    var obj = $(this);
    var order_id = obj.attr('data-id');
    App.blockUI({
        target: '#portlet',
        animate: true
    });
    $.post(
        '?r=cloud_shop/order/reship',
        {'order_id':order_id, '_csrf':$('.request-csrf').val(), 'type':0},
        function (res) {
            App.unblockUI('#portlet');
            if (res.code == 400) {
                bootbox.alert(res.msg);
            } else {
                bootbox.dialog({
                    message: res.data.partial,
                    title: "订单退货",
                    buttons: {
                        success: {
                            label: "提交",
                            className: "green",
                            callback: function() {
                                //支付提交验证
                                var validate_res = reshipValidate();
                                if (validate_res) {
                                    reshipSave(order_id);
                                    return false;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                });
            }
        }
    );
});

//退货验证
function reshipValidate()
{
    if ($('#logi_no').val() == '') {
        alert('物流单号不能为空');
        return false;
    }

    if ($('#ship_name').val() == '') {
        alert('退货人姓名不能为空');
        return false;
    }

    if ($('#area_id').val() == '' || $('#area_id').val() < 1) {
        alert('地区不能为空');
        return false;
    }

    if ($('#ship_mobile').val() == '') {
        alert('手机不能为空');
        return false;
    }

    if ($('#ship_address').val() == '') {
        alert('地址不能为空');
        return false;
    }
    return true;
}

//退货操作
function reshipSave(order_id)
{
    $.post(
        '?r=cloud_shop/order/reship',
        {
            'order_id':order_id,
            'apply_reship_id':$('#apply_reship_id').val(),
            'dt_id':$('#dt_id').val(),
            'logi_id':$('#logi_id').val(),
            'logi_no':$('#logi_no').val(),
            'ship_name':$('#ship_name').val(),
            'ship_tel':$('#ship_tel').val(),
            'ship_mobile':$('#ship_mobile').val(),
            'ship_zip':$('#ship_zip').val(),
            'area_id':$('#area_id').val(),
            'ship_address':$('#ship_address').val(),
            'ship_cost':$('#ship_cost').val(),
            'memo':$('#memo').val(),
            '_csrf':$('.request-csrf').val(),
            'type':1
        },
        function (res) {
            if (res.code == 200) {
                alert(res.msg);
                location.reload();
            } else {
                return false;
            }
        },'json'
    );
}

//订单作废
$('.tab-content').on('click','.cancel-order',function(){

    var obj = $(this);
    var order_id = obj.attr('data-id');
    bootbox.confirm("确定取消该订单？", function(result) {
        if (result == true){
            $.post(
                '?r=cloud_shop/order/cancel',
                {'order_id':order_id, '_csrf':$('.request-csrf').val()},
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

//订单完成
$('.tab-content').on('click','.order-finish',function(){
    var obj = $(this);
    var order_id = obj.attr('data-id');
    bootbox.confirm("确定完成？", function(result) {
        if (result == true){
            $.post(
                '?r=cloud_shop/order/finish',
                {'order_id':order_id, '_csrf':$('.request-csrf').val()},
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

//订单时间
dateTimePicker($('.create_time_start'));
dateTimePicker($('.create_time_end'));
//导出订单信息功能
$('#orderinfo-export').on('click', function(){
    var obj = $(this);
    var orders_id = '';
    $('.checkboxes:checked').each(function(){
        orders_id += $(this).val()+',';
    });
    var url = obj.attr('data-href');
    console.log(url);
    if (orders_id == '') {
        bootbox.confirm("是否确定导出全部订单信息！", function(result) {
            if (result == true) {
                window.location.href = url+'&orders_id='+orders_id;
                // document.getElementById("#userinfo-export").click();
            }
        });
    }else{
        bootbox.confirm("是否确定导出选中的订单信息！", function(result) {
            if (result == true) {
                window.location.href = url+'&orders_id='+orders_id;
            }
        });
    }


    return false;
});