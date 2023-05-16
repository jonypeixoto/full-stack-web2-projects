<!--

EXAMPLE 01: PLUS (+) // ONLY 2 PARAMETERS

/?value1=10&value2=20&signal=plus


USE ON BROWSER: https://localhost/Full-Stack-PROJECTS/Back-End-Projects/Project02-Creating-microservices-using-PHP/03-Creating-calculator-system-by-URL/?value1=10&value2=20&signal=plus


EXAMPLE 02: MINUS (-) // ONLY 2 PARAMETERS

/?value1=10&value2=20&signal=minus

USE ON BROWSER: https://localhost/Full-Stack-PROJECTS/Back-End-Projects/Project02-Creating-microservices-using-PHP/03-Creating-calculator-system-by-URL/?value1=10&value2=20&signal=minus

-->

<!-- EXAMPLE 01 AND EXAMPLE 02 


<?php

    /*

    $value1 = $_GET['value1'];
    $signal = $_GET['signal'];
    $value2 = $_GET['value2'];

    if($signal == 'plus'){
        $result = $value1 + $value2;
    }else if($signal == 'minus'){
        $result = $value1 - $value2;
    }

    echo $result;

    */

?>

-->


<!-- EXAMPLE 03 --> 

<!-- INFINITY PARAMETERS -->

<!-- 

/?value[]=10&value[]=90&value[]=20&signal=plus

https://localhost/Full-Stack-PROJECTS/Back-End-Projects/Project02-Creating-microservices-using-PHP/03-Creating-calculator-system-by-URL/?value[]=10&value[]=90&value[]=20&signal=plus

-->


<?php

    $value = $_GET['value'];
    $signal = $_GET['signal'];

    $result = 0;
    if($signal == 'plus'){
        foreach ($value as $key => $value){
            $result+=$value;
        }
    }else if($signal == 'minus'){
        foreach ($value as $key => $value){
            $result-=$value;
        }
    }

    echo $result;

?>

