<?php 
include('config.php'); 
Site::updateOnlineUser(); 
Site::counter(); 

$homeController = new controller\homeController();

Router::get('/',function() use ($homeController){
    $homeController->index();
});

?>
