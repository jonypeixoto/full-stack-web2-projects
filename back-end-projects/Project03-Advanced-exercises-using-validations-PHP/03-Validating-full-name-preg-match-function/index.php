<?php

    //Validating Full Name!
    //FORMAT: Xxxxxxxx Xxxxxxxx

    if(isset($_POST['action'])){
        $name = $_POST['name'];
        $verify = preg_match('/^[A-Z]{1}[a-z]{1,} [A-Z]{1}[a-z]{1,}$/', $name);
        if($verify)
            echo 'Success!';
        else
            echo 'Error';
    }

?>

<form method="post">
    <input placeholder="Enter the full name!" type="text" name="name">
    <input type="submit" name="action" value="Send!">
</form>
