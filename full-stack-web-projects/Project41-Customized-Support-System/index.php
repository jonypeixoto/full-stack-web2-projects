<?php
	define('HOST','localhost');
	define('DATABASE','suporte_personalizado');
	define('USER','root');
	define('PASSWORD','');

	define('BASE','http://localhost/sistema_suporte/');


	//Load composer's autoloader
	require 'vendor/autoload.php';

	$autoload = function($class){
		include($class.'.php');
	};

	spl_autoload_register($autoload);

	$homeController = new \controllers\homeController();
	$chamadoController = new \controllers\chamadoController();

	$adminController = new \controllers\adminController();

	Router::get('/',function() use ($homeController){
		$homeController->index();
	});

	Router::get('/chamado',function() use ($chamadoController){
		if(isset($_GET['token'])){
			if($chamadoController->existeToken()){
				//O token existe, vamos renderizar o chamado!
				$info = $chamadoController->getPergunta($_GET['token']);
				$chamadoController->index($info);
			}else{
				die('O token está setado, porém não existe!');
			}
		}else{
			die('Apenas com o token do chamado para você conseguir interagir!');
		}
		
	});

	Router::get('/admin',function() use ($adminController){
		$adminController->index();
	});


?>