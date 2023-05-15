<?php
    session_start();
    require('vendor/autoload.php');
    $gClient = new Google_Client();

    $gClient->setClientId("862548120500-4hc7h7d6k304qtkdb0823jpsrcdmo340.apps.googleusercontent.com");
    $gClient->setClientSecret("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");

    $gClient->setRedirectUri('https://localhost/full-stack-web2-projects/back-end-projects/Project05-Web-Services-and-API/09-Login-with-Google-Auth/');

    $gClient->addScope('email');

    if(!isset($_GET['code'])){
        // We need log in.
        echo '<a href="'.$gClient->createAuthUrl().'">Log in with your Google account!</a>';
    }else{
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

        if(!isset($token['error'])){
            $gClient->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($gClient);

			$data = $google_service->userinfo->get();
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }

?>
