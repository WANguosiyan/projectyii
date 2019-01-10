//验证
validate(
    {
        'Topic[topic_name]':{'required':true}
    },
    {
        'Topic[topic_name]':{'required':'名称不能为空'}
    }
);

//详细编辑
if ($('#container').val() != undefined) {
    var ue = UE.getEditor('container',{
        initialFrameHeight: 400
    });
}

//上传图片
$("#input-2").on("fileselect", function (event, numFiles, label) {
    $('#logo-preview').remove();
});
$("#input-3").on("fileselect", function (event, numFiles, label) {
    $('#img_url-preview').remove();
});
$("#file-5").on("fileuploaded", function (event, data, previewId, index) {
    if (data.response.code == 200) {
        $('.image-preview').show();

        var html = '<div class="file-preview-frame">'+
            '<img style="width:auto;height:160px;" alt="gongyi06.jpg" title="'+data.response.data.img_url+'" class="file-preview-image" src="'+data.response.data.img_url+'">'+
            '<input type="hidden" value="'+data.response.data.img_url+'" name="Image[]">'+
            '<div class="file-thumbnail-footer">'+
            '<div class="file-actions">'+
            '<div class="file-footer-buttons">'+
            '<button type="button" class="btn btn-sm red-sunglo image-del">删除</button>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>'+
            '</div>'+
            '</div>';
        $('.image-list').append(html);
    }
});

/**
 * 删除图片
 */
$('.image-list').on('click','.image-del', function(){
    $(this).parents('.file-preview-frame').remove();
});