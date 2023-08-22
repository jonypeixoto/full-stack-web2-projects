<?php
	define('INCLUDE_PATH','http://localhost/forum/');
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','forum');

	$autoload = function($class){
		include('classes/'.$class.'.php');
	};
	spl_autoload_register($autoload);
?>