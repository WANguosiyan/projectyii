validate(
    {
        'Member[name]':{'required': true},
        'Member[mobile]':{'required': true}
    },
    {
        'Member[name]':{'required': '用户名不能为空'},
        'Member[mobile]':{'required': '手机不能为空'}
    }
);

//会员详情
$('.member-detail').click(function(){
    var obj_b = $(this);
    var member_id = obj_b.attr('data-id');
    var obj = $('.show-'+member_id);
    var open = obj.parent().attr('data-open');
    var act = obj_b.attr('data-act');
    console.log(act);

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });
            if(act == 'lifehelper'){
                $.post(
                    '?r=usercenter/default/detail',
                    {'member_id':member_id,'act':act, '_csrf':$('.request-csrf').val()},
                    function (res) {
                        App.unblockUI('#portlet');
                        obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                        obj.html(res).attr('data-show', 'true');
                        obj.parent().show().attr('data-open', 'true');
                    }
                );
            }else{
                $.post(
                    '?r=usercenter/default/detail',
                    {'member_id':member_id, '_csrf':$('.request-csrf').val()},
                    function (res) {
                        App.unblockUI('#portlet');
                        obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                        obj.html(res).attr('data-show', 'true');
                        obj.parent().show().attr('data-open', 'true');
                    }
                );
            }

        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('查看详情');
    }
});
//订单时间
if ($('#validation-form').html()) {
    dateTimePicker($('.create_time_start'));
    dateTimePicker($('.create_time_end'));
}
//导出用户信息功能
$('#userinfo-export').on('click', function(){
    var obj = $(this);
    var members_id = '';
    $('.checkboxes:checked').each(function(){
        members_id += $(this).val()+',';
    });
    var url = obj.attr('data-href');
    console.log(url);
    if (members_id == '') {
        bootbox.confirm("是否确定导出全部用户信息！", function(result) {
            if (result == true) {
                window.location.href = url+'&members_id='+members_id;
                // document.getElementById("#userinfo-export").click();
            }
        });
    }else{
        bootbox.confirm("是否确定导出选中的用户信息！", function(result) {
            if (result == true) {
                window.location.href = url+'&members_id='+members_id;
            }
        });
    }


    return false;
});