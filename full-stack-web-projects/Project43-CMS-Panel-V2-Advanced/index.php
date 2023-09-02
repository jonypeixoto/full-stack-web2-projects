<?php


	$url = @$_GET['url'];

	if($url == ''){
		include('painel.php');
	}else{
			include('TemplateLeitor.php');
		$pdo = new PDO('mysql:host=localhost;dbname=projeto_cms','root','');
		$sql = $pdo->prepare("SELECT * FROM paginas WHERE slug = ?");
		$sql->execute(array($url));
		if($sql->rowCount() >= 1){
			$conteudo = $sql->fetch();
			$contentPagina = file_get_contents('templates/'.$conteudo['template']);
			$fields = TemplateLeitor::pegaCampos($contentPagina,'\{\{!(.*?)\}\}');

			$conteudoFinal = explode('--!--',$conteudo['valores']);
			$contentPagina = str_replace($fields['chave'], $conteudoFinal, $contentPagina);

			echo $contentPagina;

		}else{
			include('painel.php');
		}
	}
?>