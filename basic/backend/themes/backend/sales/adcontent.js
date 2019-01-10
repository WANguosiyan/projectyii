validate(
    {
        'AdContent[title]':{'required': true},
        'AdContent[link]':{'required': true}
    },
    {
        'AdContent[title]':{'required': '内容说明不能为空'},
        'AdContent[link]':{'required': '链接地址不能为空'}
    }
);