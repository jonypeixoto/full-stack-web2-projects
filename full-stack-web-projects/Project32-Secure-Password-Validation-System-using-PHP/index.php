<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post">
		<input type="password" name="password">
		<input type="submit" name="action" value="Send">
	</form>
	<?php 
		if(isset($_POST['action'])){
			$password = $_POST['password'];
			if(preg_match('/^[A-Z]{1}[a-z]{3}[0-9]{3,}$/', $password)){
				echo '<h1>Your password has been successfully reset!</h1>';
			}else{
				echo '<h1>Your password must have at least one uppercase character, two normal characters and at least 3 numbers.</h1>';
			}
		}

	?>

</body>
</html>