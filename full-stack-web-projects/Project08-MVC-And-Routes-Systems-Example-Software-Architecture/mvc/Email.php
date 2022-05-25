<?php
	
	class Email
	{
		
		private $mailer;

		public function __construct($host,$username,$password,$name)
		{
			
			$this->mailer = new PHPMailer;

			$this->mailer->isSMTP();                                      // Set mailer to use SMTP
			$this->mailer->Host = $host;  				  // Specify main and backup SMTP servers
			$this->mailer->SMTPAuth = true;                               // Enable SMTP authentication
			$this->mailer->Username = $username;                 // SMTP username
			$this->mailer->Password = $password;                           // SMTP password
			$this->mailer->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$this->mailer->Port = 465;                                    // TCP port to connect to

			$this->mailer->setFrom($username,$name);
			$this->mailer->isHTML(true);                                  // Set email format to HTML
			$this->mailer->CharSet = 'UTF-8';


		}

		public function addAdress($email,$name){
			$this->mailer->addAddress($email,$name);
		}

		public function formatEmail($info){
			$this->mailer->Subject = $info['subject'];
			$this->mailer->Body    = $info['body'];
			$this->mailer->AltBody = strip_tags($info['body']);
		}

		public function sendEmail(){
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}

	}
?>