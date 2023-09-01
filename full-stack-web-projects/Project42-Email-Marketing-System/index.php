<?php 
include('config.php'); 
Site::updateUsuarioOnline(); 
Site::contador(); 


Router::get('/',function(){
	echo 'Home!';
});




?>
