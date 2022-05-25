<?php
	date_default_timezone_set('America/Sao_Paulo');
	$pdo = new PDO('mysql:host=localhost;dbname=system','root','');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking System</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Lato";
	}

	body{
		background: rgb(225,225,225);
	}

	header{
		padding: 10px 0;
		background: #333;
		color: white;
	}

	nav.menu ul{
		list-style-type: none;
	}

	nav.menu li{
		display: inline-block;
		padding: 0 8px;
	}

	nav.menu a{
		color: white;
		text-decoration: none;
	}
	.logo{
		float: left;
	}

	.clear{clear: both;}

	nav.menu{
		position: relative;
		top:4px;
		float: right;
	}

	.center{
		max-width: 1100px;
		margin: 0 auto;
		padding: 0 2%;
	}

	section.booking{
		padding: 40px 0;
		text-align: center;
	}

	section.booking select{
		width: 100%;
		height: 30px;
		border: 1px solid #ccc;
	}

	section.booking input[type=text]{
		width: 100%;
		height: 30px;
		padding-left: 7px;
		margin-bottom: 10px;
	}

	section.booking input[type=submit]{
		background: #4286f4;
		width: 200px;
		height: 30px;
		border: 0;
		cursor: pointer;
		color: white;
		font-size: 19px;
		font-weight: bold;
		margin-top: 10px;
	}

	.success{
		width: 100%;
		margin:10px 0;
		padding: 8px 15px;
		color: #3c763d;
		background: #dff0d8;
	}
</style>
<body>
	<header>
		<div class="center">
		<div class="logo">
			<h2>CybertimeUP</h2>
		</div>

		<nav class="menu">
			<ul>
				<li><a href="">Bookings</a></li>
				<li><a href="">About</a></li>
				<li><a href="">Contact</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="booking">
		<div class="center">
			<?php
				if(isset($_POST['action'])){
					//I want to do a booking!
					$name = $_POST['name'];
					$dateHour = $_POST['dateHour'];
					$date = DateTime::createFromFormat('d/m/Y H:i:s', $dateHour);
					$dateHour =  $date->format('Y-m-d H:i:s');
					$sql = $pdo->prepare("INSERT INTO `tb_scheduled` VALUES (null,?,?)");
					$sql->execute(array($name,$dateHour));
					echo '<div class="success">Your time has been successfully booked!</div>';
				}
			?>
			<form method="post">
				<input type="text" name="name" placeholder="Your name...">
				<select name="dateHour">
					<?php
						for($i = 0; $i <= 23; $i++){
							$hour = $i;
							if($i < 10){
								$hour = '0'.$hour;
							}

							$hour.=':00:00';

							$check = date('Y-m-d').' '.$hour;
							$sql = $pdo->prepare("SELECT * FROM `tb_scheduled` WHERE hour = '$check'");
							$sql->execute();

							if($sql->rowCount() == 0 && strtotime($check) > time()){
								$dateHour = date('d/m/Y').' '.$hour;
								echo '<option value="'.$dateHour.'">'.$dateHour.'</option>';
							}
						}
					?>


				</select>
				<input type="submit" name="action" value="Send!">
			</form>
		</div>
	</section>
</body>
</html>