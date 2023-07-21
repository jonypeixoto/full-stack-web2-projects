<?php
	session_start();
	require('deliveryController.php');
	require('deliveryModel.php');

	define('INCLUDE_PATH','http://localhost/full-stack-web2-projects/full-stack-projects/Project23-Delivery-System/');

	$deliveryController = new deliveryController();

	$deliveryController->index();

?>