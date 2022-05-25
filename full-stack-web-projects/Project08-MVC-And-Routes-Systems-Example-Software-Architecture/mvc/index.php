<?php

    /*
    
    MVC

    M = Model 
    V = View 
    C = Controller 

    Example

    Contact Page

    Contact Controller => General Controller. It can run the model and the view.
    Contact View => Responsible for rendering the page.
    Contact Model => Where you have all the necessary functions.
    
    */

    $autoload = function($class){
        if($class == 'Email'){
            include('phpmailer/PHPMailerAutoload.php');
        }
        include($class.'.php');
    };

    spl_autoload_register($autoload);

    $app = new Application();
    $app->execute();


?>