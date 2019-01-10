//验证

validate(
    {
        'Goods[name]':{'required':true},
        'Goods[bn]':{'required':true},
        'Goods[intro]':{'required':true},
    },
    {
        'Goods[name]':{'required':'商品名称不能为空'},
        'Goods[bn]':{'required':'商品编号不能为空'},
        'Goods[intro]':{'required':'商品详情不能为空'},
    }
);

scoll();

var selected_spec_id = [];
$.each($('#tab_desc .form-group select'),function(k,v){
    selected_spec_id.push($(this).data('spec_id').toString());
})

//给模态框中的列表ajax分页
$('body').on('click','#spec-modal .pagination a',function(e){
    e.preventDefault();
    var href = $(this).attr('href');
    $.get(href,{},function(data){
        $('#spec-modal').find('.modal-body').html(data);
    })
}).on('click','.goods-spec-delete',function(e){
    //删除参数
    var is_new_data = $(this).data('is_new'),
        spec_id = $(this).data('spec_id');

    if(is_new_data == 0){
        remove_val_from_arr(selected_spec_id,spec_id);
        console.log(selected_spec_id)
        $(this).closest('.form-group').remove();
    }else{
        remove_val_from_arr(selected_spec_id,spec_id);
        $(this).closest('.form-group').remove();
    }
})

//点击参数模态框的确认按钮的回调事件
$('.btn-yes-spec').click(function(){
    var tmp_spec_id_arr = []; //存储选中的临时参数
    $.each($("input[name='CheckBox[spec_id]']:checked"),function(k,v){
        selected_spec_id.push($(this).val());
        tmp_spec_id_arr.push($(this).val());
    })

    //loading动画
    var index = layer.load(1, {
        shade: [0.1,'#fff'] //0.1透明度的白色背景
    });
    $.get('?r=cloud_shop/spec/ajax-val-list',{selected_spec_id:tmp_spec_id_arr},function(data){
        layer.close(index);
        $('#tab_desc').find('.form-body').append(data);
    })
    var html = '';
    $('#spec-modal').modal('hide');
});

//点击添加参数的按钮的事件
$('.btn-add-spec').click(function(e){
    var index = layer.load(1, {
        shade: [0.1,'#fff'] //0.1透明度的白色背景
    });

    //加载属性列表
    $.get('?r=goods/spec/ajax-list',{selected_spec_id:selected_spec_id},function(data){
        layer.close(index);
        $('#spec-modal').find('.modal-body').html(data);
    });

    //模态框显示
    $('#spec-modal').modal({
        backdrop:'static'
    })
});

//详细编辑
if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400,
    });
}

//高级筛选框选择分类后点击确定的事件
$('.goods-cat-ok').click(function(){
    var cat_id = $('.jstree-clicked').parent().attr('id');
    if (cat_id > 0) {
        $('.cat-parent-id').val(cat_id);
        var cat_name = $('.jstree-clicked').html();
        var cat_name2 = cat_name.replace(/<(.*?)>(.*?)<(.*?)>/g, '');
        $('.goods-cat').val(cat_name2);
        //$('#goods-cat').hide();
        //$('.modal-backdrop').remove();
    } else {
        alert('请选择分类');
    }
});


//商品列表页页面一加载   加载商品分类的树形图
$("#tree_4").jstree({
    "core" : {
        "themes" : {
            "responsive": false
        },
        "check_callback" : function(operation, node, node_parent, node_position, more){
        },
        'data' : {
            'url' : function (node) {
                return '?r=cloud_shop/cate/ajaxdata';
            },
            'data' : function (node) {
                return {
                    'parent' : node.id,
                    'cat_path' : $('.cat_path').val(),
                    'cat_parent_id': $('.cat-parent-id').val()
                };
            }
        }
    }
});

//类型变更
$('.goods-type').change(function(){
    var type_id = $(this).val();
    var obj = $(this);
    bootbox.confirm("类型修改后，品牌、扩展属性、规格等数据发生变化，请确认是否修改?", function(result) {
        if (result == true) {
            $.post(
                '?r=cloud_shop/default/changetype',
                {'type_id':type_id,'_csrf':$('.request-csrf').val()},
                function (res) {
                    if (res.code == 200) {
                        $('.goods-brand').html(res.data.brand);
                        if (res.data.props != '') {
                            $('.goods-props-tab').show();
                            $('#tab_props').html(res.data.props);
                        } else {
                            $('.goods-props-tab').hide();
                            $('#tab_props').html('');
                        }
                        if (res.data.spec != '') {
                            $('.goods-spec-tab').show();
                            $('#tab_spec').html(res.data.spec);
                        } else {
                            $('.goods-spec-tab').hide();
                            $('#tab_spec').html('');
                        }
                    }
                },'json'
            );
        } else {
            obj.find('option[value="0"]').attr('checked',true);
        }
    });
});

//生成货品
$('body').on('click', '.submit-product', function(){
    var tmp = true;
    var spec_value = new Array();
    $('.spec-list').each(function(k1){
        var obj1 = $(this);
        var tmp_value = false;
        var spec_id = obj1.find('.spec-list-id').val();
        var spec_name = obj1.find('.spec-list-id').attr('data-name');
        spec_value[k1] = new Array();
        obj1.find('.spec-value-list:checked').each(function(k){
            var obj2 = $(this);
            spec_value[k1][k] = {
                'spec_id':spec_id,
                'spec_name':spec_name,
                'spec_value_id':obj2.val(),
                'spec_value_name':obj2.attr('data-name')
            };
            tmp_value = true;
        });
        if (tmp_value == false) {
            tmp = false;
            alert('规格：'+spec_name+'没有选择规格值');
            return false;
        }
    });
    if (tmp) {
        //请求获取数据
        var goods_id = $('.goods-id').val();
        var name = $("input[name='Goods[name]']").val();
        var bn = $("input[name='Goods[bn]']").val();
        var price = $("input[name='Goods[price]']").val();
        var mktprice = $("input[name='Goods[mktprice]']").val();
        var cost = $("input[name='Goods[cost]']").val();
        var weight = $("input[name='Goods[weight]']").val();
        var unit = $("input[name='Goods[unit]']").val();

        $.post(
            '?r=cloud_shop/default/product',
            {
                'spec':JSON.stringify(spec_value),
                'goods_id':goods_id,
                'name':name,
                'bn':bn,
                'price':price,
                'mktprice':mktprice,
                'cost':cost,
                'weight':weight,
                'unit':unit,
                '_csrf':$('.request-csrf').val()
            },
            function (res) {
                $('.table-spec').html(res.data.product_list);
            },'json'
        );
    }
});
//订单时间
if ($('#validation-form').html()) {
    dateTimePicker($('.create_time_start'));
    dateTimePicker($('.create_time_end'));
}
//商品图片的上传
$("#file-5").on("fileuploaded", function (event, data, previewId, index) {
    if (data.response.code == 200) {
        $('.image-preview').show();
        var default_button = '';

        if ($('.image-default').attr('data-id') == 1) {
            //不是默认图片显示的按钮
            default_button = '<div><button type="button" class="btn btn-sm blue-madison set-default">设置默认</button>'+
            '<input type="hidden" value="0" name="Image[default][]"></div>';
        } else {
            //默认图片显示的按钮
            default_button = '<div><button type="button" class="btn btn-sm grey-cascade image-default" data-id="1">默认</button>'+
            '<input type="hidden" value="1" name="Image[default][]"></div>';
        }

        //渲染已经上传的商品图片的html  image[key][] 设置为0是区分已经和商品关联的图片
        var html = '<div class="file-preview-frame">'+
            '<img style="width:auto;height:160px;" alt="gongyi06.jpg" title="'+data.response.data.img_url+'" class="file-preview-image" src="'+data.response.data.img_url+'">'+
            '<input type="hidden" value="'+data.response.data.img_url+'" name="Image[url][]">'+
            '<input type="hidden" value="0" name="Image[key][]">'+
            '<div class="file-thumbnail-footer">'+
            '<div class="file-actions">'+
            '<div class="file-footer-buttons">'+
            '<button type="button" class="btn btn-sm red-sunglo image-del">删除</button>'+
            '</div>'+
            '<div title="Not uploaded yet" tabindex="-1" class="file-upload-indicator">'+
            default_button+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>'+
            '</div>'+
            '</div>';
        $('.image-list').append(html);
    }
});

/**
 * 设置为默认图片
 */
$('.image-list').on('click','.set-default', function(){
    //将所有的图片设置为显示设置默认按钮
    $('.image-default').parent().html('<div><button type="button" class="btn btn-sm blue-madison set-default">设置默认</button>' +
        '<input type="hidden" value="0" name="Image[default][]"></div>');

    //将当前图片设置为显示默认按钮
    $(this).parent().html('<div><button type="button" class="btn btn-sm grey-cascade image-default" data-id="1">默认</button>' +
        '<input type="hidden" value="1" name="Image[default][]"></div>');
});

/**
 * 上传后，删除上传后的图片
 */
$('.image-list').on('click','.image-del', function(){
    $(this).parents('.file-preview-frame').remove();
});

/**
 * 删除货品
 */
$('#tab_spec').on('click', '.product-del', function(){
    $(this).parent().parent().remove();
});

/**
 * 删除商品
 */
$('.goods-delete').on('click', function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除，删除后有关此商品的所有信息将被删除！", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            App.blockUI({
                target: '.page-container',
                animate: true
            });
            bootbox.hideAll();
            $.post(
                data_href,
                {'_csrf': csrf},
                function (res) {
                    App.unblockUI('.page-container');
                    if (res.code == 500){
                        bootbox.alert(res.msg);
                    } else{
                        location.reload();
                    }

                }, 'json'
            );

        }
    });
});
/**
 * 删除团购
 */
$('.collage-delete').on('click', function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除，删除后有关此团购的所有信息将被删除！", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            $.post(
                data_href,
                {'_csrf': csrf},
                function (res) {
                    console.log(res);
                    if (res.code == 500){
                        bootbox.alert(res.msg);
                        setTimeout('testfunction()',"2000");
                    }else if(res.code == 200){
                        bootbox.alert('删除成功');
                        setTimeout('testfunction()',"2000");
                    }


                }, 'json'
            );
            return false;
        }
    });
});
function testfunction(){
    location.reload();
}
/**
 * 删除团购
 */
$('.collage-update').on('click', function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除，删除后有关此团购的所有信息将被删除！", function(result) {
        if (result == true) {
            var data_href = obj.attr('data-href');
            var csrf = $('.request-csrf').val();
            $.post(
                data_href,
                {'_csrf': csrf},
                function (res) {
                    if (res == 500)
                        console.log(111);
                    bootbox.alert(res.msg);
                    sleep(3000);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });
});

//批量上架功能
$('.goods-up').on('click', function(){
    var goods_id = '';
    $('.checkboxes:checked').each(function(){
        goods_id += $(this).val()+',';
    });

    if (goods_id == '') {
        bootbox.alert('没有选中商品');
        return false;
    }

    bootbox.confirm("是否确定上架选中的商品！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=cloud_shop/default/up',
                {'goods_id':goods_id, '_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });

    return false;
});
//批量删除cat下的商品
$('.cat-batch-del').on('click', function(){
    var goods_id = '';
    var id = $(this).attr('data-id');
    console.log(id);
    $('.checkboxes:checked').each(function(){
        goods_id += $(this).val()+',';
    });

    if (goods_id == '') {
        bootbox.alert('没有选中商品');
        return false;
    }

    bootbox.confirm("是否确定删除选中的商品！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=goods/finequality/cat-batch-del',
                {'id':id,'goods_id':goods_id, '_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    bootbox.alert('删除成功');
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });

    return false;
});
//批量上架团购功能
$('.collage-up').on('click', function(){
    var collage_id = '';
    $('.checkboxes:checked').each(function(){
        collage_id += $(this).val()+',';
    });

    if (collage_id == '') {
        bootbox.alert('没有选中团购');
        return false;
    }
    console.log(collage_id);
    bootbox.confirm("是否确定上架选中的团购！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=cloud_shop/collage-default/up',
                {'collage_id':collage_id, '_csrf': csrf},
                function (res) {
                    console.log(res);
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json');
            return true;
        }
    });

    return false;
});

//批量下架功能
$('.goods-down').on('click', function(){
    var goods_id = '';
    $('.checkboxes:checked').each(function(){
        goods_id += $(this).val()+',';
    });

    if (goods_id == '') {
        bootbox.alert('没有选中商品');
        return false;
    }

    bootbox.confirm("是否确定下架选中的商品！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=cloud_shop/default/down',
                {'goods_id':goods_id, '_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });

    return false;
});
//批量删除商品功能
$('.goods-del').on('click', function(){
    var goods_id = '';
    $('.checkboxes:checked').each(function(){
        goods_id += $(this).val()+',';
    });

    if (goods_id == '') {
        bootbox.alert('没有选中商品');
        return false;
    }

    bootbox.confirm("是否确定删除选中的商品！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=cloud_shop/default/batch-del',
                {'goods_id':goods_id, '_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });

    return false;
});
//团购下架
$('.collage-down').on('click', function(){
    var collage_id = '';
    $('.checkboxes:checked').each(function(){
        collage_id += $(this).val()+',';
    });

    if (collage_id == '') {
        bootbox.alert('没有选中团购');
        return false;
    }

    bootbox.confirm("是否确定下架选中的团购！", function(result) {
        if (result == true) {
            var csrf = $('.request-csrf').val();
            $.post(
                '?r=cloud_shop/collage-default/down',
                {'collage_id':collage_id, '_csrf': csrf},
                function (res) {
                    if (res == 500) bootbox.alert(res.msg);
                    location.reload();
                }, 'json'
            );
            return false;
        }
    });

    return false;
});

function remove_val_from_arr(arr,val)
{
    if(arr.length > 0){
        var index = arr.indexOf(val.toString());
        if(index >= 0){
            arr.splice(index,1);
        }
    }
    return arr;
}

var goods_sku = {

    init : function(){

        //绑定事件
        this.bindEvent();
        this.regenerate_sku_data();
    },

    bindEvent: function(){
        var that = this;

        //给属性的属性值的checkbox添加change事件
        $('#dropzone').on('click',':checkbox',$.proxy(this.onchangevalcheckbox,this));

        //给商品规格的checkbox添加事件
        $('.spec-title-box').on('click','.spec-values-item :checkbox',$.proxy(this.onchangepropcheckbox,this));

        //批量按钮添加事件
        $('#sku_table').on('click','.batch-edit',$.proxy(this.onclickbatchbtn,this))
            .on('click','.batch-close',$.proxy(this.onclickbatchinputoff,this)) //给批量设置的框添加关闭按钮事件
            .on('click','.btn_batch_set',$.proxy(this.onclickbatchyesbtn,this))

    },

    //批量设置确认事件
    onclickbatchyesbtn:function(e){
        var $target = $(e.target),
            tdIndex = $target.closest('th').index() ,
            input_val = $target.prev().val();

        $.each($('#sku_table tbody tr'),function(k,v){
            $(v).find('td').eq(tdIndex).find(':text').val(input_val);
        })

        $target.closest('.batch-input').hide();
    },

    //给批量设置的框添加关闭按钮事件
    onclickbatchinputoff:function(e){
        var $target = $(e.target);
        $target.closest('.batch-input').hide();
    },

    //点击批量设置的按钮的事件
    onclickbatchbtn:function(e){
        $target = $(e.target);
        $('.batch-input').hide();
        $target.closest('.batch').find('.batch-input').show();
    },

    //切换属性的checkbox事件
    onchangepropcheckbox:function(e){
       var $target = $(e.target),
           _this   = this,
           ischecked = $target.prop('checked'),
           checkboxIndex = $('.spec-values-item').index($target.closest('.spec-values-item'));

       if(ischecked){
           //选中属性后将相应的属性值的列表显示，并清空属性列表的父级元素 span的class清空
           $('.goods-spec-item').eq(checkboxIndex).show();
       }else{
           //失去选中属性后，将相应的属性值的列表隐藏，并清空属性列表的父级元素 span的class清空
           $('.goods-spec-item').eq(checkboxIndex).hide().find('.spec-values div.checker span.checked').removeClass().find(':checkbox').prop('checked',false);

           //重新渲染 sku-table
           this.render_sku_table();
       }

    },

    //切换属性值的checkbox
    onchangevalcheckbox:function(e){
        var _this = this,
            $target = $(e.target);
        this.render_sku_table();
    },

    //重新组成 sku data的信息
    regenerate_sku_data : function(){
        var display,
            $val_input,
            data = [];

        //遍历属性
        $.each($('.goods-spec-item'),function(k,v){
            display = $(v).css('display');
            if(display === 'block'){
                //遍历下面的属性值
                var pro_data = [];
                $.each($(v).find('.spec-values label'),function(kk,vv){
                    $val_input = $(vv).find('span.checked input');
                    if($val_input.length > 0){
                        pro_data.push({
                            props_id        : $val_input.data('attr-id'),
                            props_name      : $val_input.data('attr-name'),
                            props_value_id  : $val_input.data('vid'),
                            props_value_name: $val_input.data('vname'),
                        });
                    }

                });
                if(pro_data.length>0){data.push(pro_data)}
            }
        });
        return data;
    },

    //根据
    //计算笛卡尔乘积
    CartesianZ:function(data){
        // 参数形如 data = [
        //     [
        //         {spec_id :103,spec_name: '颜色',spec_value:'红色',spec_value_id:1},
        //         {spec_id :103,spec_name: '颜色',spec_value:'蓝色',spec_value_id:2},
        //     ],
        //     [
        //         {spec_id :102,spec_name: '逼格',spec_value:'高',spec_value_id:1},
        //         {spec_id :102,spec_name: '逼格',spec_value:'低',spec_value_id:2},
        //     ],
        // ];
        var Cartesian = function(a,b){
            var data = [];
            for(var i = 0 ; i < a.length; i++){
                for(var j = 0 ; j < b.length ; j++){
                    data.push(array(a[i],b[j]));
                }
            }
            return data;
        };

        var array = function(a,b){
            var ret=[];
            if(!(a instanceof Array)){
                ret=Array.call(null,a);
            }
            else{
                ret=Array.apply(null,a);
            }

            ret.push(b);
            return ret;
        };

        var len = data.length;

        if(len == 0){
            return [];
        }else if(len == 1){
            var tmp = [];
            $.each(data[0],function(k,v){
                tmp.push([v]);
            });
            return tmp;
        }else{
            var ret=data[0];
            for(var i=1;i<len;i++){
                ret=Cartesian(ret,data[i]);
            }
            return ret;
        }
    },

    //渲染sku-table的函数
    render_sku_table:function() {
        var data = this.CartesianZ(this.regenerate_sku_data()); //重新用笛卡尔乘积生成的data数组
        var thead_th_val_html = '';
        var tbody_tr_val_html = '';
        var val_td_html = '';
        var html = '';

        console.log(data);
        if (data.length > 0) {
            //隐藏提示框
            $('#sku_table_warning').hide();

            //渲染table中的头部
            $.each(data[0],function(k,v){
                thead_th_val_html += '<th class="spec-th th_spec_id_'+v.props_id+'">'+v.props_name+'</th>\n';
            });

            //渲染table中的body部分
            $.each(data,function(k,v){
                val_td_html = '';

                //遍历第二层
                $.each(v,function(kk,vv){
                    val_td_html += '<td class="spec-vname-td">\n' +
                        '              <span class="spec-vname-label spec-vname-label-'+vv.props_value_id+'" data-attr-id="'+vv.props_id+'">'+vv.props_value_name+'</span>\n' +
                        '              <input type="hidden" name="specs['+k+']['+vv.props_id+'][attr_id]" value="'+vv.props_id+'">\n' +
                        '              <input type="hidden" name="specs['+k+']['+vv.props_id+'][disabled]" value="false">\n' +
                        '              <input type="hidden" name="specs['+k+']['+vv.props_id+'][attr_vid]" value="'+vv.props_value_id+'" class="spec-vid-text-1073" data-attr-id="'+vv.props_id+'">\n' +
                        '              <input type="hidden" name="specs['+k+']['+vv.props_id+'][attr_vname]" value="'+vv.props_value_name+'" class="spec-vname-text-1073" data-attr-id="'+vv.props_id+'">\n' +
                        '              <input type="hidden" name="specs['+k+']['+vv.props_id+'][attr_desc]" value="" class="spec-desc-text-1073" data-attr-id="'+vv.props_id+'">\n' +
                        '        </td>';
                    console.log(vv);

                });

                tbody_tr_val_html += '<tr>\n' +
                    '                        <td class="sku-td-index text-c">'+(parseInt(k)+1)+'<!--<a class="del-btn sku-item-handle" data-sku-enable="false" data-sku-index="1" title="点击禁用此规格">×</a>!--></td>\n'    +
                                             val_td_html+
                    '\n' +
                    '                        <td class="sku-market-price-td ">\n' +
                    '                            <input type="text" name="sku['+k+'][price]" value="" class="form-control w60 sku-field sku-market-price" data-rule-min="0.01" data-msg-min="市场价必须是大于0的数字" data-msg-required="市场价不能为空"  data-rule-required="true">\n' +
                    '                        </td>\n' +
                    '                        <td class="sku-goods-price-td ">\n' +
                    '                            <input required type="text" name="sku['+k+'][discount_money]" value="" class="form-control w60 sku-field sku-goods-price" data-rule-required="true" data-msg-required="折扣价不能为空" data-rule-min="0" data-msg-min="折扣价必须是大于等于0的数字" data-msg-decimal="折扣价必须是一个数字">\n' +
                    '                        </td>\n' +
                    '                        <td>\n' +
                    '                            <input required type="text" name="sku['+k+'][store]" value="" class="form-control small sku-field sku-goods-number" data-msg-required="库存不能为空" data-rule-min="0" data-msg-min="库存必须大于等于0">\n' +
                    '                        </td>\n' +
                    '                        <td>\n' +
                    '                            <input required type="text" name="sku['+k+'][bn]" value="" class="form-control small sku-field sku-goods-number" data-rule-required="true" data-msg-required="货号不能为空">\n' +
                    '                        </td>\n' +
                    '                   </tr>';

            });

            //开始渲染table表格
            html = '              <thead>\n' +
                '                    <tr>\n' +
                '                        <th class="sku-th-index">序号</th>\n' +
                                         thead_th_val_html+
                '                        <th class="sku-market-price-td ">\n' +
                '                            <span class="text-danger ng-binding">*</span>\n' +
                '                            价格\n' +
                '                            <div class="batch">\n' +
                '                                <a href="javascript:void(0);" class="batch-edit" title="批量设置">\n' +
                '                                    <i class="fa fa-edit"></i>\n' +
                '                                </a>\n' +
                '                                <div class="batch-input" style="display: none;">\n' +
                '                                    <h6>批量设置价格：</h6>\n' +
                '                                    <a href="javascript:void(0);" class="batch-close">X</a>\n' +
                '                                    <input type="text" class="form-control text small pull-none valid" value="" aria-invalid="false">\n' +
                '                                    <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="market_price" value="设置">\n' +
                '                                    <span class="arrow"></span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </th>\n' +
                '                        <th class="sku-goods-price-td ">\n' +
                '                            <span class="text-danger ng-binding">*</span>\n' +
                '                            折扣价\n' +
                '                            <div class="batch">\n' +
                '                                <a href="javascript:void(0);" class="batch-edit" title="批量设置">\n' +
                '                                    <i class="fa fa-edit"></i>\n' +
                '                                </a>\n' +
                '                                <div class="batch-input" style="display: none;">\n' +
                '                                    <h6>批量设置折扣价：</h6>\n' +
                '                                    <a href="javascript:void(0);" class="batch-close">X</a>\n' +
                '                                    <input class="form-control text small pull-none valid" type="text" value="" aria-invalid="false">\n' +
                '                                    <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_price" value="设置">\n' +
                '                                    <span class="arrow"></span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </th>\n' +
                '                        <th>\n' +
                '                            <span class="text-danger ng-binding">*</span>\n' +
                '                            库存\n' +
                '                            <div class="batch">\n' +
                '                                <a href="javascript:void(0);" class="batch-edit" title="批量设置">\n' +
                '                                    <i class="fa fa-edit"></i>\n' +
                '                                </a>\n' +
                '                                <div class="batch-input" style="display: none;">\n' +
                '                                    <h6>批量设置库存：</h6>\n' +
                '                                    <a href="javascript:void(0);" class="batch-close">X</a>\n' +
                '                                    <input class="form-control text small pull-none" type="text" value="">\n' +
                '                                    <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_number" value="设置">\n' +
                '                                    <span class="arrow"></span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </th>\n' +
                '                        <th>\n' +
                '                            <span class="text-danger ng-binding">*</span>\n' +
                '                            商品货号\n' +
                '                            <div class="batch">\n' +
                '                                <a href="javascript:void(0);" class="batch-edit" title="批量设置">\n' +
                '                                    <i class="fa fa-edit"></i>\n' +
                '                                </a>\n' +
                '                                <div class="batch-input" style="display: none;">\n' +
                '                                    <h6>批量设置货号：</h6>\n' +
                '                                    <a href="javascript:void(0);" class="batch-close">X</a>\n' +
                '                                    <input class="form-control text small pull-none" type="text" value="">\n' +
                '                                    <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_number" value="设置">\n' +
                '                                    <span class="arrow"></span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </th>\n' +
                '                    </tr>\n' +
                '                </thead>\n' +
                '                <tbody>\n' +
                tbody_tr_val_html+
                '</tbody>';
            $('#sku_table').html(html);
            return true;
        }
        $('#sku_table_warning').show();
        $('#sku_table').html(html);
        return false;
    }


};
goods_sku.init();
// var arr = [
//     [
//         {spec_id :103,spec_name: '颜色',spec_value:'红色',spec_value_id:1},
//         {spec_id :103,spec_name: '颜色',spec_value:'蓝色',spec_value_id:2},
//     ],
//     [
//         {spec_id :102,spec_name: '逼格',spec_value:'高',spec_value_id:1},
//         {spec_id :102,spec_name: '逼格',spec_value:'低',spec_value_id:2},
//     ],
// ];
// console.log(CartesianZ(arr));
