<?php
    session_start();
    date_default_timezone_set('Europe/London');
    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/PHPMailerAutoLoad.php');
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://localhost/Full-Stack-PROJECTS/Full-Stack-Projects/Project05-Dynamic-Site-HTML5-And-Marking/');
    define('INCLUDE_PATH_PANEL',INCLUDE_PATH.'panel/');

    define('BASE_DIR_PANEL',__DIR__.'/panel');
    // Connect with database!
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','project_01');

    // Constants for the control panel 
    define('NAME_COMPANY','CybertimeUP');
?>