//验证表单
validate(
    {
        'Spider[spider_name]':{'required':true},
        'Spider[url]':{'required':true},
        'Spider[p_order]':{'required':true,min:1}
    },
    {
        'Spider[spider_name]':{'required':'名不能为空'},
        'Spider[url]':{'required':'爬虫开始URL不能为空'},
        'Spider[p_order]':{'required':'排序不能为空','min':'排序不能为空'}
    }
);