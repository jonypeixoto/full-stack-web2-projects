<form method="post">
    <input type="text" name="address" />
    <input type="submit" name="action" value="Send" />
</form>

<?php
    if(isset($_POST['action'])){
    $url = urlencode($_POST['address']);
    $str = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$url.'rua%20desembargador%20ferreira%20bastso&sensor=false&key=AIzaSyBD7ZWl-3rVA7JYC8tqzf0VDMdY6KIUQeo');

    $address = json_decode($str);

    /*
    echo '<pre>';
        print_r($address);
    echo '</pre>';
    */

    echo 'Neighborhood name:';
    echo '<br />';
    echo $address->results[0]->address_components[1]->short_name;

    echo '<hr>';

    echo 'Correct street name:';
    echo '<br />';
    echo $address->results[0]->address_components[0]->short_name;
   
    }

?>
