<?php

    namespace Controllers;
    class HomeController
    {
        public function __construct(){
            $this->view = new \Views\MainView('home');
        }
        public function execute(){
            $this->view->render(array('title'=>'Home'));
        }
    }

?>