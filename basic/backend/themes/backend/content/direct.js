//验证表单
validate(
    {
        'Direct[direct_name]':{'required':true},
        'Direct[video_id]':{'required':true, min:1}
    },
    {
        'Direct[direct_name]':{'required':'名称不能为空'},
        'Direct[video_id]':{'required':'视频不能为空','min':'视频不能为空'}
    }
);

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