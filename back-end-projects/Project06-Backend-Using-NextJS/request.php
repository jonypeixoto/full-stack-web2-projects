<?php
    include('phpmailer/PHPMailerAutoload.php');
    include('Mail.php');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Header: Content-Type");

    $data = json_decode(file_get_contents('php://input'), true);

    $mail = new Mail(array("subject"=>'Hello cybertimeup',"content"=>'Here it is my email of welcome.'));

    $mail->addAdress('jonypeixotooriginal@gmail.com','jony');

    $mail->sendMail();

    die(json_encode($data));
?>