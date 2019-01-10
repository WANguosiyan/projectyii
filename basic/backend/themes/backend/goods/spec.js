validate(
    {
        'Spec[spec_name]':{'required':true},
        'Spec[p_order]':{'required':true,min:1}
    },
    {
        'Spec[spec_name]':{'required':'规格名称不能为空'},
        'Spec[p_order]':{'required':'排序不能为空','min':'排序至少为1'}
    }
);

//关联商品
$('.goods').on('click', function(){
    var obj = $(this);
    var spec_id = obj.attr('data-id');
    var spec_name = obj.parent().next().html();
    App.blockUI({
        target: 'body',
        animate: true
    });
    $.post(
        '?r=goods/spec/goods',
        {'spec_id':spec_id,'_csrf':$('.request-csrf').val()},
        function (msg) {
            App.unblockUI('body');
            bootbox.dialog({
                message: msg,
                title: spec_name+"-关联商品",
                buttons: {
                    main: {
                        label: "关闭",
                        className: "blue",
                        callback: function() {

                        }
                    }
                }
            });
        }
    );
});

var TableDatatablesEditable = function () {
    var spec_id = $('.spec-id').val();
    var handleTable = function () {
        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow, valueId) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var p_order = aData[2]==""?99:aData[2];
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + p_order + '">';
            jqTds[3].innerHTML = '<a class="edit btn btn-sm blue" data-id="'+valueId+'" href="">保存</a><a class="cancel btn btn-sm yellow" data-id="'+valueId+'" href="">取消</a>';
        }

        function saveRow(oTable, nRow, valueId) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit btn btn-sm blue" data-id="'+valueId+'" href="">编辑</a><a class="delete btn btn-sm red" data-id="'+valueId+'" href="">删除</a>', nRow, 3, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit btn btn-sm blue" href="">编辑</a>', nRow, 3, false);
            oTable.fnDraw();
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({
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

        var tableWrapper = $("#sample_editable_1_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow, 0);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            var value_id = $(this).attr('data-id');
            e.preventDefault();

            if (confirm("确定要删除当前记录 ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];

            $.post(
                '?r=goods/specvalue/delete&spec_value_id='+value_id,
                {
                    '_csrf':$('.request-csrf').val()
                },
                function (res) {
                    if (res.code == 200) oTable.fnDeleteRow(nRow);
                    else alert(res.msg);
                },'json'
            );
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //关联商品
        table.on('click', '.spec-goods', function(){
            var obj = $(this);
            var spec_value_id = obj.attr('data-id');
            App.blockUI({
                target: 'body',
                animate: true
            });
            $.post(
                '?r=goods/specvalue/goods',
                {'spec_value_id':spec_value_id,'_csrf':$('.request-csrf').val()},
                function (msg) {
                    App.unblockUI('body');
                    bootbox.dialog({
                        message: msg,
                        title: "规格值-关联商品",
                        buttons: {
                            main: {
                                label: "关闭",
                                className: "blue",
                                callback: function() {

                                }
                            }
                        }
                    });
                }
            );
            return false;
        });

        table.on('click', '.edit', function (e) {
            var value_id = $(this).attr('data-id');
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow, value_id);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "保存") {
                /* Editing this row and want to save it */
                var jqInputs = $('input', nEditing);
                //保存数据
                if (value_id == 0) {
                    $.post(
                        '?r=goods/specvalue/create',
                        {
                            'spec_id':spec_id,
                            'spec_value':jqInputs[0].value,
                            'alias':jqInputs[1].value,
                            'p_order':jqInputs[2].value,
                            '_csrf':$('.request-csrf').val()
                        },
                        function (res) {
                            if (res.code == 200) saveRow(oTable, nRow, 1);
                            else alert(res.msg);
                        },'json'
                    );
                } else {
                    $.post(
                        '?r=goods/specvalue/update&spec_value_id='+value_id,
                        {
                            'spec_value':jqInputs[0].value,
                            'alias':jqInputs[1].value,
                            'p_order':jqInputs[2].value,
                            '_csrf':$('.request-csrf').val()
                        },
                        function (res) {
                            if (res.code == 200) saveRow(oTable, nRow, 1);
                            else alert(res.msg);
                        },'json'
                    );
                }

                nEditing = null;
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow, value_id);
                nEditing = nRow;
            }
        });
    }
    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});