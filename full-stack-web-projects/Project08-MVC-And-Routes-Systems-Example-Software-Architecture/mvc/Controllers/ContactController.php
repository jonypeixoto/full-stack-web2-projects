<?php

    namespace Controllers;

    class ContactController extends Controller
    {

        public function execute(){
            if(isset($_POST['action'])){
                \Models\ContactModel::sendForm();
                echo '<script>location.href="'.INCLUDE_PATH.'contact/success"</script>';
                die();
            }

            \Router::route('contact/success',function(){
                $this->view = new \Views\MainView('contact-success');
                $this->view->render(array('title'=>'Contact'));
            });

            \Router::route('contact',function(){
                $this->view = new \Views\MainView('contact');
                $this->view->render(array('title'=>'Contact'));
            });

        }
    }

?>