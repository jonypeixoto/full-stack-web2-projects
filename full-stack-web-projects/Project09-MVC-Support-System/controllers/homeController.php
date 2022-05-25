<?php

    namespace controllers;

    class homeController
    {
        public function index(){
            \views\mainView::render('home');
        }
    }

?>