//表单验证
validate(
    {
        'Coupon[title]':{'required': true},
        'Coupon[code]':{'required': true},
        'Coupon[continue_time]':{'required': true},
        'Coupon[start_time]':{'required': true},
        'Coupon[end_time]':{'required': true},
        'Coupon[send_type]':{'required': true, min:1},
        'Coupon[rule_id]':{'required': true, min:1}
    },
    {
        'Coupon[title]':{'required': '优惠券名称不能为空'},
        'Coupon[code]':{'required': '券码不能为空'},
        'Coupon[continue_time]':{'required': '使用周期不能为空'},
        'Coupon[start_time]':{'required': '开始时间不能为空'},
        'Coupon[end_time]':{'required': '结束时间不能为空'},
        'Coupon[send_type]':{'required': '发放类型不能为空', min:'发放类型不能为空'},
        'Coupon[rule_id]':{'required': '优惠类型不能为空', min:'促销规格不能为空'}
    }
);

//现金券开始时间
if ($('#validation-form').html()) {
    dateTimePicker($('.create_time_start'));
    dateTimePicker($('.create_time_end'));
}

//优惠券发放
$('.coupon-send2').on('click', function(){
    var coupon_id = $('.coupon-id').val();
    var coupon_send = $('.coupon-send').val();
    App.blockUI({
        target: 'body',
        animate: true
    });
    $.post(
        '?r=cloud_shop/coupon/sendsave',
        {'coupon_id':coupon_id, 'send_num':coupon_send,'_csrf': $('.request-csrf').val()},
        function (res) {
            App.unblockUI('body');
            alert(res.msg);
            if (res.code == 200) {
                location.reload();
            } else {
                return false;
            }
        },'json '
    );
});

$('.coupon-send3').on('click', function(){
    var coupon_id = $('.coupon-id').val();
    var coupon_send = $('.coupon-send').val();
    App.blockUI({
        target: 'body',
        animate: true
    });
    $.post(
        '?r=cloud_shop/promotioncoupon/sendsave',
        {'coupon_id':coupon_id, 'send_num':coupon_send,'_csrf': $('.request-csrf').val()},
        function (res) {
            App.unblockUI('body');
            alert(res.msg);
            if (res.code == 200) {
                location.reload();
            } else {
                return false;
            }
        },'json '
    );
});
$('.coupon-send4').on('click', function(){
    var coupon_id = $('.coupon-id').val();
    var coupon_send = $('.coupon-send').val();
    App.blockUI({
        target: 'body',
        animate: true
    });
    $.post(
        '?r=promotioncoupon/default/sendsave',
        {'coupon_id':coupon_id, 'send_num':coupon_send,'_csrf': $('.request-csrf').val()},
        function (res) {
            App.unblockUI('body');
            alert(res.msg);
            if (res.code == 200) {
                location.reload();
            } else {
                return false;
            }
        },'json '
    );
});