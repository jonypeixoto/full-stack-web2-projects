<?php

    namespace views;

    class mainView{
        public static function render($file){
            include('pages/'.$file.'.php');
        }
    }

?>