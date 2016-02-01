<?php
/*
Plugin Name: WooCommerce Amazon Payments Advanced Gateway
Plugin URI: http://woothemes.com/woocommerce
Description: Amazon Payments Advanced is embedded directly into your existing web site, and all the buyer interactions with Amazon Payments Advanced take place in embedded widgets so that the buyer never leaves your site. Buyers can log in using their Amazon account, select a shipping address and payment method, and then confirm their order. Requires an Amazon Seller account with the Amazon Payments Advanced service provisioned. Supports DE, UK, and US.
Version: 1.5.3
Author: WooThemes
Author URI: http://woothemes.com

	Copyright: © 2009-2016 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '9865e043bbbe4f8c9735af31cb509b53', '238816' );

/**
 * Amazon Payments Advanced main class
 */
class WC_Amazon_Payments_Advanced {

	/**
	 * Amazon Payments settings
	 *
	 * @var array
	 */
	private $settings;

	/**
	 * Reference ID
	 *
	 * @var string
	 */
	private $reference_id;


	/**
	 * Access token
	 *
	 * @var string
	 */
	private $access_token;

	/**
	 * Amazon Payments Gateway
	 *
	 * @var WC_Gateway_Amazon_Payments_Advanced
	 */
	private $gateway;

	/**
	 * Constructor
	 */
	public function __construct() {
		include_once( 'includes/class-wc-amazon-payments-advanced-api.php' );

		$this->settings     = WC_Amazon_Payments_Advanced_API::get_settings();
		$this->reference_id = WC_Amazon_Payments_Advanced_API::get_reference_id();
		$this->access_token = WC_Amazon_Payments_Advanced_API::get_access_token();

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_links' ) );
		add_action( 'init', array( $this, 'init_gateway' ) );
		add_action( 'wp_loaded', array( $this, 'init_handlers' ), 11 );
		add_action( 'wp_footer', array( $this, 'maybe_hide_standard_checkout_button' ) );
	}

	/**
	 * Maybe hide standard WC checkout button on the cart, if enabled
	 */
	public function maybe_hide_standard_checkout_button() {
		if ( 'yes' === $this->settings['enabled'] && 'yes' === $this->settings['hide_standard_checkout_button'] && 'no' === $this->settings['enable_login_app'] ) {
			?>
				<style type="text/css">
					.woocommerce a.checkout-button,
					.woocommerce input.checkout-button,
					.cart input.checkout-button,
					.cart a.checkout-button,
					.widget_shopping_cart a.checkout {
						display: none !important;
					}
				</style>
			<?php
		}
	}

	/**
	 * Plugin page links
	 */
	public function plugin_links( $links ) {
		$plugin_links = array(
			'<a href="http://support.woothemes.com/">' . __( 'Support', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>',
			'<a href="http://docs.woothemes.com/document/amazon-payments-advanced/">' . __( 'Docs', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>',
		);

		return array_merge( $plugin_links, $links );
	}

	/**
	 * Init gateway
	 */
	public function init_gateway() {
		load_plugin_textdomain( 'woocommerce-gateway-amazon-payments-advanced', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
			return;
		}

		include_once( 'includes/class-wc-amazon-payments-advanced-order-admin.php' );
		include_once( 'includes/class-wc-gateway-amazon-payments-advanced.php' );

		// Check for Subscriptions 2.0, and load support if found
		if ( class_exists( 'WC_Subscriptions_Order' ) && function_exists( 'wcs_create_renewal_order' ) ) {

			include_once( 'includes/class-wc-gateway-amazon-payments-advanced-subscriptions.php' );

			$this->gateway = new WC_Gateway_Amazon_Payments_Advanced_Subscriptions();

		} else {

			$this->gateway = new WC_Gateway_Amazon_Payments_Advanced();

		}



		add_filter( 'woocommerce_payment_gateways',  array( $this, 'add_gateway' ) );
	}

	/**
	 * Load handlers for cart and orders after WC Cart is loaded.
	 */
	public function init_handlers() {
		// Disable if no seller ID
		if ( ! apply_filters( 'woocommerce_amazon_payments_init', true ) || empty( $this->settings['seller_id'] ) || 'no' == $this->settings['enabled'] ) {
			return;
		}

		// Login app actions
		if ( 'yes' === $this->settings['enable_login_app'] ) {

			// Login app widget.
			add_action( 'wp_head', array( $this, 'init_amazon_login_app_widget' ) );

		} else {

			if ( 'button' == $this->settings['cart_button_display_mode'] ) {

				add_action( 'woocommerce_proceed_to_checkout', array( $this, 'checkout_button' ), 25 );

			} elseif ( 'banner' == $this->settings['cart_button_display_mode'] ) {

				add_action( 'woocommerce_before_cart', array( $this, 'checkout_message' ), 5 );

			}

		}

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'woocommerce_checkout_init', array( $this, 'checkout_init' ) );
		add_filter( 'woocommerce_update_order_review_fragments', array( $this, 'update_amazon_widgets_fragment' ) );
		add_action( 'woocommerce_after_calculate_totals', array( $this, 'force_standard_mode_refresh_with_zero_order_total' ) );

	}

	/**
	 * Initialize Amazon Payments UI during checkout
	 *
	 * @param WC_Checkout $checkout
	 */
	function checkout_init( $checkout ) {

		// Are we using the login app?
		$enable_login_app = ( 'yes' === $this->settings['enable_login_app'] );

		// Disable Amazon Payments for zero-total checkouts using the standard button
		if ( ! WC()->cart->needs_payment() && ! $enable_login_app ) {

			// Render a placeholder widget container instead, in the event we need to populate it later
			add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'placeholder_widget_container' ) );

			// Render a placeholder checkout message container, in the event we need to populate it later
			add_action( 'woocommerce_before_checkout_form', array( $this, 'placeholder_checkout_message_container' ), 5 );

			return;

		}

		// Login app actions
		if ( $enable_login_app ) {
			add_action( 'woocommerce_thankyou_amazon_payments_advanced', array( $this, 'logout_amazon_login_app_widget' ) );
		}

		add_action( 'woocommerce_before_checkout_form', array( $this, 'checkout_message' ), 5 );
		add_action( 'before_woocommerce_pay', array( $this, 'checkout_message' ), 5 );

		// Don't try to render the Amazon widgets if we don't have the prerequisites for each mode
		if ( ( ! $enable_login_app && empty( $this->reference_id ) ) || ( $enable_login_app && empty( $this->access_token ) ) ) {
			return;
		}

		add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'payment_widget' ), 20 );
		add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'address_widget' ), 10 );
		add_filter( 'woocommerce_available_payment_gateways', array( $this, 'remove_gateways' ) );
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'capture_shipping_address_for_zero_order_total' ) );

		// The default checkout form uses the billing email for new account creation
		// Let's hijack that field for the Amazon-based checkout
		$has_account_fields = isset( $checkout->checkout_fields['account'] ) && is_array( $checkout->checkout_fields['account'] );
		$has_billing_fields = isset( $checkout->checkout_fields['billing'] ) && is_array( $checkout->checkout_fields['billing'] );

		if ( $has_account_fields && $has_billing_fields ) {

			$billing_fields_to_copy = array(
				'billing_first_name' => '',
				'billing_last_name'  => '',
				'billing_email'      => ''
			);

			$billing_fields_to_merge = array_intersect_key( $checkout->checkout_fields['billing'], $billing_fields_to_copy );

			$checkout->checkout_fields['account'] = array_merge( $billing_fields_to_merge, $checkout->checkout_fields['account'] );

			if ( isset( $checkout->checkout_fields['account']['billing_email']['class'] ) ) {

				$checkout->checkout_fields['account']['billing_email']['class'] = '';

			}

		}

		// During an Amazon checkout, the standard billing and shipping fields need to be
		// "removed" so that we don't trigger a false negative on form validation -
		// they can be empty since we're using the Amazon widgets
		$checkout->checkout_fields['billing']  = array();
		$checkout->checkout_fields['shipping'] = array();

	}

	/**
	 * Checkout Button
	 *
	 * Triggered from the 'woocommerce_proceed_to_checkout' action.
	 */
	public function checkout_button() {
		echo '<div id="pay_with_amazon"></div>';
	}

	/**
	 * Checkout Message
	 */
	public function checkout_message() {
		echo '<div class="wc-amazon-checkout-message wc-amazon-payments-advanced-populated">';

		if ( empty( $this->reference_id ) && empty( $_REQUEST['amazon_payments_advanced'] ) ) {
			echo '<div class="woocommerce-info info"><div id="pay_with_amazon"></div> ' . apply_filters( 'woocommerce_amazon_pa_checkout_message', __( 'Have an Amazon account?', 'woocommerce-gateway-amazon-payments-advanced' ) ) . '</div>';
		} elseif ( 'yes' == $this->settings['enable_login_app'] ) {
			echo '<div class="woocommerce-info info">' . apply_filters( 'woocommerce_amazon_pa_checkout_logout_message', __( 'You\'re logged in with your Amazon Account.', 'woocommerce-gateway-amazon-payments-advanced' ) ) . ' <a href="#" id="amazon-logout">' . __( 'Log out &raquo;', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a></div>';
		}

		echo '</div>';

	}

	/**
	* Add Amazon gateway to WC
	*
	* @param  array $methods
	* @return array of methods
	*/
	public function add_gateway( $methods ) {
		$methods[] = $this->gateway;

		return $methods;
	}

	/**
	 * Init Amazon login app widget.
	 */
	public function init_amazon_login_app_widget() {
		?>
		<script>
			window.onAmazonLoginReady = function() {
				amazon.Login.setClientId( '<?php echo esc_js( $this->settings["app_client_id"] ); ?>' );
			};
		</script>
		<?php
	}

	/**
	 * Logout from Amazon login app widget.
	 */
	public function logout_amazon_login_app_widget() {
		echo '<script>amazon.Login.logout();</script>';
	}

	/**
	 * Add scripts
	 */
	public function scripts() {

		$enqueue_scripts = is_cart() || is_checkout() || is_checkout_pay_page();

		if ( ! apply_filters( 'woocommerce_amazon_pa_enqueue_scripts', $enqueue_scripts ) ) {
			return;
		}

		$type = ( 'yes' == $this->settings['enable_login_app'] ) ? 'app' : 'standard';

		wp_enqueue_style( 'amazon_payments_advanced', plugins_url( 'assets/css/style.css', __FILE__ ) );
		wp_enqueue_script( 'amazon_payments_advanced_widgets', WC_Amazon_Payments_Advanced_API::get_widgets_url(), array(), '1.0', true );
		wp_enqueue_script( 'amazon_payments_advanced', plugins_url( 'assets/js/amazon-' . $type . '-widgets.js', __FILE__ ), array(), '1.0', true );

		$redirect_page = is_cart() ? add_query_arg( 'amazon_payments_advanced', 'true', get_permalink( woocommerce_get_page_id( 'checkout' ) ) ) : add_query_arg( 'amazon_payments_advanced', 'true' );

		$params = array(
			'seller_id'            => $this->settings['seller_id'],
			'reference_id'         => $this->reference_id,
			'redirect'             => esc_url_raw( $redirect_page ),
			'is_checkout_pay_page' => is_checkout_pay_page(),
			'is_checkout'          => is_checkout(),
			'access_token'         => $this->access_token,
		);

		if ( 'yes' == $this->settings['enable_login_app'] ) {

			$params['button_type']  = 'LwA';
			$params['button_color'] = 'Gold';
			$params['button_size']  = 'small';
			$params['checkout_url'] = esc_url_raw( get_permalink( woocommerce_get_page_id( 'checkout' ) ) );

		}

		if ( class_exists( 'WC_Subscriptions_Cart' ) ) {

			$cart_contains_subscription      = WC_Subscriptions_Cart::cart_contains_subscription() || wcs_cart_contains_renewal();
			$change_payment_for_subscription = isset( $_GET['change_payment_method'] ) && wcs_is_subscription( absint( $_GET['change_payment_method'] ) );
			$params['is_recurring']          = $cart_contains_subscription || $change_payment_for_subscription;

		}

		$params = array_map( 'esc_js', apply_filters( 'woocommerce_amazon_pa_widgets_params', $params ) );

		wp_localize_script( 'amazon_payments_advanced', 'amazon_payments_advanced_params', $params );
	}

	/**
	 * Output an empty placeholder widgets container
	 */
	function placeholder_widget_container() {
		?>
		<div id="amazon_customer_details"></div>
		<?php
	}

	/**
	 * Output an empty placeholder checkout message container
	 */
	public function placeholder_checkout_message_container() {
		?>
		<div class="wc-amazon-checkout-message"></div>
		<?php
	}

	/**
	 * Output the address widget HTML
	 */
	public function address_widget() {
		?>
		<div id="amazon_customer_details" class="wc-amazon-payments-advanced-populated">
			<div class="col2-set">
				<div class="col-1">
					<?php if ( WC()->cart->needs_shipping() ) : ?>
						<h3><?php _e( 'Shipping Address', 'woocommerce-gateway-amazon-payments-advanced' ); ?></h3>
					<?php else : ?>
						<h3><?php _e( 'Your Address', 'woocommerce-gateway-amazon-payments-advanced' ); ?></h3>
					<?php endif; ?>
					<div id="amazon_addressbook_widget"></div>
					<?php if ( ! empty( $this->reference_id ) ) : ?>
						<input type="hidden" name="amazon_reference_id" value="<?php echo esc_attr( $this->reference_id ); ?>" />
					<?php endif; ?>
					<?php if ( ! empty( $this->access_token ) ) : ?>
						<input type="hidden" name="amazon_access_token" value="<?php echo esc_attr( $this->access_token ); ?>" />
					<?php endif; ?>
				</div>
		<?php
	}

	/**
	 * Output the payment method widget HTML
	 */
	public function payment_widget() {
		$checkout = WC_Checkout::instance();
		?>
				<div class="col-2">
					<h3><?php _e( 'Payment Method', 'woocommerce' ); ?></h3>
					<div id="amazon_wallet_widget"></div>
					<?php if ( ! empty( $this->reference_id ) ) : ?>
						<input type="hidden" name="amazon_reference_id" value="<?php echo esc_attr( $this->reference_id ); ?>" />
					<?php endif; ?>
					<?php if ( ! empty( $this->access_token ) ) : ?>
						<input type="hidden" name="amazon_access_token" value="<?php echo esc_attr( $this->access_token ); ?>" />
					<?php endif; ?>
				</div>
				<div id="amazon_consent_widget" style="display: none;"></div>

		<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

			<?php if ( $checkout->enable_guest_checkout ) : ?>

				<p class="form-row form-row-wide create-account">
					<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce-gateway-amazon-payments-advanced' ); ?></label>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

				<div class="create-account">

					<h3><?php _e( 'Create Account', 'woocommerce-gateway-amazon-payments-advanced' ); ?></h3>
					<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce-gateway-amazon-payments-advanced' ); ?></p>

					<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

					<?php endforeach; ?>

					<div class="clear"></div>

				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

		<?php endif; ?>
			</div>
		</div>

		<?php
	}

	/**
	 * Render the Amazon Payments widgets when an order is updated to require payment, and the Amazon gateway is available
	 *
	 * @param array $fragments
	 *
	 * @return array
	 */
	public function update_amazon_widgets_fragment( $fragments ) {

		$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();

		if ( WC()->cart->needs_payment() ) {

			ob_start();

			$this->checkout_message();

			$fragments['.wc-amazon-checkout-message:not(.wc-amazon-payments-advanced-populated)'] = ob_get_clean();

			if ( array_key_exists( 'amazon_payments_advanced', $available_gateways ) ) {

				ob_start();

				$this->address_widget();

				$this->payment_widget();

				$fragments['#amazon_customer_details:not(.wc-amazon-payments-advanced-populated)'] = ob_get_clean();

			}

		}

		return $fragments;

	}

	/**
	 * Remove all gateways except amazon
	 *
	 * @param array $gateways
	 */
	public function remove_gateways( $gateways ) {

		foreach ( $gateways as $gateway_key => $gateway ) {
			if ( $gateway_key !== 'amazon_payments_advanced' ) {
				unset( $gateways[ $gateway_key ] );
			}
		}

		return $gateways;
	}

	/**
	 * Capture full shipping address in the case of a $0 order, using the "login app" version of the API.
	 *
	 * @param int $order_id
	 *
	 * @throws Exception
	 */
	function capture_shipping_address_for_zero_order_total( $order_id ) {

		$order = new WC_Order( $order_id );

		// Complete address data is only available without a confirmed order if we're using the login app
		// See the "Getting the Shipping Address" section here: https://payments.amazon.com/documentation/lpwa/201749990
		if ( ( $order->get_total() > 0 ) || empty( $this->reference_id ) || ( 'yes' !== $this->settings['enable_login_app'] ) || empty( $this->access_token ) ) {
			return;
		}

		// Get FULL address details and save them to the order
		$order_details = $this->gateway->get_amazon_order_details( $order_id, $this->reference_id );

		if ( $order_details ) {

			$this->store_order_address_details( $order_id, $order_details );

		}

	}

	/**
	 * Helper method to get a sanitized version of the site name.
	 *
	 * @return string
	 */
	public static function get_site_name() {

		// Get site setting for blog name
		$site_name = get_bloginfo( 'name' );

		// Decode HTML entities
		$site_name = wp_specialchars_decode( $site_name, ENT_QUOTES );

		// ASCII-ify accented characters
		$site_name = remove_accents( $site_name );

		// Remove non-printable characters
		$site_name = preg_replace( '/[[:^print:]]/', '', $site_name );

		// Clean up leading/trailing whitespace
		$site_name = trim( $site_name );

		return $site_name;

	}

	/**
	 * Force a page refresh when an order is updated to have a zero total and we're not using the "login app" mode.
	 *
	 * This ensures that the standard WC checkout form is rendered.
	 */
	public function force_standard_mode_refresh_with_zero_order_total( $cart ) {

		// Avoid constant reload loop in the event we've forced a checkout refresh
		if ( ! is_ajax() ) {

			unset( WC()->session->reload_checkout );

		}

		// Login app mode can handle zero-total orders
		if ( 'yes' === $this->settings['enable_login_app'] ) {
			return;
		}

		if ( ! $this->gateway->is_available() ) {
			return;
		}

		// Get the previous cart total
		$previous_total = WC()->session->wc_amazon_previous_total;

		// Store the current total
		WC()->session->wc_amazon_previous_total = $cart->total;

		// If the total is non-zero, and we don't know what the previous total was, bail.
		if ( is_null( $previous_total ) || $cart->needs_payment() ) {
			return;
		}

		// This *wasn't* as zero-total order, but is now
		if ( $previous_total > 0 ) {

			// Force reload, re-rendering standard WC checkout form
			WC()->session->reload_checkout = true;

		}

	}

}

$GLOBALS['wc_amazon_payments_advanced'] = new WC_Amazon_Payments_Advanced();
