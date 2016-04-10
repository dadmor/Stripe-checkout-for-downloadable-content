<?php 
require_once( '../config.php' );
require_once( '../lib/Stripe.php' );

$_stripe_seccret_key = "sk_test_AylHsIQMTRhRU6jyfaGfdsD0";

echo '<pre>';
print_r( $_POST );
echo '</pre>';

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





		    // DOWNLOAD
		    $file_url = "../download/test.zip";

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