<?php 
	require('vendor/autoload.php');

	//https://dashboard.stripe.com/test/apikeys

    $stripe = [
        "secret_key"      => "sk_test_51Jnq9TR50IqLCpVcCvSAWXaUtj4aAaZYZSlDYZOlKjNErHtG7uMaMx84z5R2cM5oTMQUCDHhmS1rTZYoyjyJCuxC00PV5mW2OV",
        "publishable_key" => "pk_test_51Jnq9TR50IqLCpVc13k0FvXBDyYi0xKiXnfsL5mvO0CfeJ4AAHdYaVC1K0f6ZpA5QDD3WfMv6Sgw7DKwosv5qvk800Y55f7hMf",
        ];

    \Stripe\Stripe::setApiKey($stripe['secret_key']);
    ?>

	$token  = $_POST['stripeToken'];
  	$email  = $_POST['stripeEmail'];

  	$customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  	]);

  	$charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $_POST['amount'],
      'currency' => 'eur',
  	]);

  	echo '<h1>Payment made successfully!</h1>';

?>