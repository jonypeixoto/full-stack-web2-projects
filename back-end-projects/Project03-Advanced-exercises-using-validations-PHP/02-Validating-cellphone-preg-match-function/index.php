<?php

    //Validating Cellphone!
    //FORMAT: (99)99999-9999

    if(isset($_POST['action'])){
        $cellphone = $_POST['cellphone'];
        $verify = preg_match('/^\(([0-9]{2}\)|)[0-9]{5}-[0-9]{4}$/', $cellphone);
        if($verify)
            echo 'Success!';
        else
            echo 'Error';
    }

?>

<form method="post">
    <input placeholder="Enter the cellphone!" type="text" name="cellphone">
    <input type="submit" name="action" value="Send!">
</form>
