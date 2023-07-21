<?php
	

	class deliveryController
	{
		
		public function index(){
			$url = (isset($_GET['url'])) ? $_GET['url'] : 'home';
			$slug = explode('/',$url)[0];

			if(file_exists('views/'.$slug.'.php')){
				include('views/'.$slug.'.php');
				//print_r($_SESSION['carrinho']);
				$this->validarCarrinho();
			}else{
				die('Não existe a página que você procura!');
			}

		}

		public function validarCarrinho(){
			if(isset($_GET['addCart'])){
				$idProduto = (int)$_GET['addCart'];
				deliveryModel::addToCart($idProduto);
				echo '<script>alert("O produto foi adicionado ao carrinho!")</script>';
			}
		}
		
	}

?>