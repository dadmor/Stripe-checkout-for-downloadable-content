<?php 
$_stripe_seccret_key = "sk_test_AylHsIQMTRhRU6jyfaGfdsD0";

if ( isset( $_POST ) ) {

	Stripe::setApiKey($_stripe_seccret_key);
		$error = '';
		$success = '';
		try {
			print_r('true');
			//if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
			throw new Exception("Fill out all required fields.");
			if (!isset($_POST['stripeToken']))
			throw new Exception("The Stripe Token was not generated correctly");
			Stripe_Charge::create(array("amount" => 3000,
			"currency" => "eur",
			"card" => $_POST['stripeToken'],
			"description" => $_POST['email']));
			$success = '<div class="alert alert-success">
			<strong>Success!</strong> Your payment was successful.
			</div>';
		}
		catch (Exception $e) {
			print_r('false');
			$error = '<div class="alert alert-danger">
			<strong>Error!</strong> '.$e->getMessage().'
			</div>';
		}
	
	echo '<pre>';
	print_r( $_POST );
	echo '</pre>';

}
?>