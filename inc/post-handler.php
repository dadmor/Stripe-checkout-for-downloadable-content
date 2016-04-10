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
		    $yourfile = "../download/test.zip";

		    $file_name = basename($yourfile);

		    header("Content-Type: application/zip");
		    header("Content-Disposition: attachment; filename=$file_name");
		    header("Content-Length: " . filesize($yourfile));

		    readfile($yourfile);
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