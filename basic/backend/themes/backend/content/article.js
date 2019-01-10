//详细编辑
if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400
    });
}
$('.comment').click(function(){
    console.log(111);
    var obj_b = $(this);
    var id = $(this).attr('data-id');
    var obj = $('.show-'+id);
    var open = obj.parent().attr('data-open');
    var show = obj.attr('data-show');
    console.log(show);
    if (open == 'false') {
        if (show == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=txt/newslist/comment',
                {'id':id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-success active').text('关闭评论');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-success active').text('关闭评论');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-success active').addClass('btn-success ').text('查看评论');
    }
});