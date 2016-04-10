<?php 
require_once( 'stripe-lbraries/Stripe.php' );

/* Your Secret Api key copy from your stripe user account */
$_stripe_seccret_key = "sk_test_AylHsIQMTRhRU6jyfaGfdsD0";


if ( $_POST  ) {

	Stripe::setApiKey($_stripe_seccret_key);
		$error = '';
		$success = '';
		try {			
			
			Stripe_Charge::create(array("amount" => 3000,
			"currency" => "eur",
			"card" => $_POST['stripeToken'],
			"description" => $_POST['stripeEmail']));
			
			$success = '<div class="alert alert-success">
			<strong>Success!</strong> Your payment was successful.
			</div>';
			print_r($success);

		    /* START FORCED DOWNLOAD YOUR FILE */
		    $file_url = "../stripe-download/wp-dashboard-mockups.zip";
		    //$file_url = basename($file_url);
		    header("Content-disposition: attachment; filename=$file_url");
  			header("Content-type: application/zip");
			readfile($file_url);
		    exit;

		}
		catch (Exception $e) {			
			$error = '<div class="alert alert-danger">
			<strong>Error!</strong> '.$e->getMessage().'
			</div>';
			print_r($error);
		}
}
?>