/**规格管理的js
 * Created by farewell on 2018/1/21.
 */

var params_manage = {

    //初始化
    init:function(){
        var val_input_count = $('.val_input').length;
        this.rule_index = val_input_count; //初始化 val_input的数量统计
        this.bindEvent();
    },

    //绑定事件
    bindEvent:function(){
        $('#rule_val_add').click($.proxy(this.clickRuleValAddbtn,this));
        $('form').on('click','.rule_val_del',$.proxy(this.clickRuleValDelBtn,this));

        //表单验证事件的添加
        this.formValidate();

        //编辑时候的validate的input值的验证添加
        this.initValInputValidate();
    },

    //点击添加规格值的按钮
    clickRuleValAddbtn : function(e){
        var target = $(e.target),
            _this  = this;
        this.rule_index++;
        var rule_val_html = '<div class="form-group">'+
            '<label for="rule-value-input" class="col-sm-2 control-label">参数值<span class="required">*</span></label>'+
            '<div class="col-sm-5">'+
            '<input id="value_input'+this.rule_index+'" name="Val[val_name][]" type="text" class="form-control val_input" id="rule-value-input" placeholder="">'+
            '</div>'+

            '<div class="col-sm-2">'+
            '<input id="value_order'+this.rule_index+'"name="Val[p_order][]" type="text" class="form-control">'+
            '</div>'+
            '<div class="col-sm-2">'+
            '<span class="btn btn-danger rule_val_del">删除</span>'+
            '</div>'+
            '</div>';

        $(rule_val_html).insertBefore('#add_rule_val_btn_container');

        // $('[name="Val[val_name][]"]').each(function(){
        //     console.log(1);
        //     $(this).rules("add", {
        //         required: true,
        //         messages: {
        //             required: "值不能为空"
        //         }
        //     });
        // });
    },

    //点击删除规格值按钮触发的事件
    clickRuleValDelBtn : function(e){
        var target = $(e.target),
            _this  = this;
        target.closest('.form-group').remove();
    },

    //表单验证
    formValidate : function(){
        validate(
            {
                'Rule[spec_name]':{'required':true},
                'Val[val_name][]':{'required':true},
                'Rule[p_order]':{'required':true},
                'Val[p_order][]':{'required':true},
            },
            {
                'Rule[spec_name]':{'required':'参数名称不能为空'},
                'Val[val_name][]':{'required':'值不能为空'},
                'Rule[p_order]':{'required':'参数的排序不能为空'},
                'Val[p_order][]':{'required':'参数值的排序不能为空'},
            }
        );
    },

    //初始化已经存在的Input的验证
    initValInputValidate : function(){
        var that = this;

        //给值的input添加验证规则
        $('.val_input').each(function(k,v){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "值不能为空"
                }
            });
        });

        //给值排序的input添加验证规则
        $('.order_input').each(function(k,v){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "值排序不能为空"
                }
            });
        })
    },
};

params_manage.init();