<?php 
	$pdo = new PDO('mysql:host=localhost;dbname=relatorios', 'root', '');
	$info = $pdo->prepare("SELECT * FROM `tb.relatorio`");
	$info->execute();
	$info = $info->fetchAll();
	die(json_encode($info));
?>