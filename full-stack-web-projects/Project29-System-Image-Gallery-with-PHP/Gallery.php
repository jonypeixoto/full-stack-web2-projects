<?php 

	class Gallery{
		private $images = array('img1.png', 'img2.jpg', 'img3.png');

		public function getCurrentPicture(){
			$current = isset($_GET['image']) ? (int)$_GET['image'] : 0;
			if($current < 0){
				$current = 0;
			}
			if($current >= count($this->images)){
				$current = count($this->images) - 1;
			}
			return $this->images[$current];
		}

		public function getPrevPictureIndex(){
			$current = isset($_GET['image']) ? (int)$_GET['image'] : 0;
			$current--;
			if($current < 0){
				$current = 0;
			}
			return '?image='.$current;
		}

		public function getNextPictureIndex(){
			$current = isset($_GET['image']) ? (int)$_GET['image'] : 0;
			$current++;
			if($current >= count($this->images)){
				$current = count($this->images) -1;
			}
			return '?image='.$current;
		}
	}
?>