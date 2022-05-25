<?php

    namespace Controllers;
    class AboutController extends Controller
    {
        public function __construct(){
            $this->view = new \Views\MainView('about');
        }

        public function execute(){
            $this->view->render(array('title'=>'About'));
        }
    }

?>