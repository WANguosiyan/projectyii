//验证表单
validate(
    {
        'User[login_account]':{'required':true},
        'User[truename]':{'required':true},
        'Role[role_id]':{'required':true, min:1}
    },
    {
        'User[login_account]':{'required':'登录名不能为空'},
        'User[truename]':{'required':'真实名不能为空'},
        'Role[role_id]':{'required':'角色组不能为空', 'min':'角色组不能为空'}
    }
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

