//代码验证
validate(
    {
        'Video[video_name]':{required: true},
        'Video[cat_id]':{required: true, min:1},
        'Video[p_order]':{required: true}
    },
    {
        'Video[video_name]':{'required': '名称不能为空'},
        'Video[cat_id]':{'required': '分类不能为空', 'min':'分类不能为空'},
        'Video[p_order]':{'required': '排序不能为空'}
    }
);

$("#input-2").fileinput({
    uploadAsync:false,
    showPreview:false,
    dropZoneEnabled:false,
    uploadUrl:'?r=content/tengxun/import&name=logo',
    maxFileCount: 1
}).on("fileuploaded", function (event, data, previewId, index) {
    alert(data.response.code);
    if(data.response.code == 200) {
        alert('上传成功');
    }
});

// $("#input-3").fileinput({
//     uploadAsync:true,
//     dropZoneEnabled:false,
//     uploadUrl:'?r=content/video/upload&name=src_middle',
//     maxFileCount: 1
// }).on("fileuploaded", function (event, data, previewId, index) {
//     if (data.response.code == 200) {
//         $("#file_src_middle").val(data.response.data.img_url);
//     }
// });
//
// $("#input-4").fileinput({
//     uploadAsync:true,
//     dropZoneEnabled:false,
//     uploadUrl:'?r=content/video/upload&name=src_small',
//     maxFileCount: 1
// }).on("fileuploaded", function (event, data, previewId, index) {
//     if (data.response.code == 200) {
//         $("#file_src_small").val(data.response.data.img_url);
//     }
// });

//视频选择
$('.video-change').change(function(){
    var val = $(this).val();
    var url = $(this).find('option:selected').attr('data-url');
    var title = '';

    if ($('.video-'+val).val() != 0) {
        $(this).val(0);
        if (val == 1) title = '超清';
        else if (val == 2) title = '标清';
        else title = '急速';
        alert(title+'已经选择，请先置空'+title);

        return false;
    }
    if ($('.video-change-1:selected').val() != 'undefined') {
        $('.video-1').val($('.video-change-1:selected').attr('data-url'));
    }
    if ($('.video-change-2:selected').val() != 'undefined') {
        $('.video-2').val($('.video-change-2:selected').attr('data-url'));
    }
    if ($('.video-change-3:selected').val() != 'undefined') {
        $('.video-3').val($('.video-change-3:selected').attr('data-url'));
    }
});