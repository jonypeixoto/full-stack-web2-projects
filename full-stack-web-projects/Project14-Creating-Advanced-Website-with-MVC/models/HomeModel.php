<?php
	namespace models;
	class HomeModel extends Model
	{

        // Here is the method to pull in customers!
		public static function takeCustomers(){
		$customers = \MySql::connect()->prepare("SELECT * FROM customers");
		$customers->execute();


		return $customers->fetchAll();
		}
		
	}
?>
