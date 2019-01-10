/**********************************省市区联动*************************************/
$('body').on('change','#consigneePr',function(){
    var province_id = $('#consigneePr').val();
    var city_default = '<option value="">请选择城市</option>';
    $.post(
        '?r=desktop/region/child',
        {'region_id':province_id,'_csrf':$('.request-csrf').val()},
        function (result) {
            $('#consigneeCity').html(city_default+result);
            $('#area_id').html('<option value="">请选择地区</option>');
        }
    );
});

$('body').on('change','#consigneeCity',function(){
    var city_id = $('#consigneeCity').val();
    var area_default = '<option value="">请选择地区</option>';
    $.post(
        '?r=desktop/region/child',
        {'region_id':city_id,'_csrf':$('.request-csrf').val()},
        function (result) {
            $('#area_id').html(area_default + result);
        }
    );
});