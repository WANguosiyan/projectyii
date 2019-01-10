//验证
validate(
    {
        'GoodsContent[title]':{'required': true},
        'GoodsContent[goods_id]':{'required': true},
        'GoodsContent[p_order]':{'required': true}
    },
    {
        'GoodsContent[title]':{'required': '促销语不能为空'},
        'GoodsContent[goods_id]':{'required': '促销商品不能为空'},
        'GoodsContent[p_order]':{'required': '排序不能为空'}
    }
);
//商品选择
$('.goods-select').on('click',function(){
    App.blockUI({
        target: '#portlet',
        animate: true
    });

    window.setTimeout(function() {
        App.unblockUI('#portlet');
    }, 2000);
    var selectType = $(this).attr('data-type');
    $.post(
        '?r=goods/goods/default',
        {'selectType':selectType, 'position_id':$(this).attr('data-id'),'goods_id':$('.sales-goods-id').val(),'_csrf': $('.request-csrf').val()},
        function (res) {
            $('.modal-body').html(res);
        }
    );
});

//商品选择确认
$('.goods-one-sub').on('click',function(){
    var obj = $('.goods:checked');
    var goods_id = obj.val();
    if (goods_id > 0) {
        var goods_name = obj.parent().next().html();
        $('.sales-goods-id').val(goods_id);
        $('.sales-goods-name').val(goods_name);
        $('.goods-one-close').click();
    } else {
        alert('请选择商品');
    }
});