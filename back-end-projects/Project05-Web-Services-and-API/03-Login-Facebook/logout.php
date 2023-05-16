<?php
    include('config.php');
    unset($_SESSION['facebook_access_token']);
    unset($_SESSION['userData']);
    session_destroy();
    header('Location: index.php');
?>