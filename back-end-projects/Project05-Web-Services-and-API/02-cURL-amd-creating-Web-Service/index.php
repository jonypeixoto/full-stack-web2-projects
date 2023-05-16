<?php
    $address = urlencode('miami');
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL,"http://maps.googleapis.com/maps/api/geocode/json?address=$address");
    //curl_setopt($curl, CURLOPT_POST, 1);
    
    // In real life you should use something like:
   
       // curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query(array()));

    // 
    
    // Receive server response ...

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($curl);
        
        curl_close($curl);

        echo $server_output;

    //    

    //cURL request on local server

    /*

    $result = json_decode($server_output);

    echo $result->title[0];
    echo '<br />';
    echo $result->content[0];

    */

    //



?>
