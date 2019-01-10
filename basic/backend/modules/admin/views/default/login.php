<?php
\app\backend\components\AppAsset::addScript($this, $js);
\app\backend\components\AppAsset::addStyle($this, $css);
?>
<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="?r=admin/default/login" method="post" novalidate="novalidate">
    <h3 class="form-title font-green">后台登录</h3>
    <div class="alert alert-danger display-hide" style="display: <?php echo !empty($error)?'block':'none';?>" >
        <button class="close" data-close="alert"></button>
        <span> <?php echo !empty($error)?$error:'请输入用户名和密码';?> </span>
    </div>
    <? //fengjunqiang 2018-11-15 去掉默认的登录账号密码 ?>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">用户名</label>
        <input class="form-control form-control-solid placeholder-no-fix" value=""
               type="text" autocomplete="off" placeholder="用户名" name="User[name]" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">密码</label>
        <input class="form-control form-control-solid placeholder-no-fix" value=""
               type="password" autocomplete="off" placeholder="密码" name="User[password]" /> </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-4 col-md-9">
                <button type="submit" class="btn green uppercase submit">登录</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
</form>
<!-- END LOGIN FORM -->
<script>
    function getUrl(name) {
        //获取url方法 编辑传来的参数
        //之前decodeURI是用的unescape() 有时候会取汉字乱码
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return decodeURI(r[2]);
        return null;
    }
    window.onload = function(){
        var login = {
            init:function(){
              this.bindEvents();
            },
            bindEvents:function(){
                $('.submit').on('click',this.login);
            },
            login:function(e){
                e.preventDefault();
                var act = getUrl('action');
                var action = $('form').attr('action');
                action = action + '&action=' + act;

                $('form').attr('action',action);
                $('form').submit();
            }
        };
        login.init();
    }

</script>
