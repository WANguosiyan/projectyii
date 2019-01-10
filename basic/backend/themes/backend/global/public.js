//设置弹出层语言
bootbox.setDefaults("locale","zh_CN");

//搜索表单提交
$('.search-submit').on('click', function(){
    $('.search-single').submit()
});

//弹出高级筛选层 --start
var multi = $('.multi-status').val();
if (multi == 1) {
    $('.search-multi-open').attr('data-toggle', 1);
    $('.table-toolbar').addClass('page-quick-sidebar-open');
}
$('.search-multi-open').click(function(){
    multiOpen($(this));
});

$('.search-multi-close').click(function(){
    multiClose($(this));
});

function multiOpen(obj)
{

    var toggle = obj.attr('data-toggle');
    if (toggle == 0) {
        obj.attr('data-toggle', 1);
        $('.table-toolbar').addClass('page-quick-sidebar-open');
    } else {
        obj.attr('data-toggle', 0);
        $('.table-toolbar').removeClass('page-quick-sidebar-open');
    }
}

function multiClose()
{
    $('.search-multi-open').attr('data-toggle', 0);
    $('.table-toolbar').removeClass('page-quick-sidebar-open');
}
//弹出高级筛选层 --end

//删除提示
$(table).on('click','.delete',function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var id = obj.attr('data-id');
            var csrf = $('.request-csrf').val();
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

//日期时间
function datePicker(obj)
{
    obj.datepicker({
        format: "yyyy-mm-dd",
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });
}
function dateTimePicker(obj)
{
    obj.datetimepicker({
        language:'zh-CN',
        autoclose: true,
        isRTL: App.isRTL(),
        format: "yyyy-mm-dd  hh:ii",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
    });
}
function dateBusinessTimePicker(obj)
{
    obj.datetimepicker({
        language:'zh-CN',
        format: 'hh:ii',
        autoclose: true,
        startView:1,
        minView: 0,
        minuteStep:10

    });
}
