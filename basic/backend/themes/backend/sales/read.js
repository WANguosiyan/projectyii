$(document).on('click','.read', function () {
   var _this = $(this);
   $.get(_this.attr('data-url'), {}, function (data) {
       if(data.code == 200){
           alert(data.msg);
           _this.remove();
       }else{
           alert(data.msg);
       }
   }, 'json');
});