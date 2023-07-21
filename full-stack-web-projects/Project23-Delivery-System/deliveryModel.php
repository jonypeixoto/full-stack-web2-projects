<?php
	class deliveryModel{



		public static $items = array(array('sushi1.jpg','20.50','Urumaki'),array('sushi2.jpg','60.00','Hosomaki'),array('sushi3.jpg','100.00','Sashimi'));

		public static function listarItems(){
			return self::$items;
		}

		public static function addToCart($idProduto){
			if(!isset($_SESSION['carrinho'])){
				$_SESSION['carrinho'] = array();
			}
			$_SESSION['carrinho'][] = $idProduto;
		}

		public static function getItemsCart(){
			return $_SESSION['carrinho'];
		}

		public static function getItem($id){
			return self::$items[$id];
		}


		public static function getTotalPedido(){
			$valor = 0;
			foreach ($_SESSION['carrinho'] as $key => $value) {
				$itemPreco = self::getItem($value)[1];
				$valor+=$itemPreco;
			}

			return $valor;
		}

	}

?>