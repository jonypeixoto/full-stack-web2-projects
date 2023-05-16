<?php

    //Validating CEP!
    //FORMAT: 21321-234

    if(isset($_POST['action'])){
        $cep = $_POST['cep'];
        $verify = preg_match('/[0-9]{5}-[0-9]{3}$/', $cep);
        if($verify)
            echo 'Success!';
        else
            echo 'INVALID CEP';
    }

?>

<form method="post">
    <input placeholder="Enter the zip code!" type="text" name="cep">
    <input type="submit" name="action" value="Send!">
</form>
