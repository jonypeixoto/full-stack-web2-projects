<!DOCTYPE html>
<html>
<head>
	<title>BG Special Vehicles</title>
	<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" type="image-x/png" href="images/icon-car.ico" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
	<meta charset="utf-8" />
</head>
<body>

<header style="border-bottom: 3px solid #EB2D2D;">
		
		<div class="container">
		<div class="logo">
			<img src="images/logo.jpg" />
		</div><!--logo-->

		<nav class="desktop"> 	
			<ul>
				<li><a href="home">Home</a></li>
				<li><a href="">Gallery</a></li>
				<li><a href="">Events</a></li>
				<li><a href="sale">Sale</a></li>
				<li><a href="about">About</a></li>
				<li><a goto="contact" href="">Contact</a></li>
			</ul>		
		</nav><!--desktop-->

		<nav class="mobile">
			<ul>
				<li><a href="home">Home</a></li>
				<li><a href="">Gallery</a></li>
				<li><a href="">Events</a></li>
				<li><a href="sale">Sale</a></li>
				<li><a href="about">About</a></li>
				<li><a goto="contact" href="">Contact</a></li>
			</ul>
		</nav><!--mobile-->

		<div class="clear"></div><!--clear-->
		</div><!--container-->

</header>

<?php
	if(isset($_GET['url'])){
		if(file_exists($_GET['url']).'.html'){
			include($_GET['url'].'.html');
		}else{
			include('404.html');
		}
	}else{
		include('home.html');
	}
?>

<footer>
	<div class="container">
		<nav>
			<ul>
				<li><a style="color:#EB2D2D;" href="home">Home</a></li>
				<li><a href="">Gallery</a></li>
				<li><a href="">Events</a></li>
				<li><a href="sale">Sale</a></li>
				<li><a href="about">About</a></li>
				<li><a goto="contact" href="">Contact</a></li>
			</ul>
		</nav>
		<p>Copyright © 2021 RM. All rights reserved.</p>
		<div class="clear"></div><!--clear-->
	</div><!--container-->
</footer>
<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>