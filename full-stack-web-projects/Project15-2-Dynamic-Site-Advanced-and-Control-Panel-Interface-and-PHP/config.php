<?php

    session_start();
    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/PHPMailerAutoload.php');
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','https://localhost/full-stack-web2-projects/full-stack-projects/Project15-2-Dynamic-Site-Advanced-and-Control-Panel-Interface-and-PHP/');
    define('INCLUDE_PATH_PANEL',INCLUDE_PATH.'panel/');

    
    //Connected with database!
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','project_01');

    //Functions 
    function takeOffice($office){
        $arr = [
        '0' => 'Normal',
        '1' => 'Sub Admin',
        '2' => 'Admin'];

        return $arr[$office];
    }
?>