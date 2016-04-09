<?php 
$_stripe_seccret_key = "sk_test_AylHsIQMTRhRU6jyfaGfdsD0";
echo '<pre>';
print_r( $_POST );
echo '</pre>';

if ( $_POST  ) {

	$_POST['street'] = 'streetowa 10';
    $_POST['city'] = 'Koszalin';
    $_POST['state'] = 'ZE';
    $_POST['zip'] = '23-233';

	Stripe::setApiKey($_stripe_seccret_key);
		$error = '';
		$success = '';
		try {			
			//if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
			//throw new Exception("Fill out all required fields.");
			if ( !isset($_POST['stripeToken']) )
			throw new Exception("The Stripe Token was not generated correctly");
			Stripe_Charge::create(array("amount" => 3000,
			"currency" => "eur",
			"card" => $_POST['stripeToken'],
			"description" => $_POST['stripeEmail']));
			$success = '<div class="alert alert-success">
			<strong>Success!</strong> Your payment was successful.
			</div>';
			print_r($success);
		}
		catch (Exception $e) {			
			$error = '<div class="alert alert-danger">
			<strong>Error!</strong> '.$e->getMessage().'
			</div>';
			print_r($error);
		}
	
	

}
?>