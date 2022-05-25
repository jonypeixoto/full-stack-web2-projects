<?php
	include('../config.php');
	$data = array();
	$subject = 'New message of the site!';
	$body = '';
	foreach ($_POST as $key => $value) {
		$body.=ucfirst($key).": ".$value;
		$body.="<hr>";
	}
	$info = array('subject'=>$subject,'body'=>$body);
	$mail = new Email('mail.cybertimeup.com','tests@cybertimeup.com','8k8)FSxLDKXP','Jony');
	$mail->addAdress('tests@cybertimeup.com','Jony');
	$mail->formatEmail($info);
	if($mail->sendEmail()){ 
		$data['success'] = true;
	}else{
		$data['error'] = true;
	}

	//$data['return'] = 'success';

	die(json_encode($data));
?>
