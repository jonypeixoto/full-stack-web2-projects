<?php include('TemplateLeitor.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Painel CMS Avançado 2.0</title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<header>
		<div class="center">
		<div class="logo"><a href="">Painel CMS</a></div>

		<div class="menu">
			<a href="">Cadastrar Página</a>
			<a href="">Listar Páginas</a>
		</div><!--menu-->

		<div class="clear"></div>

	</div>
	</header>
	<br />
	<div class="main">
		<div class="center">
			<?php
				if(isset($_POST['acao'])){
					$nomeArquivo = $_POST['nome_arquivo'];
					$nomePagina = $_POST['nome_pagina'];
					$conteudoPagina = '';
					foreach ($_POST as $key => $value) {
						if($key != 'acao' && $key != 'nome_arquivo' && $key != 'nome_pagina'){
							$conteudoPagina.=$value;
							$conteudoPagina.="--!--";
						}
					}

						$pdo = new PDO('mysql:host=localhost;dbname=projeto_cms','root','');
						$exec = $pdo->prepare("INSERT INTO paginas VALUES (null,?,?,?)");
						$exec->execute(array($nomePagina,$nomeArquivo,$conteudoPagina));
						echo '<script>alert("Sua página foi salva com sucesso!")</script>';
					
				}
			?>
			<?php
				if(!isset($_POST['etapa_2'])){
			?>
			<form method="post">
				<select name="arquivo">
					<?php
						$files = glob("templates/*.html");
						foreach ($files as $key => $value) {
							$files = explode('/', $value);
							$fileName = $files[count($files)-1];
							echo '<option value="'.$fileName.'">'.$fileName.'</option>';
						}
					?>
				</select>
				<input type="text" name="nome_pagina" placeholder="Nome da sua página...">
				<input type="submit" name="etapa_2" value="Próxima Etapa!">
			</form>
			<?php
				}else{
				$nomeArquivo = $_POST['arquivo'];
				$nomePagina = $_POST['nome_pagina'];

				//Pegamos os dados do arquivo e calculamos quantos campos tem para serem substituidos!

				$getContent = file_get_contents('templates/'.$nomeArquivo);

				$fields = TemplateLeitor::pegaCampos($getContent,'\{\{!(.*?)\}\}');
			?>

			<h2>Editando página: <?php echo $nomePagina ?> | Arquivo Base: <?php echo $nomeArquivo ?></h2>

			<form method="post">
				<?php
					for($i =0; $i < count($fields['chave']); $i++){
						echo '<input type="text" name="'.$fields['campo'][$i].'"  placeholder="'.$fields['campo'][$i].'" />';
						echo '<hr>';
					}
				?>
				<input type="hidden" name="nome_pagina" value="<?php echo $nomePagina; ?>">
				<input type="hidden" name="nome_arquivo" value="<?php echo $nomeArquivo; ?>">
				<input type="submit" name="acao" value="Salvar!">
			</form>

		<?php } ?>
		</div><!--center-->
	</div><!--main-->

</body>
</html>