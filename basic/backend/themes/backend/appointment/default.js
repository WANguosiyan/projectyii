var handle_layer;
//店铺申请处理
$('.handle').click(function(){
    var url = $(this).attr('data-href');
    $.get(url,function(res){
        handle_layer = layer.open({
            title:'处理说明',
            type:1,
            content:res,
            area:['500px','auto']
        })
    })
});
$('body').on('click','.handle-submit',function(){
    var memo = $('.handle_comment').val();
    var id = $(this).attr('data-id');
    if(memo != ''){
        $.post('?r=appointment/default/handle',{id:id,memo:memo,_csrf:$('#_csrf').val()},function(res){
            layer.msg(res.msg,{time:1000});
            if(res.code == 200){
                layer.close(handle_layer);
                setTimeout(function(){
                    location.reload();
                },1000)
            }
        },'json');
    }
});
$('body').on('click','.handle-cancel',function(){
    layer.close(handle_layer);
});
