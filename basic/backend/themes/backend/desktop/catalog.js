//定义setTimeout执行方法
var TimeFn = null;

$('.file-preview-frame').click(function () {
    var obj = $(this);
    // 取消上次延时未执行的方法
    clearTimeout(TimeFn);
    //执行延时
    TimeFn = setTimeout(function(){
        //do function在此处写单击事件要执行的代码
        var obj2 = obj.find('.img2');
        if (obj2.attr('data-id') == 0) {
            obj2.attr('data-id', '1');
            obj2.show();
        }
        else {
            obj2.attr('data-id', '0');
            obj2.hide();
        }
    },300);
});

$('.file-preview-frame').dblclick(function () {
    // 取消上次延时未执行的方法
    clearTimeout(TimeFn);
    //双击事件的执行代码
    var obj = $(this);
    var dir = obj.attr('data-id');
    if (dir == 0) {
        return false;
    }
    location.href = '?r=desktop/catalog/index&dir='+dir;
});

//创建目录
$('.create').click(function(){
    bootbox.prompt("请输入目录名称！", function(result) {
        if (result !== null) {
            var current_id = $('.current_dir').val();
            App.blockUI({
                target: 'body',
                animate: true
            });
            $.post(
                '?r=desktop/catalog/create',
                {'current_dir':current_id,'dir_name':result, '_csrf':$('.request-csrf').val()},
                function (res) {
                    if (res.code == 200) location.reload();
                },'json'
            );
        }
    });
});

//删除目录
$('.delete').click(function(){
    bootbox.confirm("确定删除选择的目录", function(result) {
        if (result) {
            App.blockUI({
                target: 'body',
                animate: true
            });
            var current_id = $('.current_dir').val();
            var dir = '';
            $('.img2').each(function(){
                var obj = $(this);
                if (obj.attr('data-id') == 1) dir += obj.prev().attr('title')+',';
            });
            if (dir == '') {
                alert('没有选中的目录或文件');
                return false;
            }
            $.post(
                '?r=desktop/catalog/delete',
                {'current_dir':current_id, 'dir':dir, '_csrf':$('.request-csrf').val()},
                function (res) {
                    location.reload();
                },'json'
            );
        }
    });
});

//上传图片
$("#file-5").on("filebatchuploadcomplete", function (event, data, previewId, index) {

        location.reload();

});