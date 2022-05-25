<?php

    class Application{

        const DEFAULT = 'Login';

        public function run(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                $class = 'controllers\\'.ucfirst($url[0]).'Controller';
            }else{
                $class = 'controllers\\'.self::DEFAULT.'Controller';
                $url[0] = self::DEFAULT;
            }

            $view = 'views\\'.ucfirst($url[0]).'View';
            $model = 'models\\'.ucfirst($url[0]).'Model';

            $controller = new $class(new $view, new $model);
            $controller->index();
        }       
    }

?>