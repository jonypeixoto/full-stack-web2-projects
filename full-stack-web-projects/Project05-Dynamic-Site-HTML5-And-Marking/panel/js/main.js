$(function(){
    
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;

    if(windowSize <= 768){
        $('.menu').css('width','0').css('padding','0');
        open = false;
    }

    $('.menu-btn').click(function(){
        if(open){
            // The menu is open, we need to close it and adapt our general dashboard content
            $('.menu').animate({'width':0,'padding':0},function(){
                open = false;
            });
            $('.content,header').css('width','100%');
            $('.content,header').animate({'left':0},function(){
                open = false;
            });
        }else{
            // the menu is closed
            $('.menu').css('display','block');
            $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px'},function(){
                open = true;
            });
            if(windowSize > 768)
            $('.content,header').css('width','calc(100% - 250px)');
            $('.content,header').animate({'left':targetSizeMenu+'px'},function(){
                open = true;
            });
        }
    })

    $(window).resize(function(){
        windowSize = $(window)[0].innerWidth;
        targetSizeMenu = (windowSize <= 400) ? 200 : 250;
        if(windowSize <= 768){
            $('.menu').css('width','0').css('padding','0');
            $('.content,header').css('width','100%').css('left','0');
            open = false;
        }else{
            $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
                open = true;
            });

            $('.content,header').css('width','calc(100% - 250px)');
            $('.content,header').animate({'left':targetSizeMenu+'px'},function(){
            open = true;
            });
        }
    })

    $('[format=date]').mask('99/99/9999');

	$('[actionBtn=delete]').click(function(){
        var txt;
        var r = confirm("Do you want to delete the register?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    })

})