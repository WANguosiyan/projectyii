$('.pos-detail').click(function(){
    var obj_b = $(this);
    var id = obj_b.attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
        console.log(id);
    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=other/posdefault/detail',
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
//投票时间
if ($('#validation-form').html()) {
    dateTimePicker($('.create_time_start'));
    dateTimePicker($('.create_time_end'));
}
//解冻提示
$(table).on('click','.pos-active',function(){
    var obj = $(this);
    bootbox.confirm("是否确定解冻该POS机", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            var id = obj.attr('data-id');
            App.blockUI({
                target: '.page-container',
                animate: true
            });
            bootbox.hideAll();
            $.post(
                data_href,
                {'_csrf': csrf,'id':id},
                function (res) {
                    App.unblockUI('.page-container');
                    if (res.code == 500) {
                        bootbox.alert(res.msg);
                    } else location.reload();
                }, 'json'
            );
        }
    });
});
//删除提示
$(table).on('click','.pos-delete',function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除该POS机", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            var id = obj.attr('data-id');
            App.blockUI({
                target: '.page-container',
                animate: true
            });
            bootbox.hideAll();
            $.post(
                data_href,
                {'_csrf': csrf,'id':id},
                function (res) {
                    App.unblockUI('.page-container');
                    if (res.code == 500) {
                        bootbox.alert(res.msg);
                    } else location.reload();
                }, 'json'
            );
        }
    });
});