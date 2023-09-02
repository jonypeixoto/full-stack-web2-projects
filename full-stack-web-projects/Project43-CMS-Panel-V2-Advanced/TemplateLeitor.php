<?php
	/**
	 * 
	 */
	class TemplateLeitor
	{
		
		public static function pegaCampos($string,$leitor){
			$campos = preg_match_all('/'.$leitor.'/', $string, $matches);

			$fields['chave'] = array();
			$fields['campo'] = array();

			foreach ($matches[0] as $key => $value) {
				$fields['chave'][] = $value;
			}

			foreach ($matches[1] as $key => $value) {
				$fields['campo'][] = $value;
			}

			return $fields;
		}
		
	}
?>