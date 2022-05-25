$(function(){

    var current = -1;
    var maximum = $('.box-hardskill').length - 1;
    var timer;
    var animationDelay = 3;

    executeAnimation();
    function executeAnimation(){
        $('.box-hardskill').hide();
        timer = setInterval(logicAnimation,animationDelay*1000);

        function logicAnimation(){
            current++; 
            if(current > maximum){
                clearInterval(timer);
                return false;
            }

            //alert('Calling interval');

            $('.box-hardskill').eq(current).fadeIn();
        }
    }

})