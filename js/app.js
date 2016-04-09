angular.module('hakaToRun', ['ngMaterial'])

	.controller('mainController', function($scope, $http) {

		var select = $(".card-expiry-year"),
        year = new Date().getFullYear();

        for (var i = 0; i < 12; i++) {
            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
        }

		Stripe.setPublishableKey( config.stripe.test_pub_key );
 
        function stripeResponseHandler(status, response) {
        	console.log(response);
            if (response.error) {
                // re-enable the submit button
                $('.submit-button').removeAttr("disabled");
                // show the errors on the form
                $(".payment-errors").html(response.error.message);
            } else {
                var form$ = $("#payment-form");
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // and submit
                form$.get(0).submit();
            }
        }
		
	});