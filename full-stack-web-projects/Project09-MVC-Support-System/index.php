<?php
    define('HOST','localhost');
    define('DATABASE','personalized_support');
    define('USER','root');
    define('PASSWORD','');

    define('BASE','http://localhost/Full-Stack-PROJECTS/Full-Stack-Projects/Project09-MVC-Support-System/');

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    $autoload = function($class){
        include($class.'.php');
    };

    spl_autoload_register($autoload);

    $homeController = new \controllers\homeController();

    Router::get('/',function() use ($homeController){
        $homeController->index();
    });

    Router::get('/calls',function() use ($homeController){
        echo '<h2>Visualizing ticket: 00000</h2>';
    });

?>