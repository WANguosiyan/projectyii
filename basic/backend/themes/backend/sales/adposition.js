validate(
    {
        'AdPosition[type]':{'required': true},
        'AdPosition[name]':{'required': true},
        'AdPosition[no]':{'required': true}
    },
    {
        'AdPosition[type]':{'required': '页面类型不能为空'},
        'AdPosition[name]':{'required': '名称不能为空'},
        'AdPosition[no]':{'required': '编号不能为空'}
    }
);