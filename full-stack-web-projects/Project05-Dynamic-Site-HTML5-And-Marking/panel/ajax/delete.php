<?php
    include('../../includeConstants.php');
    /**/
    $data['success'] = true;
    $data['message'] = "";

    if(Panel::logged() == false){
        die("You are not logged in!");
    }

    echo 'ok just delete now the id!'.$_POST['id'];

?>