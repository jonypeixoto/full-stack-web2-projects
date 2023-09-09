<?php 
include('config.php'); 
Site::updateUsuarioOnline(); 
Site::contador(); 

$homeController = new controller\homeController();
$aulaController = new controller\aulaController();

Router::get('/',function() use ($homeController){
	$homeController->index();
});

Router::get('/aula/?',function($arg) use ($aulaController){
	$aulaController->index($arg);
});




?>
