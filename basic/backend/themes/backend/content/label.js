//验证表单
validate(
    {
        'Label[label_name]':{'required':true},
        'Label[type_id]':{'required':true, min:1},
        'Label[p_order]':{'required':true,min:1}
    },
    {
        'Label[label_name]':{'required':'名不能为空'},
        'Label[type_id]':{'required':'类型不能为空','min':'类型不能为空'},
        'Label[p_order]':{'required':'排序不能为空','min':'排序至少为1'}
    }
);