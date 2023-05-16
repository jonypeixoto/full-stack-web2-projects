<?php
	include('config.php');
	if(isset($accessToken)){


		if(isset($_SESSION['facebook_access_token'])){
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}else{
			$_SESSION['facebook_access_token'] = (string)$accessToken;
			$oAuth2Client = $fb->getOAuth2Client();
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
			$_SESSION['facebook_access_token'] = (string)$longLivedAccessToken;
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}

		if(isset($_GET['code'])){
			header('Location: ./');
		}

		try{
			$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
			$fbUserProfile = $profileRequest->getGraphNode()->asArray();
		}catch(FacebookResponseException $e){}

		//print_r($fbUserProfile);

		$fbUserData = [
			'oauth_provider' => 'facebook',
			'oauth_uid'=>$fbUserProfile['id'],
			'first_name'=>$fbUserProfile['first_name'],
			'last_name'=>$fbUserProfile['last_name'],
			'email'=>$fbUserProfile['email'],
			'imagem'=>$fbUserProfile['picture']['url']
		];

		$userData = $fbUserData;

		$_SESSION['userData'] = $fbUserData;

		$logoutUrl = $helper->getLogoutUrl($accessToken, $redirectUrl.'logout.php');

		if(!empty($userData)){
			$output = '';
			$output.="<h1>Nome: $userData[first_name]</h1>";
			$output.="<h1>Sobrenome: $userData[last_name]</h1>";
			$output.="<h1>E-mail: $userData[email]</h1>";
			$output.='<br /><img src="'.$userData['imagem'].'" />';
			$output.='<br /><a href="'.$logoutUrl.'">loggout</a>';
		}else{
			$output = '<h1 style="color:red">Ocorreu um erro!</h1>';
		}

	}else{
		$loginUrl = $helper->getLoginUrl($redirectUrl,$fbPermission);
		$output = '<a href="'.$loginUrl.'">Fazer login com facebook PHP</a>';
	}

	echo $output;
?>
