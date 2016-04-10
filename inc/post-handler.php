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

		    //$file_url = basename($yourfile);

		    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
			    header('Content-Type: "application/octet-stream"');
			    header('Content-Disposition: attachment; filename="'.basename($file_url).'"');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header("Content-Transfer-Encoding: binary");
			    header('Pragma: public');
			    header("Content-Length: ".filesize($file_url));
			} else {
			    header('Content-Type: "application/octet-stream"');
			    header('Content-Disposition: attachment; filename="'.basename($file_url).'"');
			    header("Content-Transfer-Encoding: binary");
			    header('Expires: 0');
			    header('Pragma: no-cache');
			    header("Content-Length: ".filesize($file_url));
			}
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