<h2>I'm on my home page!</h2>
<ul>
<?php
	$customers = \Models\HomeModel::takeCustomers();
	foreach ($customers as $value) {

?>
	<li><?php echo $value['name']; ?></li>
<?php
	}
?>

</ul>