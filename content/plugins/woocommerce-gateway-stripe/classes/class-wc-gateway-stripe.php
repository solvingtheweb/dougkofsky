<?php

/**
 * WC_Gateway_Stripe class.
 *
 * @extends WC_Payment_Gateway
 */
class WC_Gateway_Stripe extends WC_Payment_Gateway {

	function __construct() {
		global $woocommerce;

		$this->id					= 'stripe';
		$this->method_title 		= __('Stripe', 'wc_stripe');
		$this->method_description   = __( 'Stripe works by adding credit card fields on the checkout and then sending the details to Stripe for verification.', 'wc_stripe' );
		$this->has_fields 			= true;
		$this->api_endpoint			= 'https://api.stripe.com/';
		$this->supports 			= array(
			'subscriptions',
			'products',
			'subscription_cancellation',
			'subscription_reactivation',
			'subscription_suspension',
			'subscription_amount_changes',
			'subscription_payment_method_change',
			'subscription_date_changes'
		);

		// Icon
		$icon       = $woocommerce->countries->get_base_country() == 'US' ? 'cards.png' : 'eu_cards.png';
		$this->icon = apply_filters( 'woocommerce_stripe_icon', plugins_url( '/assets/images/' . $icon, dirname( __FILE__ ) ) );

		// Load the form fields
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();

		// Get setting values
		$this->title                 = $this->settings['title'];
		$this->description           = $this->settings['description'];
		$this->enabled               = $this->settings['enabled'];
		$this->testmode              = $this->settings['testmode'];
		$this->capture               = isset( $this->settings['capture'] ) && $this->settings['capture'] == 'no' ? false : true;
		$this->stripe_checkout       = isset( $this->settings['stripe_checkout'] ) && $this->settings['stripe_checkout'] == 'yes' ? true : false;
		$this->stripe_checkout_image = isset( $this->settings['stripe_checkout_image'] ) ? $this->settings['stripe_checkout_image'] : '';

		$this->secret_key            = $this->testmode == 'no' ? $this->settings['secret_key'] : $this->settings['test_secret_key'];
		$this->publishable_key       = $this->testmode == 'no' ? $this->settings['publishable_key'] : $this->settings['test_publishable_key'];

		// Hooks
		add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
		add_action( 'admin_notices', array( $this, 'checks' ) );
		add_action( 'woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
	}

	/**
 	* Check if SSL is enabled and notify the user
 	**/
	function checks() {
     	global $woocommerce;

     	if ( $this->enabled == 'no' )
     		return;

     	// Version check
     	if ( $woocommerce->version < '1.5.8' ) {

	     	echo '<div class="error"><p>' . __('Stripe now uses stripe.js for security and requires WooCommerce 1.5.8. Please update WooCommerce to continue using Stripe.', 'wc_stripe' ) . '</p></div>';

	     	return;
     	}

     	// Check required fields
     	if ( ! $this->secret_key ) {

	     	echo '<div class="error"><p>' . sprintf( __('Stripe error: Please enter your secret key <a href="%s">here</a>', 'wc_stripe'), admin_url('admin.php?page=woocommerce&tab=payment_gateways&subtab=gateway-stripe' ) ) . '</p></div>';

	     	return;

     	} elseif ( ! $this->publishable_key ) {

     		echo '<div class="error"><p>' . sprintf( __('Stripe error: Please enter your publishable key <a href="%s">here</a>', 'wc_stripe'), admin_url('admin.php?page=woocommerce&tab=payment_gateways&subtab=gateway-stripe' ) ) . '</p></div>';

     		return;
     	}

     	// Simple check for duplicate keys
     	if ( $this->secret_key == $this->publishable_key ) {

	     	echo '<div class="error"><p>' . sprintf( __('Stripe error: Your secret and publishable keys match. Please check and re-enter.', 'wc_stripe'), admin_url('admin.php?page=woocommerce&tab=payment_gateways&subtab=gateway-stripe' ) ) . '</p></div>';

	     	return;
     	}

     	// Show message if enabled and FORCE SSL is disabled and WordpressHTTPS plugin is not detected
		if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'no' && ! class_exists( 'WordPressHTTPS' ) ) {

			echo '<div class="error"><p>' . sprintf( __('Stripe is enabled, but the <a href="%s">force SSL option</a> is disabled; your checkout may not be secure! Please enable SSL and ensure your server has a valid SSL certificate - Stripe will only work in test mode.', 'wc_stripe'), admin_url('admin.php?page=woocommerce' ) ) . '</p></div>';

		}
	}

	/**
     * Check if this gateway is enabled
     */
	function is_available() {
		global $woocommerce;

		if ( $this->enabled == "yes" ) {

			if ( $woocommerce->version < '1.5.8' )
				return false;

			if ( ! is_ssl() && $this->testmode != 'yes' )
				return false;

			// Required fields check
			if ( ! $this->secret_key ) return false;
			if ( ! $this->publishable_key ) return false;

			return true;
		}

		return false;
	}

	/**
     * Initialise Gateway Settings Form Fields
     */
    function init_form_fields() {

    	$this->form_fields = array(
			'enabled' => array(
							'title' => __( 'Enable/Disable', 'wc_stripe' ),
							'label' => __( 'Enable Stripe', 'wc_stripe' ),
							'type' => 'checkbox',
							'description' => '',
							'default' => 'no'
						),
			'title' => array(
							'title' => __( 'Title', 'wc_stripe' ),
							'type' => 'text',
							'description' => __( 'This controls the title which the user sees during checkout.', 'wc_stripe' ),
							'default' => __( 'Credit card (Stripe)', 'wc_stripe' )
						),
			'description' => array(
							'title' => __( 'Description', 'wc_stripe' ),
							'type' => 'textarea',
							'description' => __( 'This controls the description which the user sees during checkout.', 'wc_stripe' ),
							'default' => 'Pay with your credit card via Stripe.'
						),
			'testmode' => array(
							'title' => __( 'Test mode', 'wc_stripe' ),
							'label' => __( 'Enable Test Mode', 'wc_stripe' ),
							'type' => 'checkbox',
							'description' => __( 'Place the payment gateway in test mode using test API keys.', 'wc_stripe' ),
							'default' => 'yes'
						),
			'secret_key' => array(
							'title' => __( 'Secret Key', 'wc_stripe' ),
							'type' => 'text',
							'description' => __( 'Get your API keys from your stripe account.', 'wc_stripe' ),
							'default' => ''
						),
			'publishable_key' => array(
							'title' => __( 'Publishable Key', 'wc_stripe' ),
							'type' => 'text',
							'description' => __( 'Get your API keys from your stripe account.', 'wc_stripe' ),
							'default' => ''
						),
			'test_secret_key' => array(
							'title' => __( 'Test Secret Key', 'wc_stripe' ),
							'type' => 'text',
							'description' => __( 'Get your API keys from your stripe account.', 'wc_stripe' ),
							'default' => ''
						),
			'test_publishable_key' => array(
							'title' => __( 'Test Publishable Key', 'wc_stripe' ),
							'type' => 'text',
							'description' => __( 'Get your API keys from your stripe account.', 'wc_stripe' ),
							'default' => ''
						),
			'capture' => array(
							'title' => __( 'Capture', 'wc_stripe' ),
							'label' => __( 'Capture charge immediately', 'wc_stripe' ),
							'type' => 'checkbox',
							'description' => __( 'Whether or not to immediately capture the charge. When unchecked, the charge issues an authorization and will need to be captured later. Uncaptured charges expire in 7 days.', 'wc_stripe' ),
							'default' => 'yes'
						),
			'stripe_checkout' => array(
							'title' => __( 'Stripe Checkout', 'wc_stripe' ),
							'label' => __( 'Enable Stripe Checkout', 'wc_stripe' ),
							'type' => 'checkbox',
							'description' => __( 'If enabled, this option shows a "pay" button and modal credit card form on the checkout, instead of credit card fields directly on the page.', 'wc_stripe' ),
							'default' => 'no'
						),
			'stripe_checkout_image' => array(
							'title'       => __( 'Stripe Checkout Image', 'wc_stripe' ),
							'description' => __( 'Optionally enter the URL to a 128x128px image of your brand or product. e.g. <code>https://yoursite.com/wp-content/uploads/2013/09/yourimage.jpg</code>', 'wc_stripe' ),
							'type'        => 'text',
							'default'     => ''
						),
			);
    }

	/**
     * Payment form on checkout page
     */
	function payment_fields() {
		global $woocommerce;
		?>
		<fieldset>

			<?php if ( $this->description ) : ?>
				<p><?php echo $this->description; ?>
					<?php if ( $this->testmode == 'yes' ) : ?>
						<?php _e('TEST MODE ENABLED. In test mode, you can use the card number 4242424242424242 with any CVC and a valid expiration date.', 'wc_stripe'); ?>
					<?php endif; ?></p>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && ( $credit_cards = get_user_meta( get_current_user_id(), '_stripe_customer_id', false ) ) ) : ?>
				<p class="form-row form-row-wide">

					<a class="button" style="float:right;" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>#saved-cards"><?php _e( 'Manage cards', 'wc_stripe' ); ?></a>

					<?php foreach ( $credit_cards as $i => $credit_card ) : ?>
						<input type="radio" id="stripe_card_<?php echo $i; ?>" name="stripe_customer_id" style="width:auto;" value="<?php echo $i; ?>" />
						<label style="display:inline;" for="stripe_card_<?php echo $i; ?>"><?php _e( 'Card ending with', 'wc_stripe' ); ?> <?php echo $credit_card['active_card']; ?> (<?php echo $credit_card['exp_month'] . '/' . $credit_card['exp_year'] ?>)</label><br />
					<?php endforeach; ?>

					<input type="radio" id="new" name="stripe_customer_id" style="width:auto;" <?php checked( 1, 1 ) ?> value="new" /> <label style="display:inline;" for="new"><?php _e( 'Use a new credit card', 'wc_stripe' ); ?></label>

				</p>
				<div class="clear"></div>
			<?php endif; ?>

			<div class="stripe_new_card">

				<?php if ( $this->stripe_checkout ) : ?>

					<a id="stripe_payment_button" class="button" href="#"
						data-description=""
						data-amount="<?php echo $woocommerce->cart->total * 100; ?>"
						data-name="<?php echo sprintf( __( '%s', 'woocommerce' ), get_bloginfo( 'name' ) ); ?>"
						data-label="<?php _e( 'Confirm and Pay', 'woocommerce' ); ?>"
						data-currency="<?php echo strtolower( get_woocommerce_currency() ); ?>"
						data-image="<?php echo $this->stripe_checkout_image; ?>"
						><?php _e( 'Enter payment details', 'woocommerce' ); ?></a>

				<?php else : ?>

					<p class="form-row form-row-wide">
						<label for="stripe_cart_number"><?php _e("Credit Card number", 'wc_stripe') ?> <span class="required">*</span></label>
						<input type="text" autocomplete="off" class="input-text card-number" />
					</p>
					<div class="clear"></div>
					<p class="form-row form-row-first">
						<label for="cc-expire-month"><?php _e("Expiration date", 'wc_stripe') ?> <span class="required">*</span></label>
						<select id="cc-expire-month" class="woocommerce-select woocommerce-cc-month card-expiry-month">
							<option value=""><?php _e('Month', 'wc_stripe') ?></option>
							<?php
								$months = array();
								for ($i = 1; $i <= 12; $i++) :
									$timestamp = mktime(0, 0, 0, $i, 1);
									$name = apply_filters('woocommerce_stripe_month_display', date('F', $timestamp), $timestamp);
									$months[date('n', $timestamp)] = $name;
								endfor;
								foreach ($months as $num => $name) printf('<option value="%u">%s</option>', $num, $name);
							?>
						</select>
						<select id="cc-expire-year" class="woocommerce-select woocommerce-cc-year card-expiry-year">
							<option value=""><?php _e('Year', 'wc_stripe') ?></option>
							<?php
								for ($i = date('y'); $i <= date('y') + 15; $i++) printf('<option value="20%u">20%u</option>', $i, $i);
							?>
						</select>
					</p>
					<p class="form-row form-row-last">
						<label for="stripe_card_csc"><?php _e("Card security code", 'wc_stripe') ?> <span class="required">*</span></label>
						<input type="text" id="stripe_card_csc" maxlength="4" style="width:4em;" autocomplete="off" class="input-text card-cvc" />
						<span class="help stripe_card_csc_description"></span>
					</p>
					<div class="clear"></div>

				<?php endif; ?>

			</div>

		</fieldset>
		<?php
	}

	/**
	 * payment_scripts function.
	 *
	 * Outputs scripts used for stripe payment
	 *
	 * @access public
	 */
	function payment_scripts() {

		if ( ! is_checkout() )
			return;

		if ( $this->stripe_checkout ) {

			wp_enqueue_script( 'stripe', 'https://checkout.stripe.com/v2/checkout.js', '', '2.0', true );
			wp_enqueue_script( 'woocommerce_stripe', plugins_url( 'assets/js/stripe_checkout.js', dirname( __FILE__ ) ), array( 'stripe' ), '2.0', true );

		} else {

			wp_enqueue_script( 'stripe', 'https://js.stripe.com/v1/', '', '1.0', true );
			wp_enqueue_script( 'woocommerce_stripe', plugins_url( 'assets/js/stripe.js', dirname( __FILE__ ) ), array( 'stripe' ), '1.0', true );

		}

		$stripe_params = array(
			'key' => $this->publishable_key
		);

		// If we're on the pay page we need to pass stripe.js the address of the order.
		if ( ( function_exists( 'is_checkout_pay_page' ) && is_checkout_pay_page() ) || ( ! function_exists( 'is_checkout_pay_page' ) && is_page( woocommerce_get_page_id( 'pay' ) ) ) ) {
			$order_key = urldecode( $_GET['order'] );
			$order_id = (int) $_GET['order_id'];
			$order = new WC_Order( $order_id );

			if ( $order->id == $order_id && $order->order_key == $order_key ) {
				$stripe_params['billing_first_name'] = $order->billing_first_name;
				$stripe_params['billing_last_name']  = $order->billing_last_name;
				$stripe_params['billing_address_1']  = $order->billing_address_1;
				$stripe_params['billing_address_2']  = $order->billing_address_2;
				$stripe_params['billing_state']      = $order->billing_state;
				$stripe_params['billing_city']       = $order->billing_city;
				$stripe_params['billing_postcode']   = $order->billing_postcode;
				$stripe_params['billing_country']    = $order->billing_country;
			}
		}

		wp_localize_script( 'woocommerce_stripe', 'wc_stripe_params', $stripe_params );
	}

	/**
     * Process the payment
     */
	function process_payment( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		$stripe_token = isset( $_POST['stripe_token'] ) ? woocommerce_clean( $_POST['stripe_token'] ) : '';

		// Use Stripe CURL API for payment
		try {

			$post_data = array();
			$customer_id = 0;

			// Check if paying via customer ID
			if ( isset( $_POST['stripe_customer_id'] ) && $_POST['stripe_customer_id'] !== 'new' && is_user_logged_in() ) {
				$customer_ids = get_user_meta( get_current_user_id(), '_stripe_customer_id', false );

				if ( isset( $customer_ids[ $_POST['stripe_customer_id'] ]['customer_id'] ) )
					$customer_id = $customer_ids[ $_POST['stripe_customer_id'] ]['customer_id'];
				else
					throw new Exception( __( 'Invalid card.', 'wc_stripe' ) );
			}

			// Else, Check token
			elseif ( empty( $stripe_token ) ) {
				$error_msg = __( 'Please make sure your card details have been entered correctly and that your browser supports JavaScript.', 'wc_stripe' );

				if ( $this->testmode == 'yes' )
					$error_msg .= ' ' . __( 'Developers: Please make sure that you\'re including jQuery and there are no JavaScript errors on the page.', 'wc_stripe' );

				throw new Exception( $error_msg );
			}

			// Check amount
			if ( $order->order_total * 100 < 50 )
				throw new Exception( __( 'Minimum order total is 0.50', 'wc_stripe' ) );

			// Save token if logged in
			if ( is_user_logged_in() && ! $customer_id && $stripe_token ) {
				$customer_id = $this->add_customer( $order, $stripe_token );

				if ( is_wp_error( $customer_id ) )
					throw new Exception( $customer_id->get_error_message() );
			}

			// Charge the card OR the customer
			if ( $customer_id )
				$post_data['customer']	= $customer_id;
			else
				$post_data['card']		= $stripe_token;

			// Other charge data
			$post_data['amount']		= $order->order_total * 100; // In cents, minimum amount = 50
			$post_data['currency']		= strtolower( get_woocommerce_currency() );
			$post_data['description']	= sprintf( __( '%s - Order %s', 'wp_stripe' ), esc_html( get_bloginfo( 'name' ) ), $order->get_order_number() );
			$post_data['capture']       = $this->capture ? 'true' : 'false';

			// Make the request
			$response = wp_remote_post( $this->api_endpoint . 'v1/charges', array(
   				'method'		=> 'POST',
   				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( $this->secret_key . ':' )
				),
    			'body' 			=> $post_data,
    			'timeout' 		=> 70,
    			'sslverify' 	=> false,
    			'user-agent' 	=> 'WooCommerce ' . $woocommerce->version
			));

			if ( is_wp_error($response) )
				throw new Exception( __( 'There was a problem connecting to the payment gateway.', 'wc_stripe' ) );

			if( empty( $response['body'] ) )
				throw new Exception( __('Empty response.', 'wc_stripe') );

			$parsed_response = json_decode( $response['body'] );

			// Handle response
			if ( ! empty( $parsed_response->error ) ) {

				throw new Exception( $parsed_response->error->message );

			} elseif ( empty( $parsed_response->id ) ) {

				throw new Exception( __('Invalid response.', 'wc_stripe') );

			} else {

				// Store charge ID
				update_post_meta( $order->id, '_stripe_charge_id', $parsed_response->id );

				// Store other data such as fees
				update_post_meta( $order->id, 'Stripe Payment ID', $parsed_response->id );
				update_post_meta( $order->id, 'Stripe Fee', number_format( $parsed_response->fee / 100, 2, '.', '' ) );
				update_post_meta( $order->id, 'Net Revenue From Stripe', ( $order->order_total - number_format( $parsed_response->fee / 100, 2, ',', '.' ) ) );

				if ( $parsed_response->captured	) {

					// Store captured value
					update_post_meta( $order->id, '_stripe_charge_captured', 'yes' );

					// Payment complete
					$order->payment_complete();

					// Add order note
					$order->add_order_note( sprintf( __('Stripe charge complete (Charge ID: %s)', 'wc_stripe' ), $parsed_response->id ) );

				} else {

					// Store captured value
					update_post_meta( $order->id, '_stripe_charge_captured', 'no' );

					// Mark as on-hold
					$order->update_status( 'on-hold', sprintf( __('Stripe charge authorized (Charge ID: %s). Process order to take payment, or cancel to remove the pre-authorization.', 'wc_stripe' ), $parsed_response->id ) );

					// Reduce stock levels
					$order->reduce_order_stock();

				}

				// Remove cart
				$woocommerce->cart->empty_cart();

				// Return thank you page redirect
				return array(
					'result' 	=> 'success',
					'redirect'	=> $this->get_return_url( $order )
				);
			}

		} catch( Exception $e ) {
			$woocommerce->add_error( $e->getMessage() );
			return;
		}

	}


	/**
	 * add_customer function.
	 *
	 * @access public
	 * @param mixed $stripe_token
	 * @return void
	 */
	function add_customer( $order, $stripe_token ) {

		if ( is_user_logged_in() && $stripe_token ) {
			$response = $this->stripe_request( array(
				'email'       => $order->billing_email,
				'description' => 'Customer: ' . $order->shipping_first_name . ' ' . $order->shipping_last_name,
				'card'        => $stripe_token
			), 'customers' );

			if ( is_wp_error( $response ) ) {
				return $response;
			} else {
				$cards = $response->cards->data;

				if ( isset( $cards[0]->last4 ) )
					add_user_meta( get_current_user_id(), '_stripe_customer_id', array(
						'customer_id' 	=> $response->id,
						'active_card' 	=> $cards[0]->last4,
						'exp_year'		=> $cards[0]->exp_year,
						'exp_month'		=> $cards[0]->exp_month,
					) );

				return $response->id;
			}
		}

	}

	/**
	 * stripe_request function.
	 *
	 * @access public
	 * @param mixed $post_data
	 * @return void
	 */
	function stripe_request( $request, $api = 'charges' ) {
		global $woocommerce;

		$response = wp_remote_post( $this->api_endpoint . 'v1/' . $api, array(
				'method'		=> 'POST',
				'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( $this->secret_key . ':' )
			),
			'body' 			=> $request,
			'timeout' 		=> 70,
			'sslverify' 	=> false,
			'user-agent' 	=> 'WooCommerce ' . $woocommerce->version
		));

		if ( is_wp_error($response) )
			return new WP_Error( 'stripe_error', __('There was a problem connecting to the payment gateway.', 'wc_stripe') );

		if( empty($response['body']) )
			return new WP_Error( 'stripe_error', __('Empty response.', 'wc_stripe') );

		$parsed_response = json_decode( $response['body'] );

		// Handle response
		if ( ! empty( $parsed_response->error ) ) {

			return new WP_Error( 'stripe_error', $parsed_response->error->message );

		} elseif ( empty( $parsed_response->id ) ) {

			return new WP_Error( 'stripe_error', __('Invalid response.', 'wc_stripe') );

		}

		return $parsed_response;

	}

}