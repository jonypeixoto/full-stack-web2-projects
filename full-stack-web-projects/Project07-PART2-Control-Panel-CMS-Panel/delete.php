<?php
	if(isset($_POST['id_member'])){
	    $pdo = new PDO('mysql:host=localhost;dbname=bootstrap_cms_project07','root','');
        $sql = $pdo->prepare("DELETE FROM `tb_team` WHERE id = ?");
	    $sql->execute(array($_POST['id_member']));
	}
?>


