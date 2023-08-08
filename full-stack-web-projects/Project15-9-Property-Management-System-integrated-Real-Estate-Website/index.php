<?php 
include('config.php'); 
Site::updateOnlineUser(); 
Site::counter(); 

$homeController = new controller\homeController();
$enterpriseController = new controller\enterpriseController();

Router::get('/',function() use ($homeController){
    $homeController->index();
});

Router::get('/?',function($par) use ($enterpriseController){
    $enterpriseController->index($par);
});

?>
