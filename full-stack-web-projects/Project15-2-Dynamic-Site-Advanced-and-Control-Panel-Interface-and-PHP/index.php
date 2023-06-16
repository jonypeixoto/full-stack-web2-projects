<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Project Dynamic Site Advanced</title>
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>style/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>style/style.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="keywords,of,my,website">
	<meta name="description" content="Description of my website">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
	<meta charset="utf-8" />
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'testimonials':
				echo '<target target="testimonials" />';
				break;
			
			case 'services':
				echo '<target target="services" />';
				break;

	
		}
	?>
	<div class="success">Form sent sucessfully!</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
	</div><!--overlay-loading-->

	<header>
		<div class="center">
			<div class="logo left"><a href="/">Logo</a></div><!--logo-->
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>testimonials">Testimonials</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>services">Services</a></li>
					<li><a realtime="contact" href="<?php echo INCLUDE_PATH; ?>contact">Contact</a></li>
					<li><a realtime="other-menu" href="<?php echo INCLUDE_PATH; ?>other-menu">Other menu</a></li>
				</ul>
			</nav>
			 <nav class="mobile right">
				<div class="button-menu-mobile">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>testimonials">Testimonials</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>services">Services</a></li>
					<li><a realtime="contact" href="<?php echo INCLUDE_PATH; ?>contact">Contact</a></li>
					<li><a realtime="other-menu" href="<?php echo INCLUDE_PATH; ?>other-menu">Other menu</a></li>
				</ul>
			</nav>
		<div class="clear"></div><!--clear-->
		</div><!--center-->
	</header>

	<div class="container-principal">
	<?php

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			// We can do something, because the page does not exist.
			if($url != 'testimonials' && $url != 'services'){
				$page404 = true;
				include('pages/404.php');
			}else{
				include('pages/home.php');
			}
		}

	?>

	</div><!--container-principal-->

	<footer <?php if(isset($page404) && $page404 == true) echo 'class="fixed"'; ?>>
		<div class="center">
			<p>All rights reserved!</p>
		</div>
	</footer>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<?php
		if($url == 'home' || $url == ''){
	?> 
	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
	<?php } ?>
	<?php
		if($url == 'contact'){
	?> 
	<?php } ?>
	<!-- <script src="<?php echo INCLUDE_PATH; ?> js/exemplo.js"></script>-->
	<script src="<?php echo INCLUDE_PATH; ?>js/forms.js"></script>
</body>
</html>
