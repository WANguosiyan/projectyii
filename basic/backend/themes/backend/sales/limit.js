//验证
if ($('#validation-form').html()) {
    validate(
        {
            'Limit[title]':{'required': true},
            'Limit[product_id]':{'required': true, min:1},
            'Limit[store]':{'required': true, min:1},
            'Limit[price]':{'required': true},
            'Time[date]':{'required': true},
            'Time[quantum]':{'required': true, min:1},
            'Limit[orderby]':{'required': true}
        },
        {
            'Limit[title]':{'required': '促销语不能为空'},
            'Limit[product_id]':{'required': '商品不能为空', min:'商品不能为空'},
            'Limit[store]':{'required': '库存不能为空', min:'库存不能为空'},
            'Limit[price]':{'required': '秒杀价不能为空'},
            'Time[date]':{'required': '秒杀日期不能为空'},
            'Time[quantum]':{'required': '秒杀时间段不能为空', min:'秒杀时间段不能为空'},
            'Limit[orderby]':{'required': '排序不能为空'}
        }
    );

    datePicker($('.create_time_start'));
}

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
    var store = obj.attr('data-store');
    if (product_id > 0) {
        var product_name = obj.parent().next().html();
        $('.sales-product-id').val(product_id);
        $('.sales-goods-id').val(goods_id);
        $('.sales-product-name').val(product_name);
        $('.limit-goods-store').text(store);
        $('.goods-one-close').click();
    } else {
        alert('请选择货品');
    }
});