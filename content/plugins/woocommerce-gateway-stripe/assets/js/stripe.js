Stripe.setPublishableKey( wc_stripe_params.key );

jQuery( function() {

	/* Checkout Form */
	jQuery('form.checkout').on('checkout_place_order_stripe', function( event ) {
		return stripeFormHandler();
	});

	/* Pay Page Form */
	jQuery('form#order_review').submit(function(){
		return stripeFormHandler();
	});

	/* Both Forms */
	jQuery("form.checkout, form#order_review").on('change', '.card-number, .card-cvc, .card-expiry-month, .card-expiry-year, input[name=stripe_customer_id]', function( event ) {
		jQuery('.woocommerce_error, .woocommerce-error, .woocommerce-message, .woocommerce_message, .stripe_token').remove();
		jQuery('.stripe_token').remove();
	});

	/* Open and close */
	jQuery("form.checkout, form#order_review").on('change', 'input[name=stripe_customer_id]', function() {

		if ( jQuery('input[name=stripe_customer_id]:checked').val() == 'new' ) {

			jQuery('div.stripe_new_card').slideDown( 200 );

		} else {

			jQuery('div.stripe_new_card').slideUp( 200 );

		}

	} );

} );

function stripeFormHandler() {
	if ( jQuery('#payment_method_stripe').is(':checked') && ( jQuery('input[name=stripe_customer_id]:checked').size() == 0 || jQuery('input[name=stripe_customer_id]:checked').val() == 'new' ) ) {
		if ( jQuery( 'input.stripe_token' ).size() == 0 ) {

			var card 	= jQuery('.card-number').val();
			var cvc 	= jQuery('.card-cvc').val();
			var month	= jQuery('.card-expiry-month').val();
			var year	= jQuery('.card-expiry-year').val();
			var $form = jQuery("form.checkout, form#order_review");

			$form.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6}});

			var data = {
				number:    card,
				cvc:       cvc,
				exp_month: month,
				exp_year:  year,
			};

			if ( jQuery('#billing_first_name').size() > 0 ) {
				data.name = jQuery('#billing_first_name').val() + ' ' + jQuery('#billing_last_name').val();
			} else if ( wc_stripe_params.billing_first_name ) {
				data.name = wc_stripe_params.billing_first_name + ' ' + wc_stripe_params.billing_last_name;
			}

			if ( jQuery('#billing_address_1').size() > 0 ) {
				data.address_line1   = jQuery('#billing_address_1').val();
				data.address_line2   = jQuery('#billing_address_2').val();
				data.address_state   = jQuery('#billing_state').val();
				data.address_city    = jQuery('#billing_city').val();
				data.address_zip     = jQuery('#billing_postcode').val();
				data.address_country = jQuery('#billing_country').val();
			} else if ( data.address_line1 ) {
				data.address_line1   = wc_stripe_params.billing_address_1;
				data.address_line2   = wc_stripe_params.billing_address_2;
				data.address_state   = wc_stripe_params.billing_state;
				data.address_city    = wc_stripe_params.billing_city;
				data.address_zip     = wc_stripe_params.billing_postcode;
				data.address_country = wc_stripe_params.billing_country;
			}


			Stripe.createToken( data, stripeResponseHandler );

			// Prevent form submitting
			return false;

		}

	}

	return true;

}

function stripeResponseHandler( status, response ) {

    var $form = jQuery("form.checkout, form#order_review");

    if ( response.error ) {

        // show the errors on the form
        jQuery('.woocommerce_error, .woocommerce-error, .woocommerce-message, .woocommerce_message, .stripe_token').remove();
        jQuery('.card-number').closest('p').before( '<ul class="woocommerce_error woocommerce-error"><li>' + response.error.message + '</li></ul>' );
        $form.unblock();

    } else {

        // token contains id, last4, and card type
        var token = response['id'];

        // insert the token into the form so it gets submitted to the server
        $form.append("<input type='hidden' class='stripe_token' name='stripe_token' value='" + token + "'/>");
        $form.submit();
    }
}