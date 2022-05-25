<?php
    // INSERT when you put ONLINE in the SERVER:

    /*

    obs_start();

    */

    include('../config.php');

    if(Panel::logged() == false){
        include('login.php');
    }else{
        include('main.php');
    }

    // INSERT when you put ONLINE in the SERVER:

    /*

    obs_end_flush();

    */
?>