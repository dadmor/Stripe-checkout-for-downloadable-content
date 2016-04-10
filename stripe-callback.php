<?php 
require_once( 'stripe-lbraries/Stripe.php' );

/* Your Secret Api key copy from your stripe user account */
$_stripe_seccret_key = "sk_test_AylHsIQMTRhRU6jyfaGfdsD0";
$_price_to_verify = 2900;
$_currency = "eur";

if ( $_POST  ) {

	Stripe::setApiKey($_stripe_seccret_key);
		$error = '';
		$success = '';
		try {			
			
			Stripe_Charge::create(array("amount" => $_price_to_verify,
			"currency" => $_currency,
			"card" => $_POST['stripeToken'],
			"description" => $_POST['stripeEmail']));
			
			$success = '<div class="alert alert-success">
			<strong>Success!</strong> Your payment was successful.
			</div>';			

		    /* START FORCED DOWNLOAD YOUR FILE */
		    $file_url = "stripe-download/wp-dashboard-mockups.zip";
		    $file_name = basename($file_url);
		    header("Content-disposition: attachment; filename=$file_name");
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