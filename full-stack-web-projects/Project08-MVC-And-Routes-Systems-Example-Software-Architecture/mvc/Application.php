<?php

    define('INCLUDE_PATH','https://localhost/Full-Stack-PROJECTS/Full-Stack-Projects/Projecy08-MVC-And-Routes-Systems-Example-Software-Architecture/mvc/');
    define('INCLUDE_PATH_FULL','https://localhost/Full-Stack-PROJECTS/Full-Stack-Projects/Projecy08-MVC-And-Routes-Systems-Example-Software-Architecture/mvc/Views/pages/');
    class Application
    {
        public function execute(){
            $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
            
            $url = ucfirst($url);
            $url.="Controller";
            // Main - Dynamic Loading
            if(file_exists('Controllers/'.$url.'.php')){
                $className = 'Controllers\\'.$url;
                $controler = new $className;
                $controler->execute();
            }else{
                die("There is no such controller!");
            }
            //
        }
    }

?>