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

	
	.success{
		width: 100%;
		margin:10px 0;
		padding: 8px 15px;
		color: #3c763d;
		background: #dff0d8;
	}

	section.schedules{
		padding: 30px 0;

	}

	.box-single-hour{
		float: left;
		width: 33.3%;
	
		padding: 10px;
	}
	.box-single-wraper{
		padding: 10px;
		background: white;
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
				<li><a href="">Current Bookings</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="schedules">
		<div class="center">

			<?php
				if(isset($_GET['delete'])){
					$id = (int)$_GET['delete'];
					$pdo->exec("DELETE FROM `tb_scheduled` WHERE id = $id");
					echo '<div class="success">The schedule was successfully deleted!</div>';
				}
				$info = $pdo->prepare("SELECT * FROM `tb_scheduled`");
				$info->execute();
				$info = $info->fetchAll();
				foreach ($info as $key => $value) {
			?>
			<div class="box-single-hour">
				<div class="box-single-wraper">
					Name: <?php echo $value['name'] ?><br />
					Date and Hour: <?php echo date('d/m/Y H:i:s',strtotime($value['hour'])); ?>
					<br />
					<a href="?delete=<?php echo $value['id']; ?>">Delete!</a>
				</div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</section>

	
		</div>
	</section>
</body>
</html>