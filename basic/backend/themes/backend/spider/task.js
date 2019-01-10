function sync(plat, task_id)
{
    var route = '';
    if (plat == 'ymx') {
        route = 'spider/ymx/index';
    } else if (plat == 'jd') {
        route = 'spider/jd/index';
    } else if (plat == 'tm') {
        route = 'spider/tb/index';
    } else if (plat == 'yx') {
        route = 'spider/sn/index';
    }

    App.blockUI({
        target: '.portlet',
        animate: true
    });

    $.post(
        api_url+'/'+route,
        {'task_id':task_id},
        function (res) {
            if (res.code == 200) {
                location.reload();
            } else {
                bootbox.alert(res.msg);
            }
        },'json'
    );

    window.setTimeout(function() {
        App.unblockUI('.portlet');
    }, 15000);
}