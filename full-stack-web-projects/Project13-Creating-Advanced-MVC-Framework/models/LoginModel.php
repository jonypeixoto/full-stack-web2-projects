<?php
	namespace models;

	class LoginModel extends Model
	{
		public $login = 'admin';
		public $password = '123';

		public function validateLogin($login,$password){
			if($login == $this->login && $password == $this->password)
			{
				return true;
			}else{
				return false;
			}
		}
		
	}
?>
