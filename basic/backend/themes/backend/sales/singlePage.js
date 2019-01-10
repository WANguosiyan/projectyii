/**
 * Created by zangmiao on 2016/12/17.
 */
$(document).on('change', '.iocn-select', function () {
    $("#show-png-img").html('<img src="'+PIC_URL+$(this).val()+'" width="100" height="100">');
});