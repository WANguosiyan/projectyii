//用户反馈详情
$('.feedback-detail').click(function(){
    var obj_b = $(this);
    var feed_id = obj_b.attr('data-id');
    var obj = $('.show-'+feed_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=member/feedback/detail',
                {'id':feed_id, '_csrf':$('.request-csrf').val()},
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

//回复
$('body').on('click', '#replay-sub', function(){
    var detail = $('#replay-detail').val();
    var feed_id = $(this).attr('data-feed-id');
    if (detail == '') {
        bootbox.alert('回复内容不能为空');
        return false;
    }

    var csrf = $('.request-csrf').val();
    App.blockUI({
        target: '.page-container',
        animate: true
    });
    bootbox.hideAll();
    $.post(
        '?r=member/feedback/replay',
        {'feed_id':feed_id, 'replay_content':detail, '_csrf': csrf},
        function (res) {
            App.unblockUI('.page-container');
            if (res.code == 400) {
                bootbox.alert(res.msg);
            } else {
                $('#replay-list').append('<div>'+detail+'</div>');
            };
        }, 'json'
    );
});