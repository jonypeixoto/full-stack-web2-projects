<?php
	require('vendor/autoload.php');
	use Twilio\Rest\Client;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto SMS</title>
	<meta charset="utf-8">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: verdana;
		}
		body{
			background: rgb(230,230,230);
		}

		section.contato{
			max-width: 700px;
			width: 100%;
			padding: 50px 2%;
			margin: 0 auto;
		}

		input[type=text]{
			width: 100%;
			height: 30px;
			padding-left: 15px;
			font-size: 16px;
		}
		textarea{
			margin-top: 10px;
			width: 100%;
			height: 120px;
			padding:15px;
			font-size: 16px;
		}
		input[type=submit]{
			cursor: pointer;
			border:0;
			color: white;
			background: #4286f4;
			padding: 8px 10px;
		}
	</style>
</head>
<body>
	<?php
		if(isset($_POST['acao'])){
			$numero = $_POST['numero'];
			$body = $_POST['body'];

			if(preg_match('/[0-9]{9,10}/', $numero)){
				if(preg_match('/[a-z0-9]{1,255}/', $body)){

					// Your Account SID and Auth Token from twilio.com/console
					$sid = 'ACce575bfde849e3c03c36fe7334e2f949';
					$token = '903dad8842e557b9b61a1b3b529cc79d';
					$client = new Client($sid, $token);

					// Use the client to do fun stuff like send text messages!
					$client->messages->create(
					    // the number you'd like to send the message to
					    '+55'.$numero,
					    array(
					        // A Twilio phone number you purchased at twilio.com/console
					        'from' => '+16678437375',
					        // the body of the text message you'd like to send
					        'body' => $body
					    )
					);
					echo 'A mensagem foi enviada com sucesso!';
				}else{
					echo 'Mensagem inválida';
				}
			}else{
				echo 'número inválido';
			}
		}
	?>
	<section class="contato">
	<form method="post">
		<input type="text" name="numero" placeholder="Para quem?" />
		<textarea placeholder="Sua SMS..." name="body"></textarea>
		<input type="submit" name="acao" value="Enviar Mensagem!">
	</form>
	</section>
</body>
</html>