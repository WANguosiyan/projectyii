//表单验证
validate(
    {
        'Rule[title]':{'required': true},
        'Rule[brief]':{'required': true},
        'Rule[type]':{'required': true},
        'Rule[reduce_type]':{'required': true}
    },
    {
        'Rule[title]':{'required': '标题不能为空'},
        'Rule[brief]':{'required': '描述不能为空'},
        'Rule[type]':{'required': '规则类型不能为空'},
        'Rule[reduce_type]':{'required': '优惠类型不能为空'}
    }
);

//促销类型
$('.activity-type').change(function(){
    var val = $(this).val();
    if (val == 'subtract') {
        $('.action-subtract').show();
        $('.action-freeship').hide();
        $('.action-discount').hide();
    } else if (val == 'freeship') {
        $('.action-subtract').hide();
        $('.action-freeship').show();
        $('.action-discount').hide();
    } else if (val == 'discount') {
        $('.action-subtract').hide();
        $('.action-freeship').hide();
        $('.action-discount').show();
    }
});

//商品分类
$('#tree_2').on('changed.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
        r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.condition-cat').val(r.join(','));
}).jstree({
    'plugins': ["wholerow", "checkbox", "types"],
    'core': {
        "themes" : {
            "responsive": false
        },
        'data' : {
            'url' : function (node) {
                return '?r=goods/cate/ajaxdata';
            },
            'data' : function (node) {
                return {
                    'parent' : node.id,
                    'cat_parent_id': $('.condition-cat').val(),
                    'cat_opened': 1
                };
            }
        }
    },
    "types" : {
        "default" : {
            "icon" : "fa fa-folder icon-state-warning icon-lg"
        },
        "file" : {
            "icon" : "fa fa-file icon-state-warning icon-lg"
        }
    }
});

//品牌
$('#my_multi_select1').multiSelect(
    {
        afterSelect: function(values){
            $('#tab2').append('<input type="hidden" id="brand-opt-'+values+'" value="'+values+'" name="Condition[brand][]">');
        },
        afterDeselect: function(values){
            $('#brand-opt-'+values).remove();
        }
    }
);

//是否全场
$('.switch-radio1').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == false) {
        $('#condition').show();
        $('.condition-all').val(0);
    } else {
        $('#condition').hide();
        $('.condition-all').val(1);
    }
});

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
        {
            'selectType':selectType,
            'rule_id':$('.rule_id').val(),
            '_csrf': $('.request-csrf').val()
        },
        function (res) {
            $('.modal-body').html(res);
        }
    );
});
//商品选择确认
$('.goods-one-sub').on('click',function(){
    var obj = $('.goods:checked');

    obj.each(function(){
        var goods_id = $(this).val();
        var goods_name = $(this).parent().next().html();
        $('.bootstrap-tagsinput').prepend('<span class="tag label label-info">'+goods_id+'_'+goods_name+'<span class="tag-remove" data-id="'+goods_id+'"></span></span><br>');
        $('#tab3').append('<input type="hidden" name="Condition[goods][]" id="tag-'+goods_id+'" value="'+goods_id+'">');
    });
    $('.goods-one-close').click();
});

$('#tags').tagsinput()
$('#tags').on('itemRemoved', function(event) {
    var tag = event.item;
    var goods_id = tag.split('_')[0];
    $('#tag-'+goods_id).remove();
});

$('#tab3').on('click', '.tag-remove',function(){
    var goods_id = $(this).attr('data-id');
    $(this).parent().next().remove();
    $(this).parent().remove();
    $('#tag-'+goods_id).remove();
});