<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<style type="text/css">
	input,textarea{
		width: 100%;
	}
	textarea{
		height: 120px;
	}
</style>

<?php

	if(isset($_POST['action'])){
		$email = $_POST['email'];
		$question = $_POST['question'];
		$token = md5(uniqid());
		$sql = \MySql::connect()->prepare("INSERT INTO calls VALUES (null,?,?,?)");
		$sql->execute(array($email,$question,$token));
		//Email the user saying the ticket has been opened.
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.cybertimeup.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@cybertimeup.com';                     //SMTP username
            $mail->Password   = 'L)eR8f8k56_O';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('contact@cybertimeup.com', 'Jony');
            $mail->addAddress('$email', '');     
        
            //Content
            $mail->isHTML(true);   
            $mail->charSet = "UTF-8";                              
            $mail->Subject = 'Ticket openned!';
            $url = BASE.'calls?token='.$token;
            $information = '
            Hello, your ticket has been created successfully!<br />Use the link below to interact:<br />
            <a href="'.$url.'">Access ticket!</a>
            ';
            $mail->Body    = $information;
        
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        /*End of email sending*/
		echo '<script>alert("Seu chamado foi aberto com sucesso! Você receberá no e-mail as informações para interagir.")</script>';
	}

?>
<h2>Open called!</h2>
<form method="post">
    <input type="email" name="email" placeholder="Your e-mail...">
    <br />
    <br />
    <textarea name="question" placeholder="What is your question?"></textarea>
    <br />
    <br />
    <input type="submit" name="action" value="Send!">
</form>
</body>
</html>