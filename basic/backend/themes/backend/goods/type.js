//表单验证
validate(
    {
        'Type[name]':{'required':true}
    },
    {
        'Type[name]':{'required':'类型名不能为空'}
    }
);
//扩展属性
var $modal = $('#ajax-modal');

$('#ajax-demo').on('click', function(){
    var html = '';
    $.post(
        '?r=goods/props/index',
        {'_csrf': $('.request-csrf').val()},
        function (res) {
            bootbox.dialog({
                message: res,
                title: "商品扩展属性",
                buttons: {
                    success: {
                        label: "确认",
                        className: "green",
                        callback: function() {
                            $('.checkboxes:checked').each(function(){
                                html += '<span class="tag label label-info"><input type="hidden" value="'+$(this).val()+'" name="Props[]">'+
                                $(this).attr('data-name')+'<span data-role="remove" class="remove"></span></span>';
                            });
                            $('.props-list').append(html);
                        }
                    },
                    danger: {
                        label: "关闭",
                        className: "yellow",
                        callback: function () {

                        }
                    }
                }
            });
        }
    );
});
$('body').on('click','.remove',function(){
    $(this).parent().remove();
});
//全选
$('body').on('change','.group-checkable',function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).prop("checked", true);
        } else {
            $(this).prop("checked", false);
        }
    });
    jQuery.uniform.update(set);
});
//分页
$('body').on('click', '.pagination a',function(){
    var page = $(this).text() * 1;
    $.post(
        '?r=goods/props/index&page='+page,
        {'_csrf': $('.request-csrf').val()},
        function (res) {
            $('.modal-body').html(res);
        }
    );
    return false;
});