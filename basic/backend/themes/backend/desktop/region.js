$('table').on('click','.open-child',function(){
    var obj = $(this);
    openChild(obj);
});

function openChild(obj)
{
    var parent_id = obj.attr('data-id');
    var status = obj.attr('data-status');
    if (status == 0) {
        App.blockUI({
            target: 'body',
            animate: true
        });
        $.post(
            '?r=desktop/region/detail',
            {'parent_id':parent_id, '_csrf':$('.request-csrf').val()},
            function (res) {
                App.unblockUI('body');
                $('.now-cat-'+parent_id).after(res);
                obj.attr('data-status',1).removeClass('yellow').addClass('default').text('关闭');
            }
        );
    } else if (status == 2) {
        obj.attr('data-status',1).removeClass('yellow').addClass('default').text('关闭');
        open2Child($('.parent-id-'+parent_id));
    }
    else {
        //隐藏
        obj.attr('data-status',2).removeClass('default').addClass('yellow').text('下级');
        closeChild($('.parent-id-'+parent_id));
    }
}

function open2Child(obj)
{
    if (obj.html()) {
        obj.each(function(){
            open2Child($('.parent-id-'+$(this).find('.open-child').attr('data-id')));
            $(this).show();
        });
    }
}

function closeChild(obj)
{
    if (obj.html()) {
        obj.each(function(){
            closeChild($('.parent-id-'+$(this).find('.open-child').attr('data-id')));
            $(this).hide();
        });
    }
}
