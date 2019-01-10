//分页
$('.pagination a').on('click', function(){
    var href = $(this).attr('href');
    $.post(
        href,
        {
            'selectType':$('.goods-select').attr('data-type'),
            'position_id':$('.goods-select').attr('data-id'),
            'goods_id':$('.sales-goods-id').val(),
            '_csrf':$('.request-csrf').val()
        },
        function (msg) {
            $('.modal-body').html(msg);
        }
    );
    return false;
});

//商品搜索
$('.search-submit').on('click',  function(){
    var goods_id = $('#no_goods_id').val();
    $.get(
        '?r=spider/spider/index&ajax=1&goods_id='+goods_id,
        {
            'Single[name]':$(".Single_name").val(),
            'Single[search_val]':$("input[name='Single[search_val]']").val(),
            'type':1,
            '_csrf':$('.request-csrf').val()
        },
        function (msg) {
            $('.modal-body').html(msg);
        }
    );
    return false;
});
