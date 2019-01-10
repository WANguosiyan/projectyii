//验证表单
validate(
    {
        'Brand[brand_name]':{'required':true},
        'Brand[p_order]':{'required':true,min:1}
    },
    {
        'Brand[brand_name]':{'required':'品牌名不能为空'},
        'Brand[p_order]':{'required':'排序不能为空','min':'排序至少为1'}
    }
);

if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400,
    });
}