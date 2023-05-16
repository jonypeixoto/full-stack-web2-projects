<?php

    session_start();

    include('facebook-php-sdk/autoload.php');
    use Facebook\Facebook;
    use Facebook\Exceptions\FacebookResponseException;
    use Facebbok\Exceptions\FacebookSDKException;

    $appId = '3943998805706238';
    $appSecret = '830dd532edfb1d606e38c77f4d981ee5';
    $redirectUrl = 'http://localhost/Full-Stack-PROJECTS/Back-End-Projects/Web-Services-and-API/03-Login-Facebook/';
    $fbPermission = array('email');

    $fb = new Facebook(array(
        'app_id'=> $appId,
        'app_secret'=> $appSecret,
        'default_graph_version' => 'v2.2'
    ));

    $helper = $fb->getRedirectLoginHelper();

    try{
        if(isset($_SESSION['facebook_access_token'])){
            $accessToken = $_SESSION['facebook_access_token'];
        }else{
            $accessToken = $helper->getAccessToken();
        }
    }catch(FacebookResponseException $e){};

?>