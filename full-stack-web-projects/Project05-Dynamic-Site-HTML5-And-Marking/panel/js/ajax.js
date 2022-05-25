$(function(){
    $('.ajax').ajaxForm({
        dataType:'json',
        beforeSend:function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('input[type=submit]').attr('disabled','true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('input[type=submit]').removeAttr('disabled');
            $('.box-alert').remove();
            if(data.success){
                $('.ajax').prepend('<div class="box-alert success"><i class="fa fa-check"></i> The customer has been successfully entered!</div>');
                $('.ajax')[0].reset();
            }else{
                $('.ajax').prepend('<div class="box-alert error"><i class="fa fa-times"></i> '+data.message+'</b></div>');
            }
        }
    })
})