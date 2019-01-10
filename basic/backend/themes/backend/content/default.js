//验证表单
validate(
    {
        'Content[content_name]':{'required':true},
        'Content[cat_id]':{'required':true, min:1}
    },
    {
        'Content[content_name]':{'required':'名称不能为空'},
        'Content[cat_id]':{'required':'栏目不能为空','min':'栏目不能为空'}
    }
);

//图文详情
$('.content-detail').click(function(){
    var obj_b = $(this);
    var content_id = obj_b.attr('data-id');
    var obj = $('.show-'+content_id);
    var open = obj.parent().attr('data-open');

    if (open == 'false') {
        if (obj.attr('data-show') == 'false') {
            App.blockUI({
                target: '#portlet',
                animate: true
            });

            $.post(
                '?r=content/default/detail',
                {'content_id':content_id, '_csrf':$('.request-csrf').val()},
                function (res) {
                    App.unblockUI('#portlet');
                    obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
                    obj.html(res).attr('data-show', 'true');
                    obj.parent().show().attr('data-open', 'true');
                }
            );
        } else {
            obj_b.removeClass('btn-success').addClass('btn-danger').text('关闭详情');
            obj.parent().show().attr('data-open', 'true');
        }
    } else {
        obj.parent().hide().attr('data-open', 'false');
        obj_b.removeClass('btn-danger').addClass('btn-success').text('查看详情');
    }
});


//详细编辑
if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400,
    });
}

/**
 * 商品选择
 */
$('.goods-select').on('click', function(){
    var goods_id = new Array();
    $('.goods-content-id').each(function (i) {
        goods_id[i] = $(this).val();
    });

    $.post(
        '?r=goods/goods/default&goods_id='+goods_id,
        {'selectType':2, '_csrf':$('.request-csrf').val()},
        function (msg) {
            bootbox.dialog({
                message: msg,
                title: "商品价格选择",
                buttons: {
                    success: {
                        label: "确定!",
                        className: "green",
                        callback: function() {
                            var goods_id = '';
                            var data_s = '';
                            var html = '';
                            $('.goods:checked').each(function(){
                                goods_id = $(this).val();
                                data_s = eval("("+$(this).attr('data-s')+")");

                                if (goods_id) {
                                    html += '<tr>' +
                                        '<input type="hidden" name="Goods[]" value="'+goods_id+'" class="goods-content-id"> ' +
                                        '<td><a href="javascript:;" type="button" class="btn btn-sm btn-danger goods-delete">删除</a></td>'+
                                        '<td>'+data_s.name+'</td>' +
                                        '<td>'+data_s.bn+'</td>' +
                                        '<td>'+data_s.brand_name+'</td>' +
                                        '<td>'+data_s.cat_name+'</td>' +
                                        '<td>'+data_s.fav_num+'</td>' +
                                        '</tr>';
                                }
                            });
                            if (html != '') $('.goods-content-list').append(html);
                        }
                    }
                }
            });
        }
    );
});

/**
 * 商品删除
 */
$('.page-container').on('click', '.goods-delete', function(){
    $(this).parent().parent().remove();
});

//上架
$('.content-up').on('click', function(){
    var content_id = new Array();
    $('.checkboxes:checked').each(function(i){
        content_id[i] = $(this).val();
    });

    if (content_id.length == 0) {
        bootbox.alert('没有选中图文');
        return false;
    }

    bootbox.confirm("是否确定上架选中的图文！", function(result) {
        if (result == true) {
            $.post(
                '?r=content/default/up',
                {'content_id':content_id, '_csrf': $('.request-csrf').val()},
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

//下架
$('.content-down').on('click', function(){
    var content_id = new Array();
    $('.checkboxes:checked').each(function(i){
        content_id[i] = $(this).val();
    });

    if (content_id.length == 0) {
        bootbox.alert('没有选中图文');
        return false;
    }

    bootbox.confirm("是否确定下架选中的图文！", function(result) {
        if (result == true) {
            $.post(
                '?r=content/default/down',
                {'content_id':content_id, '_csrf': $('.request-csrf').val()},
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

/**
 * 评论删除
 */
$('body').on('click','.comment-delete',function(){
    var obj = $(this);
    bootbox.confirm("是否确定删除", function(result) {
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
                    if (res.code == 500) {
                        bootbox.alert(res.msg);
                    } else {
                        obj.parent().parent().remove();
                    };
                }, 'json'
            );
        }
    });
});

var maskoffset,
    maskWidth,		//容器宽度
    maskHeight,		//容器高度
    clickX,			//鼠标每次点击的 X 轴坐标
    clickY,			//鼠标每次点击的 Y 轴坐标
    resultX,		//百分比 X 轴坐标
    resultY,		//百分比 X 轴坐标
    clickFlag = true,
    labelFlag = false,
    labelLength = 0,
    labelObj;
var resultX_v , resultY_v;

$(".maskVideo").bind("click",function(e)
{
    var _this = $(this);
    maskWidth = _this.width();
    maskHeight = _this.height();
    maskoffset = _this.offset();

    clickX = (e.pageX - maskoffset.left);
    clickY = (e.pageY - maskoffset.top);

    resultX = ((100 / (maskWidth / clickX)).toFixed(2)) + "%";
    resultY = ((100 / (maskHeight / clickY)).toFixed(2)) + "%";


    resultX_v = ((100 / (maskWidth / clickX)).toFixed(2));
    resultY_v = ((100 / (maskHeight / clickY)).toFixed(2));

    if(labelFlag)
    {
        labelFlag = false;
        labelLength ++;
        _this.append('<img id="lable'+labelLength+'" class="labelPic" src="themes/backend/images/tagLeft.png" style="left:'+ resultX +'; top:'+ resultY +'"/>');
        labelObj = "lable" + labelLength;
        leftTopVal();
    }else if(_this.find("img:visible").length > 0)
    {
        $("#" + labelObj).css({"left":resultX,"top":resultY});
        leftTopVal();
    };
});

//left 和 top值
function leftTopVal()
{
    $(".label2").find(".leftVal").val(resultX_v);
    $(".label2").find(".topVal").val(resultY_v);
};

//确定和修改按钮
// $(".js_true").live("click",function()
// {
//     var _btnthis = $(this);
//     _btnthis.hide();
//     clickFlag = true;
//     _btnthis.parents("tr").find("input").addClass("readonly").attr("readonly",true);
//     $(".maskVideo").find("img").hide();
//     /*if(_btnthis.text() == "确定")
//      {
//      _btnthis.text("修改");
//      clickFlag = true;
//      _btnthis.parents("tr").find("input").addClass("readonly").attr("readonly",true);
//      $(".maskVideo").find("img").hide();
//      }else
//      {
//      _btnthis.text("确定");
//      _btnthis.parents("tr").find("input").removeClass("readonly").attr("readonly",false);
//      };*/
// });

//商品标签
$('#default-goods-label2').on('click', function(){
    if ($('.label2').html()) {
        alert('有数据未保存，不能再添加！');
        return false;
    }
    $.post(
        '?r=content/default/goods',
        {'content_id':$('.content-id').val(), '_csrf':$('.request-csrf').val()},
        function (res) {
            var html = '<tr class="label2">'+
                '<td><a href="javascript:;" data-id="0" project="button" class="btn btn-sm blue edit">保存</a>'+
                '<a href="javascript:;" data-id="0" project="button" class="del btn btn-sm red">删除</a></td>'+
                '<td>'+
                '<div class="col-md-8">'+
                '<input type="text" class="form-control" value="" name="GoodsInfo[goods_id][start_time]">'+
                '</div>'+
                '</td>'+
                '<td>'+
                '<div class="col-md-8">'+
                '<input type="text" class="form-control" value="" name="GoodsInfo[goods_id][end_time]">'+
                '</div>'+
                '</td>'+
                '<td>' +
                '<div class="col-md-8">'+
                res+
                '</div>'+
                '</td>'+
                '<td>'+
                '<div class="col-md-8">'+
                '<input type="text" class="form-control leftVal" value="" name="GoodsInfo[goods_id][label_x]">'+
                '</div>'+
                '</td>'+
                '<td>'+
                '<div class="col-md-8">'+
                '<input type="text" class="form-control topVal" value="" name="GoodsInfo[goods_id][label_y]">'+
                '</div>'+
                '</td>'+
                '</tr>';
            $('.goods-content-list33').append(html);

            clickFlag = false;
            labelFlag = true;
        }
    );
});


//编辑
var table = $('#sample_editable_5');
var nEditing = null;
var nNew = false;

table.on('click', '.edit2', function(){
    var value_id = $(this).attr('data-id');
    var obj = $(this);
    var nRow = $(this).parents('tr')[0];
    clickFlag = false;
    labelFlag = true;
    editRow(obj, value_id);
    nEditing = nRow;
});

//编辑
table.on('click','.edit',function(){
    var value_id = $(this).attr('data-id');
    var obj = $(this);
    var nRow = $(this).parents('tr')[0];
    var obj_tr = $(this).parents('tr').children('td');

    //获取参数
    var start_time = obj_tr.eq(1).find('input').val();
    var end_time = obj_tr.eq(2).find('input').val();
    var label_x = obj_tr.eq(4).find('input').val();
    var label_y = obj_tr.eq(5).find('input').val();

    if (start_time == '') {
        alert('开始时间不能为空');
        return false;
    }
    if (end_time == '') {
        alert('结束时间不能为空');
        return false;
    }
    if (label_x == '') {
        alert('标签X 不能为空');
        return false;
    }
    if (label_y == '') {
        alert('标签Y 不能为空');
        return false;
    }

    if (this.innerHTML == "保存") {
        App.blockUI({
            target: '#portlet',
            animate: true
        });

        var goods_id = obj_tr.eq(3).find('select').val();
        var goods_name = obj_tr.eq(3).find('select :selected').text();


        if (value_id == 0) {
            //保存数据
            $.post(
                '?r=content/default/labelcreate',
                {
                    'content_id':$('.content-id').val(),
                    'start_time':start_time,
                    'end_time':end_time,
                    'goods_id':goods_id,
                    'label_x':label_x,
                    'label_y':label_y,
                    '_csrf':$('.request-csrf').val()
                },
                function (res) {
                    App.unblockUI('#portlet');
                    if (res.code == 200) {
                        alert(res.msg);
                        clickFlag = true;
                        labelFlag = false;
                        restoreRow(obj, goods_name, res.data.id);
                        obj.parent().parent().removeClass('label2');
                    }
                    else alert(res.msg);
                },'json'
            );
        } else {

        }

        nEditing = null;
    } else if (this.innerHTML == "确认") {
        //保存数据
        $.post(
            '?r=content/default/labelupdate',
            {
                'id':value_id,
                'start_time':start_time,
                'end_time':end_time,
                'label_x':label_x,
                'label_y':label_y,
                '_csrf':$('.request-csrf').val()
            },
            function (res) {
                App.unblockUI('#portlet');
                if (res.code == 200) {
                    alert(res.msg);
                    clickFlag = true;
                    labelFlag = false;
                    obj.parent().parent().removeClass('label2');
                    //cancelRow(obj, value_id);
                    cancelRow(obj, value_id);
                }
                else alert(res.msg);
            },'json'
        );
        nEditing = null;
    } else {
        editRow(obj, value_id);
        nEditing = nRow;
    }
});

//取消
table.on('click', '.cancel', function () {
    var value_id = $(this).attr('data-id');
    var obj = $(this);
    cancelRow(obj, value_id);
    nEditing = null;
    return false;
});

//删除
table.on('click', '.del', function (e) {
    var value_id = $(this).attr('data-id');

    if (confirm("确定要移除当前标签 ?") == false) {
        return;
    }

    var obj = $(this);
    if (value_id != 0) {
        $.post(
            '?r=content/default/labeldelete&id='+value_id,
            {
                '_csrf':$('.request-csrf').val()
            },
            function (res) {
                if (res.code == 200) {
                    $('.labelPic').remove();
                    obj.parents('tr').remove();
                }
                else alert(res.msg);
            },'json'
        );
    } else {
        $('.labelPic').remove();
        obj.parents('tr').remove();
    }
});

function restoreRow(obj, goods_name, valueId) {
    obj.parents('tr').children('td').eq(3).html(goods_name);
    var html_e = '<a class="edit2 btn btn-sm blue" data-id="'+valueId+'" href="javascript:;">编辑</a><a class="del btn btn-sm red" data-id="'+valueId+'" href="">删除</a>';
    obj.parent().html(html_e);
}

function editRow(obj, valueId) {
    if ($('.label2').html()) {
        alert('有数据未保存，不能编辑');
        return false;
    }
    var html_e = '<a class="edit btn btn-sm blue" data-id="'+valueId+'" href="javascript:;">确认</a><a class="cancel btn btn-sm yellow" data-id="'+valueId+'" href="">取消</a>';
    obj.parent().parent().addClass('label2');
    obj.parent().html(html_e);
}

function cancelRow(obj, valueId) {
    obj.parent().parent().removeClass('label2');
    clickFlag = true;
    labelFlag = false;
    var html_e = '<a class="edit2 btn btn-sm blue" data-id="'+valueId+'" href="javascript:;">编辑</a><a class="del btn btn-sm red" data-id="'+valueId+'" href="">删除</a>';
    obj.parent().html(html_e);
    $('.labelPic').remove();
}

//截图
window.onload = function(){
    var oImg = document.getElementById("cropTestImg");
    var oEndBtn = document.getElementById("cropEndBtn");
    document.getElementById("cropBeginBtn").onclick = function(){
        fnImageCropRot(oImg);
        oEndBtn.style.display = "inline-block";
    };
    oEndBtn.onclick = function(){
        $('#new_img img').remove();
        //$('#zxxDragBg').remove();
        //$('#zxxCropBox').remove();
        var x = document.getElementById("cropPosX").value, y = document.getElementById("cropPosY").value, w = document.getElementById("cropImageWidth").value, h = document.getElementById("cropImageHeight").value, angle = document.getElementById("zxxRotAngle").value;
        if(angle === ""){
            angle = 0;
        }
        //alert("角度："+angle+"\n剪裁横坐标："+x+"\n剪裁纵坐标："+y+"\n剪裁宽度："+w+"\n剪裁高度："+h);
        $.post(
            '?r=content/default/cropper',
            {
                'file':$('#cropTestImg').attr('data-src'),
                'width':w,
                'height':h,
                'x':x,
                'y':y,
                '_csrf':$('.request-csrf').val()
            },
            function(res) {
                $('#new_img_v').val(res.data.new_img);
                //alert($('#new_img').html());
                $('#new_img').html(
                    '<img src="'+res.data.new_img+'">'
                );
            },'json'
        );
    };
};