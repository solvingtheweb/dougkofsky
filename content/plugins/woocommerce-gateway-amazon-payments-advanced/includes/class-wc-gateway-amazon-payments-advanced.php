<?php
/**
 * WC_Gateway_Amazon_Payments_Advanced
 */
class WC_Gateway_Amazon_Payments_Advanced extends WC_Payment_Gateway {

	/**
	 * Amazon Order Reference ID (when not in "login app" mode checkout)
	 * @var string
	 */
	protected $reference_id;

	/**
	 * Amazon Payments Access Token ("login app" mode checkout)
	 * @var string
	 */
	protected $access_token;

	/**
	 * @var WC_Logger
	 */
	protected $logger;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->method_title = 'Amazon Payments Advanced';
		$this->id           = 'amazon_payments_advanced';
		$this->icon         = apply_filters( 'woocommerce_amazon_pa_logo', plugins_url( 'assets/images/amazon-payments.gif', plugin_dir_path( __FILE__ ) ) );
		$this->debug        = ( 'yes' === $this->get_option( 'debug' ) );

		// Load the form fields
		$this->init_form_fields();

		// Load the settings
		$this->init_settings();

		// Load salved settings
		$this->load_settings();

		// Get Order Refererence ID and/or Access Token
		$this->reference_id = WC_Amazon_Payments_Advanced_API::get_reference_id();
		$this->access_token = WC_Amazon_Payments_Advanced_API::get_access_token();

		// Handling for the review page of the German Market Plugin
		if ( empty( $this->reference_id ) ) {
			if ( isset( $_SESSION['first_checkout_post_array']['amazon_reference_id'] ) ) {
				$this->reference_id = $_SESSION['first_checkout_post_array']['amazon_reference_id'];
			}
		}

		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_checkout_update_order_review', array( $this, 'store_shipping_info_in_session' ) );

	}

	/**
	 * Amazon Payments Advanced is available if the following conditions are met (on top of WC_Payment_Gateway::is_available)
	 * 1) Login App mode is enabled and we have an access token from Amazon
	 * 2) Login App mode is *not* enabled and we have an order reference id
	 *
	 * @return bool
	 */
	function is_available() {

		$login_app_enabled  = ( 'yes' === $this->enable_login_app );
		$standard_mode_ok   = ( ! $login_app_enabled && ! empty( $this->reference_id ) );
		$login_app_mode_ok  = ( $login_app_enabled && ! empty( $this->access_token ) );

		return ( parent::is_available() && ( $standard_mode_ok || $login_app_mode_ok ) );

	}

	/**
	 * Has fields.
	 *
	 * @return bool
	 */
	public function has_fields() {
		return is_checkout_pay_page();
	}

	/**
	 * Payment form on checkout page
	 */
	public function payment_fields() {
		if ( $this->has_fields() ) : ?>

			<?php if ( empty( $this->reference_id ) && empty( $this->access_token ) ) : ?>
				<div>
					<div id="pay_with_amazon"></div>
					<?php echo apply_filters( 'woocommerce_amazon_pa_checkout_message', __( 'Have an Amazon account?', 'woocommerce-gateway-amazon-payments-advanced' ) ); ?>
				</div>
			<?php else: ?>
				<div class="wc-amazon-payments-advanced-order-day-widgets">
					<div id="amazon_wallet_widget"></div>
					<div id="amazon_consent_widget"></div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $this->reference_id ) ) : ?>
				<input type="hidden" name="amazon_reference_id" value="<?php echo esc_attr( $this->reference_id ); ?>" />
			<?php endif; ?>
			<?php if ( ! empty( $this->access_token ) ) : ?>
				<input type="hidden" name="amazon_access_token" value="<?php echo esc_attr( $this->access_token ); ?>" />
			<?php endif; ?>

		<?php endif;
	}

	/**
	 * Admin Panel Options
	 * - Options for bits like 'title' and availability on a country-by-country basis
	 */
	public function admin_options() {
		?>
		<h3><?php echo $this->method_title; ?></h3>

		<?php if ( ! $this->seller_id ) : ?>
			<div class="updated woocommerce-message"><div class="squeezer">
				<h4><?php _e( 'Need an Amazon Payments Advanced account?', 'woocommerce-gateway-amazon-payments-advanced' ); ?></h4>
				<p class="submit">
					<a class="button button-primary" href="<?php echo esc_url( WC_Amazon_Payments_Advanced_API::get_register_url() ); ?>"><?php _e( 'Signup now', 'woocommerce-gateway-amazon-payments-advanced' ); ?></a>
				</p>
			</div></div>
		<?php endif; ?>

		<table class="form-table">
			<?php $this->generate_settings_html(); ?>
		</table><!--/.form-table-->
		<script>
			jQuery( document ).ready( function( $ ) {
				$( '#woocommerce_amazon_payments_advanced_enable_login_app' ).on( 'change', function() {
					var appOptions = $( '#woocommerce_amazon_payments_advanced_app_client_id, #woocommerce_amazon_payments_advanced_app_client_secret' ).closest( 'tr' );
					var oldOptions = $( '#woocommerce_amazon_payments_advanced_cart_button_display_mode, #woocommerce_amazon_payments_advanced_hide_standard_checkout_button' ).closest( 'tr' );

					if ( $( this ).is( ':checked' ) ) {
						appOptions.show();
						oldOptions.hide();
					} else {
						appOptions.hide();
						oldOptions.show();
					}
				}).change();
			});
		</script>
		<?php
	}

	/**
	 * Init payment gateway form fields
	 */
	function init_form_fields() {

		$login_app_setup_url    = WC_Amazon_Payments_Advanced_API::get_client_id_instructions_url();
		$label_format           = __( 'This option makes the plugin to work with the latest API from Amazon, this will enable support for Subscriptions and make transactions more securely. <a href="%s" target="_blank">You must create an Amazon Login App to be able to use this option.</a>', 'woocommerce-gateway-amazon-payments-advanced' );
		$label_format           = wp_kses( $label_format, array( 'a' => array( 'href' => array(), 'target' => array() ) ) );
		$enable_login_app_label = sprintf( $label_format, $login_app_setup_url );

		$this->form_fields = array(
			'enabled' => array(
				'title'       => __( 'Enable/Disable', 'woocommerce-gateway-amazon-payments-advanced' ),
				'label'       => __( 'Enable Amazon Payments Advanced', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),
			'title' => array(
				'title'       => __( 'Title', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => __( 'Payment method title that the customer will see on your website.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default'     => __( 'Amazon', 'woocommerce-gateway-amazon-payments-advanced' ),
				'desc_tip'    => true
			),
			'seller_id' => array(
				'title'       => __( 'Seller ID', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => __( 'Obtained from your Amazon account. Also known as the "Merchant ID". Usually found under Settings > Integrations after logging into your merchant account.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default'     => '',
				'desc_tip'    => true
			),
			'mws_access_key' => array(
				'title'       => __( 'MWS Access Key', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => __( 'Obtained from your Amazon account. You can get these keys by logging into Seller Central and viewing the MWS Access Key section under the Integration tab.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default'     => '',
				'desc_tip'    => true
			),
			'secret_key' => array(
				'title'       => __( 'MWS Secret Key', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => __( 'Obtained from your Amazon account. You can get these keys by logging into Seller Central and viewing the MWS Access Key section under the Integration tab.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default'     => '',
				'desc_tip'    => true
			),
			'enable_login_app' => array(
				'title'       => __( 'Use Amazon Login App', 'woocommerce-gateway-amazon-payments-advanced' ),
				'label'       => $enable_login_app_label,
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),
			'app_client_id' => array(
				'title'       => __( 'App Client ID', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => '',
				'default'     => '',
				'desc_tip'    => true
			),
			'app_client_secret' => array(
				'title'       => __( 'App Client Secret', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'text',
				'description' => '',
				'default'     => '',
				'desc_tip'    => true
			),
			'sandbox' => array(
				'title'       => __( 'Use Sandbox', 'woocommerce-gateway-amazon-payments-advanced' ),
				'label'       => __( 'Enable sandbox mode during testing and development - live payments will not be taken if enabled.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),
			'payment_capture' => array(
				'title'       => __( 'Payment Capture', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'select',
				'description' => '',
				'default'     => '',
				'options'     => array(
					''          => __( 'Authorize and Capture the payment when the order is placed.', 'woocommerce-gateway-amazon-payments-advanced' ),
					'authorize' => __( 'Authorize the payment when the order is placed.', 'woocommerce-gateway-amazon-payments-advanced' ),
					'manual'    => __( 'Don’t Authorize the payment when the order is placed (i.e. for pre-orders).', 'woocommerce-gateway-amazon-payments-advanced' )
				)
			),
			'cart_button_display_mode' => array(
				'title'       => __( 'Cart login button display', 'woocommerce-gateway-amazon-payments-advanced' ),
				'description' => __( 'How the login with Amazon button gets displayed on the cart page.' ),
				'type'        => 'select',
				'options'     => array(
					'button'   => __( 'Button', 'woocommerce-gateway-amazon-payments-advanced' ),
					'banner'   => __( 'Banner', 'woocommerce-gateway-amazon-payments-advanced' ),
					'disabled' => __( 'Disabled', 'woocommerce-gateway-amazon-payments-advanced' ),
				),
				'default'     => 'button',
				'desc_tip'    => true
			),
			'hide_standard_checkout_button' => array(
				'title'   => __( 'Standard checkout button', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'    => 'checkbox',
				'label'   => __( 'Hide standard checkout button on cart page', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default' => 'no'
			),
			'debug' => array(
				'title'       => __( 'Debug', 'woocommerce-gateway-amazon-payments-advanced' ),
				'label'       => __( 'Enable debugging messages', 'woocommerce-gateway-amazon-payments-advanced' ),
				'type'        => 'checkbox',
				'description' => __( 'Sends debug messages to the WooCommerce System Status log.', 'woocommerce-gateway-amazon-payments-advanced' ),
				'default'     => 'no'
			)
	   );
	}

	/**
	 * Define user set variables
	 */
	public function load_settings() {
		$settings = WC_Amazon_Payments_Advanced_API::get_settings();

		$this->title             = $settings['title'];
		$this->seller_id         = $settings['seller_id'];
		$this->mws_access_key    = $settings['mws_access_key'];
		$this->secret_key        = $settings['secret_key'];
		$this->enable_login_app  = $settings['enable_login_app'];
		$this->app_client_id     = $settings['app_client_id'];
		$this->app_client_secret = $settings['app_client_secret'];
		$this->sandbox           = $settings['sandbox'];
		$this->payment_capture   = $settings['payment_capture'];
	}

	/**
	 * Get the shipping address from Amazon and store in session.
	 *
	 * This makes tax/shipping rate calculation possible on AddressBook Widget selection.
	 */
	public function store_shipping_info_in_session() {

		if ( ! $this->reference_id ) {
			return;
		}

		$order_details = $this->get_amazon_order_details( $this->reference_id );

		if ( ! $order_details || ! isset( $order_details->Destination->PhysicalDestination ) ) {
			return;
		}

		$address = (array) $order_details->Destination->PhysicalDestination;

		if ( ! empty( $address['CountryCode'] ) ) {
			WC()->customer->set_country( $address['CountryCode'] );
			WC()->customer->set_shipping_country( $address['CountryCode'] );
		}

		if ( ! empty( $address['StateOrRegion'] ) ) {
			WC()->customer->set_state( $address['StateOrRegion'] );
			WC()->customer->set_shipping_state( $address['StateOrRegion'] );
		}

		if ( ! empty( $address['PostalCode'] ) ) {

			$postal_code  = $address['PostalCode'];
			$country_code = empty( $address['CountryCode'] ) ? '' : $address['CountryCode'];

			if ( 'US' === $country_code ) {

				/*
				 * US postal codes comes back as a ZIP+4 when in "login app" mode.
				 *
				 * This is too specific for the local delivery shipping method,
				 * and causes the zip not to match, so we remove the +4.
				 */
				$code_parts  = explode( '-', $postal_code );
				$postal_code = $code_parts[0];

			}

			WC()->customer->set_postcode( $postal_code );
			WC()->customer->set_shipping_postcode( $postal_code );
		}

		if ( ! empty( $address['City'] ) ) {
			WC()->customer->set_city( $address['City'] );
			WC()->customer->set_shipping_city( $address['City'] );
		}

	}

	/**
	 * Process payment
	 *
	 * @param int $order_id
	 */
	public function process_payment( $order_id ) {
		$order = new WC_Order( $order_id );

		$amazon_reference_id = isset( $_POST['amazon_reference_id'] ) ? wc_clean( $_POST['amazon_reference_id'] ) : '';

		try {

			if ( ! $amazon_reference_id ) {
				throw new Exception( __( 'An Amazon payment method was not chosen.', 'woocommerce-gateway-amazon-payments-advanced' ) );
			}

			// Update order reference with amounts
			$this->set_order_reference_details( $order, $amazon_reference_id );

			// Confirm order reference
			$this->confirm_order_reference( $amazon_reference_id );

			// Get FULL address details and save them to the order
			$order_details = $this->get_amazon_order_details( $amazon_reference_id );

			if ( $order_details ) {

				$this->store_order_address_details( $order_id, $order_details );

			}

			// Store reference ID in the order
			add_post_meta( $order_id, 'amazon_reference_id', $amazon_reference_id, true );

			switch ( $this->payment_capture ) {
				case 'manual' :

					// Mark as on-hold
					$order->update_status( 'on-hold', __( 'Amazon order opened. Use the "Amazon Payments Advanced" box to authorize and/or capture payment. Authorized payments must be captured within 7 days.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					// Reduce stock levels
					$order->reduce_order_stock();

				break;
				case 'authorize' :

					// Authorize only
					$result = WC_Amazon_Payments_Advanced_API::authorize_payment( $order_id, $amazon_reference_id, false );

					if ( $result ) {
						// Mark as on-hold
						$order->update_status( 'on-hold', __( 'Amazon order opened. Use the "Amazon Payments Advanced" box to authorize and/or capture payment. Authorized payments must be captured within 7 days.', 'woocommerce-gateway-amazon-payments-advanced' ) );

						// Reduce stock levels
						$order->reduce_order_stock();
					} else {
						$order->update_status( 'failed', __( 'Could not authorize Amazon payment.', 'woocommerce-gateway-amazon-payments-advanced' ) );
					}

				break;
				default :

					// Capture
					$result = WC_Amazon_Payments_Advanced_API::authorize_payment( $order_id, $amazon_reference_id, true );

					if ( $result ) {
						// Payment complete

						add_post_meta( $order_id, '_transaction_id', $amazon_reference_id, true );

						$order->payment_complete();
					} else {
						$order->update_status( 'failed', __( 'Could not authorize Amazon payment.', 'woocommerce-gateway-amazon-payments-advanced' ) );
					}

				break;
			}

			// Remove cart
			WC()->cart->empty_cart();

			// Return thank you page redirect
			return array(
				'result' 	=> 'success',
				'redirect'	=> $this->get_return_url( $order )
			);

		} catch( Exception $e ) {
			wc_add_notice( __( 'Error:', 'woocommerce-gateway-amazon-payments-advanced' ) . ' ' . $e->getMessage(), 'error' );
			return;
		}
	}

	/**
	 * Use 'SetOrderReferenceDetails' action to update details of the order reference.
	 *
	 * By default, use data from the WC_Order and WooCommerce / Site settings, but offer the ability to override.
	 *
	 * @param WC_Order $order
	 * @param string   $amazon_reference_id
	 * @param array    $overrides Optional. Override values sent to the Amazon Payments API for the 'SetOrderReferenceDetails' request.
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function set_order_reference_details( $order, $amazon_reference_id, $overrides = array() ) {

		$site_name = WC_Amazon_Payments_Advanced::get_site_name();

		$request_args = array_merge( array(
			'Action'                                                       => 'SetOrderReferenceDetails',
			'AmazonOrderReferenceId'                                       => $amazon_reference_id,
			'OrderReferenceAttributes.OrderTotal.Amount'                   => $order->get_total(),
			'OrderReferenceAttributes.OrderTotal.CurrencyCode'             => strtoupper( get_woocommerce_currency() ),
			'OrderReferenceAttributes.SellerNote'                          => sprintf( __( 'Order %s from %s.', 'woocommerce-gateway-amazon-payments-advanced' ), $order->get_order_number(), urlencode( $site_name ) ),
			'OrderReferenceAttributes.SellerOrderAttributes.SellerOrderId' => $order->get_order_number(),
			'OrderReferenceAttributes.SellerOrderAttributes.StoreName'     => $site_name,
			'OrderReferenceAttributes.PlatformId'                          => 'A1BVJDFFHQ7US4'
		), $overrides );

		// Update order reference with amounts
		$response = WC_Amazon_Payments_Advanced_API::request( $request_args );

		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		if ( isset( $response->Error->Message ) ) {
			throw new Exception( (string) $response->Error->Message );
		}

		return $response;

	}

	/**
	 * Helper method to call 'ConfirmOrderReference' API action
	 *
	 * @param string $amazon_reference_id
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function confirm_order_reference( $amazon_reference_id ) {

		$response = WC_Amazon_Payments_Advanced_API::request( array(
			'Action'                 => 'ConfirmOrderReference',
			'AmazonOrderReferenceId' => $amazon_reference_id
		) );

		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		if ( isset( $response->Error->Message ) ) {
			throw new Exception( (string) $response->Error->Message );
		}

		return $response;

	}

	/**
	 * Retrieve full details from the order using 'GetOrderReferenceDetails'.
	 *
	 * @param string $amazon_reference_id
	 *
	 * @return bool|object Boolean false on failure, object of OrderReferenceDetails on success.
	 */
	function get_amazon_order_details( $amazon_reference_id ) {

		$request_args = array(
			'Action'                 => 'GetOrderReferenceDetails',
			'AmazonOrderReferenceId' => $amazon_reference_id
		);

		// Full address information is available to the 'GetOrderReferenceDetails' call when we're in
		// "login app" mode and we pass the AddressConsentToken to the API
		// See the "Getting the Shipping Address" section here: https://payments.amazon.com/documentation/lpwa/201749990
		$settings = WC_Amazon_Payments_Advanced_API::get_settings();

		if ( 'yes' == $settings['enable_login_app'] ) {

			$request_args['AddressConsentToken'] = $this->access_token;

		}

		$response = WC_Amazon_Payments_Advanced_API::request( $request_args );

		if ( ! is_wp_error( $response ) && isset( $response->GetOrderReferenceDetailsResult->OrderReferenceDetails ) ) {

			return $response->GetOrderReferenceDetailsResult->OrderReferenceDetails;

		}

		return false;

	}

	/**
	 * Format an Amazon Payments Address DataType for WooCommerce
	 * See: https://payments.amazon.com/documentation/apireference/201752430
	 *
	 * @param array $address Address object from Amazon Payments API
	 *
	 * @return array Address formatted for WooCommerce
	 */
	function format_address( $address ) {

		$formatted = array();

		$address_name  = explode( ' ', (string) $address->Name );

		// Get first and last names
		$shipping_last  = array_pop( $address_name );
		$shipping_first = implode( ' ', $address_name );

		$formatted['first_name'] = implode( ' ', $address_name );

		// Format address and map to WC fields
		$address_lines = array();

		if ( ! empty( $address->AddressLine1 ) ) {
			$address_lines[] = (string) $address->AddressLine1;
		}
		if ( ! empty( $address->AddressLine2 ) ) {
			$address_lines[] = (string) $address->AddressLine2;
		}
		if ( ! empty( $address->AddressLine3 ) ) {
			$address_lines[] = (string) $address->AddressLine3;
		}

		if ( 3 === sizeof( $address_lines ) ) {

			$formatted['company']   = $address_lines[0];
			$formatted['address_1'] = $address_lines[1];
			$formatted['address_2'] = $address_lines[2];

		} elseif ( 2 === sizeof( $address_lines ) ) {

			$formatted['address_1'] = $address_lines[0];
			$formatted['address_2'] = $address_lines[1];

		} elseif ( sizeof( $address_lines ) ) {

			$formatted['address_1'] = $address_lines[0];

		}

		$formatted['phone'] = isset( $address->Phone ) ? (string) $address->Phone : null;
		$formatted['city'] = isset( $address->City ) ? (string) $address->City : null;
		$formatted['postcode'] = isset( $address->PostalCode ) ? (string) $address->PostalCode : null;
		$formatted['state'] = isset( $address->StateOrRegion ) ? (string) $address->StateOrRegion : null;
		$formatted['country'] = isset( $address->CountryCode ) ? (string) $address->CountryCode : null;

		return array_filter( $formatted );

	}

	/**
	 * Parse the OrderReferenceDetails object and store billing/shipping addresses in order meta.
	 *
	 * @param int $order_id
	 * @param object $order_reference_details Amazon API OrderReferenceDetails or compatible object
	 */
	function store_order_address_details( $order_id, $order_reference_details ) {

		$buyer         = $order_reference_details->Buyer;
		$destination   = $order_reference_details->Destination->PhysicalDestination;
		$shipping_info = $this->format_address( $destination );

		$order = wc_get_order( $order_id );

		$order->set_address( $shipping_info, 'shipping' );

		// Some market API endpoint return billing address information, parse it if present.
		if ( isset( $order_reference_details->BillingAddress->PhysicalAddress ) ) {

			$billing_address = $this->format_address( $order_reference_details->BillingAddress->PhysicalAddress );

			$billing_address['email'] = (string) $buyer->Email;
			$billing_address['phone'] = isset( $billing_address['phone'] ) ? $billing_address['phone'] : (string) $buyer->Phone;

			$order->set_address( $billing_address, 'billing' );

		} else {

			// Reuse the shipping address information if no bespoke billing info.
			$order->set_address( $shipping_info, 'billing' );

		}

	}

	/**
	 * Write a message to log if we're in "debug" mode.
	 *
	 * @param string $context
	 * @param string $message
	 */
	public function log( $context, $message ) {

		if ( ! $this->debug ) {

			return;

		}

		if ( ! is_a( $this->logger, 'WC_Logger' ) ) {

			$this->logger = new WC_Logger();

		}

		$log_message = $context . ' - ' . $message;

		$this->logger->add( 'woocommerce-gateway-amazon-payments-advanced', $log_message );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {

			error_log( $log_message );

		}

	}
}
