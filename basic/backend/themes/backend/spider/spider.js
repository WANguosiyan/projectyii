$('.view-url').click(function(){
    bootbox.alert($(this).attr('data-url'));
});

function sync(plat, goods_id)
{
    if (plat == 'ymx') {
        ymx(goods_id);
    } else if (plat == 'jd') {
        jd(goods_id);
    }
}

//亚马逊
function ymx(goods_id)
{
    App.blockUI({
        target: '.portlet',
        animate: true
    });

    $.post(
        api_url+'/spider/ymx/row',
        {'goods_id':goods_id},
        function (res) {
            if (res.code == 200) {
                bootbox.alert(res.msg);
                location.reload();
            } else {
                bootbox.alert(res.msg);
                location.reload();
            }
        },'json'
    );

    window.setTimeout(function() {
        App.unblockUI('.portlet');
    }, 10000);
}

function jd(goods_id)
{
    App.blockUI({
        target: '.portlet',
        animate: true
    });

    $.post(
        api_url+'/spider/jd/row',
        {'goods_id':goods_id},
        function (res) {
            if (res.code == 200) {
                bootbox.alert(res.msg);
                location.reload();
            } else {
                bootbox.alert(res.msg);
                location.reload();
            }
        },'json'
    );

    window.setTimeout(function() {
        App.unblockUI('.portlet');
    }, 10000);
}

//亚马逊
$('.ymx-price').click(function(){
    App.blockUI({
        target: '.portlet',
        animate: true
    });

    $.post(
        api_url+'/spider/ymx/list',
        {},
        function (res) {
            bootbox.alert(res.msg);
        },'json'
    );

    window.setTimeout(function() {
        App.unblockUI('.portlet');
    }, 10000);
});

//京东
$('.jd-price').click(function(){
    App.blockUI({
        target: '.portlet',
        animate: true
    });

    $.post(
        api_url+'/spider/jd/list',
        {},
        function (res) {
            bootbox.alert(res.msg);
        },'json'
    );

    window.setTimeout(function() {
        App.unblockUI('.portlet');
    }, 10000);
});