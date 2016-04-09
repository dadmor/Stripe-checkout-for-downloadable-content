angular.module('hakaToRun', ['ngMaterial'])

	.controller('mainController', function($scope, $http) {

		var select = $(".card-expiry-year"),
        year = new Date().getFullYear();

        for (var i = 0; i < 12; i++) {
            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
        }

        $(document).on('submit', '#payment-form', function(event) {
			
        	event.preventDefault();

        	Stripe.card.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val(),
				name: $('.card-holder-name').val(),
				address_line1: $('.address').val(),
				address_city: $('.city').val(),
				address_zip: $('.zip').val(),
				address_state: $('.state').val(),
				address_country: $('.country').val()
            }, stripeResponseHandler);

		});

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