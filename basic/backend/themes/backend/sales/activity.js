//表单验证
validate(
    {
        'Activity[title]':{'required': true},
        'Activity[start_time]':{'required': true},
        'Activity[end_time]':{'required': true},
        'Activity[rule_id]':{'required': true, min:1}
    },
    {
        'Activity[title]':{'required': '标题不能为空'},
        'Activity[start_time]':{'required': '开始时间不能为空'},
        'Activity[end_time]':{'required': '结束时间不能为空'},
        'Activity[rule_id]':{'required': '优惠类型不能为空', min:'促销规格不能为空'}
    }
);

//订单时间
if ($('form').html()) {
    dateTimePicker($('.create_time_start'));
    dateTimePicker($('.create_time_end'));
}