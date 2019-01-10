

//投票详情
$('.vote-detail').click(function(){
    var obj_b = $(this);
    var member_id = obj_b.attr('data-id');
    var obj = $('.show-'+member_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=other/short-vote/vote_detail',
                {'member_id':member_id, '_csrf':$('.request-csrf').val()},
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
//投票详情
$('.long-vote-detail').click(function(){
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
                '?r=vote/long-vote/long-vote-detail',
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
        obj_b.removeClass('btn-danger').addClass('btn-success').text('投票详情');
    }
});
//投票详情
$('.short-vote-detail').click(function(){
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
                '?r=vote/short-vote/short-vote-detail',
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
//投票详情
$('.hero-vote-detail').click(function(){
    var obj_b = $(this);
    var member_id = obj_b.attr('data-id');
    var obj = $('.show-'+member_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=other/ranking/hero-vote-detail',
                {'member_id':member_id, '_csrf':$('.request-csrf').val()},
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