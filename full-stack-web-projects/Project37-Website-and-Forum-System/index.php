<?php
	include('config.php');


	$forumController = new \controladores\forumController();


	//Listagem dos foruns
	Router::get('/',function() use ($forumController){
		$forumController->home();
	});

	//Listagem dos topicos.

	Router::get('/?',function($arr) use ($forumController){
		$forumController->topicos($arr[1]);
	});

	//Topico/Post single

	Router::get('/?/?',function($arr) use ($forumController){
		$forumController->postSingle($arr);
	});


	if(Router::isExecuted() == false){
		die('Não existe!');
	}
?>