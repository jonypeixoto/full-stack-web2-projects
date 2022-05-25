<?php
    namespace Models;

    class ContactModel{

        public static function sendForm(){
            $mail = new \Email('mail.jonypeixoto.com','contact@jonypeixoto.com','dd@FD{rVpw[K','Jony');
            $mail->addAdress('contact@jonypeixoto.com','Jony');
            $mail->formatEmail(array('subject'=>'Site message','body'=>'Here it is a site message!'));
            $mail->sendEmail();
        }
    }
?>

