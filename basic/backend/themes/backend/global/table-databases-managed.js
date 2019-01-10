var table = $('#table');
table.find('.group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).prop("checked", true);
        } else {
            $(this).prop("checked", false);
        }
    });
    jQuery.uniform.update(set);
});

//表单滚动
function scoll()
{
    var table = $('#table');
    table.dataTable({
        ordering: false,
        searching: false,
        bLengthChange:false,
        scroller:       true,
        deferRender:    true,
        scrollX:        true,
        scrollCollapse: true,
        bInfo:          false,
        sScrollX: "100%",
        sScrollXInner: "100%",
        bScrollCollapse: true,
        "language": {
            "lengthMenu": " _MENU_ 记录",
            "sSearch":"搜索:",
            "sInfo":"显示 _START_ 到 _END_ 总计 _TOTAL_ 条记录",
            "sInfoEmpty":"显示 0 到 0 总计 0 条记录",
            "sEmptyTable":"当前表格没有数据"
        },
    });
}

//表单分页
function tableShow(obj)
{
    obj.dataTable({
        "lengthMenu": [
            [5,15, 20, -1],
            [5,15, 20, "所有"] // change per page values here
        ],
        "pageLength": 5,

        "language": {
            "lengthMenu": " _MENU_ 记录",
            "sSearch":"搜索:",
            "sInfo":"显示 _START_ 到 _END_ 总计 _TOTAL_ 条记录",
            "sInfoEmpty":"显示 0 到 0 总计 0 条记录",
            "sEmptyTable":"当前表格没有数据"
        },
        "columnDefs": [{ // set default column settings
            'orderable': true,
            'targets': [0]
        }, {
            "searchable": true,
            "targets": [0]
        }],
        "order": [
            [2, "asc"]
        ]
    });
}