<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		$value = 9.99;
		$value = $value*100;

		//https://stripe.com/docs/legacy-checkout/php

	?>
	<form action="process.php" method="POST">
		<input type="hidden" name="amount" value="<?php echo $value; ?>">
	  <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="pk_test_51Jnq9TR50IqLCpVc13k0FvXBDyYi0xKiXnfsL5mvO0CfeJ4AAHdYaVC1K0f6ZpA5QDD3WfMv6Sgw7DKwosv5qvk800Y55f7hMf"
	    data-amount="<?php echo $value; ?>"
	    data-name="CybertimeUP"
	    data-label="Pay with Credit Card"
	    data-description="Payment referring to such and such"
	    data-image="cybertimeup_bg.webp"
	    data-locale="auto"
	    data-currency="eur">
        // Format BR:
	    //data-currency="brl">
        //data-panel-label="Pay"	
	  </script>
	</form>
</body>
</html>