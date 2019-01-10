//验证
validate(
    {
        'Point[title]':{'required': true},
        'product_name':{'required': true},
        'Point[p_order]':{'required': true}
    },
    {
        'Point[title]':{'required': '促销语不能为空'},
        'product_name':{'required': '积分商品不能为空'},
        'Point[p_order]':{'required': '排序不能为空'}
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
        '?r=goods/goods/product',
        {'selectType':selectType, 'product_id':$('.sales-product-id').val(),'_csrf': $('.request-csrf').val()},
        function (res) {
            $('.modal-body').html(res);
        }
    );
});

//商品选择确认
$('.goods-one-sub').on('click',function(){
    var obj = $('.products:checked');
    var product_id = obj.val();
    var goods_id = obj.attr('data-goods');
    if (product_id > 0) {
        var product_name = obj.parent().next().html();
        $('.sales-product-id').val(product_id);
        $('.sales-goods-id').val(goods_id);
        $('.sales-product-name').val(product_name);
        $('.goods-one-close').click();
    } else {
        alert('请选择货品');
    }
});