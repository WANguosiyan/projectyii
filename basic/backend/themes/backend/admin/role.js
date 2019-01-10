//验证表单
validate(
    {'Group[group_name]':{'required':true}},
    {'Group[group_name]':{'required':'角色名不能为空'}}
);

//弹出冻结操作
$('.cancel').click(function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            $.post(
                data_href,
                {'_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });
});
