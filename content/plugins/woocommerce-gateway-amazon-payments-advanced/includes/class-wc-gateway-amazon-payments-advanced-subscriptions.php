<?php
/**
 * WC_Gateway_Amazon_Payments_Advanced_Subscriptions
 */
class WC_Gateway_Amazon_Payments_Advanced_Subscriptions extends WC_Gateway_Amazon_Payments_Advanced {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->supports = array(
			'products',
			'subscriptions',
			'subscription_suspension',
			'subscription_reactivation',
			'subscription_cancellation',
			'multiple_subscriptions',
			'subscription_payment_method_change_customer'
		);

		parent::__construct();

		add_action( 'woocommerce_scheduled_subscription_payment_' . $this->id, array( $this, 'scheduled_subscription_payment' ), 10, 2 );

		add_action( 'woocommerce_subscription_cancelled_' . $this->id, array( $this, 'cancelled_subscription' ) );

		add_action( 'woocommerce_subscription_failing_payment_method_updated_' . $this->id, array( $this, 'update_failing_payment_method' ), 10, 2 );

	}

	/**
	 * Enforce: "Amazon imposes a $500 per calendar month limit on the amount of funds you can charge a buyer."
	 * See: https://payments.amazon.com/documentation/automatic/201752090#201757640
	 *
	 * @return bool
	 */
	function is_available() {

		$is_available = parent::is_available();

		if ( $is_available && WC_Subscriptions_Cart::cart_contains_subscription() ) {

			$potential_monthly_max = $this->calculate_potential_monthly_maximum_payment_in_cart();

			if ( $potential_monthly_max > 500 ) {

				return false;

			}

		}

		return $is_available;

	}

	/**
	 * Determine the maximum monthly payment required for subscriptions currently in cart.
	 * This is an approximation based on 31 day months.
	 *
	 * @return float
	 */
	protected function calculate_potential_monthly_maximum_payment_in_cart() {

		$potential_monthly_max = 0;

		foreach ( WC()->cart->cart_contents as $cart_item ) {

			$product_subscription = $cart_item['data'];
			$item_quantity        = absint( $cart_item['quantity'] );

			if ( WC_Subscriptions_Product::is_subscription( $product_subscription ) ) {

				$subscription_price       = (float) $product_subscription->subscription_price;
				$subscription_interval    = (float) $product_subscription->subscription_period_interval;
				$subscription_monthly_max = $item_quantity * $subscription_price;

				if ( 'day' === $product_subscription->subscription_period ) {

					$subscription_monthly_max = $subscription_price * ( 31 / $subscription_interval );

				} else if ( 'week' === $product_subscription->subscription_period ) {

					$subscription_monthly_max = $subscription_price * ceil( 4 / $subscription_interval );

				}

				$potential_monthly_max += $subscription_monthly_max;

			}

		}

		return $potential_monthly_max;

	}

	/**
	 * Check if order contains subscriptions.
	 *
	 * @param  int $order_id
	 * @return bool
	 */
	protected function order_contains_subscription( $order_id ) {
		return function_exists( 'wcs_order_contains_subscription' ) && ( wcs_order_contains_subscription( $order_id ) || wcs_order_contains_renewal( $order_id ) );
	}

	/**
	 * Process payment
	 *
	 * @param int $order_id
	 */
	public function process_payment( $order_id ) {

		if ( ! $this->order_contains_subscription( $order_id ) && ! wcs_is_subscription( $order_id ) ) {

			return parent::process_payment( $order_id );

		}

		$amazon_billing_agreement_id = isset( $_POST['amazon_billing_agreement_id'] ) ? wc_clean( $_POST['amazon_billing_agreement_id'] ) : '';

		try {

			if ( ! $amazon_billing_agreement_id ) {
				throw new Exception( __( 'An Amazon payment method was not chosen.', 'woocommerce-gateway-amazon-payments-advanced' ) );
			}

			$order       = new WC_Order( $order_id );
			$order_total = $order->get_total();

			$this->log( __FUNCTION__, "Info: Beginning processing of payment for (subscription) order {$order_id} for the amount of {$order_total} {$order->get_order_currency()}." );

			// Set the Billing Agreement Details
			$this->set_billing_agreement_details( $order, $amazon_billing_agreement_id );

			// Confirm the Billing Agreement
			$this->confirm_billing_agreement( $order_id, $amazon_billing_agreement_id );

			// Get the Billing Agreement Details, with FULL address (now that we've confirmed)
			$result = $this->get_billing_agreement_details( $order_id, $amazon_billing_agreement_id );

			// Store the subscription destination
			$this->store_subscription_destination( $order_id, $result );

			// Store Billing Agreement ID on the order and it's subscriptions
			$result = update_post_meta( $order_id, 'amazon_billing_agreement_id', $amazon_billing_agreement_id );

			if ( $result ) {

				$this->log( __FUNCTION__, "Info: Successfully stored billing agreement in meta for order {$order_id}." );

			} else {

				$this->log( __FUNCTION__, "Error: Failed to store billing agreement in meta for order {$order_id}." );

			}

			$subscriptions = wcs_get_subscriptions_for_order( $order_id );

			foreach ( $subscriptions as $subscription ) {

				$result = update_post_meta( $subscription->id, 'amazon_billing_agreement_id', $amazon_billing_agreement_id );

				if ( $result ) {

					$this->log( __FUNCTION__, "Info: Successfully stored billing agreement in meta for subscription {$subscription->id} (parent order {$order_id})." );

				} else {

					$this->log( __FUNCTION__, "Error: Failed to store billing agreement in meta for subscription {$subscription->id} (parent order {$order_id})." );

				}

			}

			// Authorize/Capture initial payment, if initial payment required
			if ( $order_total > 0 ) {

				return $this->authorize_payment( $order, $amazon_billing_agreement_id );

			}

			// No payment needed now, free trial or coupon used - mark order as complete
			$order->payment_complete();

			$this->log( __FUNCTION__, "Info: Zero-total initial payment for (subscription) order {$order_id}. Payment marked as complete." );

			// Remove items from cart
			WC()->cart->empty_cart();

			// Return thank you page redirect
			return array(
				'result'   => 'success',
				'redirect' => $this->get_return_url( $order )
			);

		} catch( Exception $e ) {

			$this->log( __FUNCTION__, "Error: Exception encountered: {$e->getMessage()}" );

			wc_add_notice( sprintf( __( 'Error: %s', 'woocommerce-gateway-amazon-payments-advanced' ), $e->getMessage() ), 'error' );

			return;

		}

	}

	/**
	 * Use 'SetBillingAgreementDetails' action to update details of the billing agreement.
	 * See: https://payments.amazon.com/documentation/apireference/201751700
	 *
	 * @param WC_Order $order
	 * @param string   $amazon_billing_agreement_id
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function set_billing_agreement_details( $order, $amazon_billing_agreement_id ) {

		$site_name        = WC_Amazon_Payments_Advanced::get_site_name();
		$subscriptions    = wcs_get_subscriptions_for_order( $order );
		$subscription_ids = wp_list_pluck( $subscriptions, 'id' );

		$request_args = array(
			'Action'                                                                               => 'SetBillingAgreementDetails',
			'AmazonBillingAgreementId'                                                             => $amazon_billing_agreement_id,
			'BillingAgreementAttributes.SellerNote'                                                => sprintf( __( 'Order %s from %s.', 'woocommerce-gateway-amazon-payments-advanced' ), $order->get_order_number(), urlencode( $site_name ) ),
			'BillingAgreementAttributes.SellerBillingAgreementAttributes.SellerBillingAgreementId' => sprintf( __( 'Subscription(s): %s.', 'woocommerce-gateway-amazon-payments-advanced' ), implode( ', ', $subscription_ids ) ),
			'BillingAgreementAttributes.SellerBillingAgreementAttributes.StoreName'                => $site_name,
			'BillingAgreementAttributes.PlatformId'                                                => 'A1BVJDFFHQ7US4'
		);

		// Update order reference with amounts
		$response = WC_Amazon_Payments_Advanced_API::request( $request_args );

		$this->handle_generic_api_response_errors( __FUNCTION__, $response, $order->id, $amazon_billing_agreement_id );

		$this->log( __FUNCTION__, "Info: SetBillingAgreementDetails for order {$order->id} with billing agreement: {$amazon_billing_agreement_id}." );

		return $response;

	}

	/**
	 * Use 'ConfirmBillingAgreement' action to confirm the billing agreement.
	 * See: https://payments.amazon.com/documentation/apireference/201751710
	 *
	 * @param int    $order_id
	 * @param string $amazon_billing_agreement_id
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function confirm_billing_agreement( $order_id, $amazon_billing_agreement_id ) {

		$response = WC_Amazon_Payments_Advanced_API::request( array(
			'Action'                   => 'ConfirmBillingAgreement',
			'AmazonBillingAgreementId' => $amazon_billing_agreement_id
		) );

		$this->handle_generic_api_response_errors( __FUNCTION__, $response, $order_id, $amazon_billing_agreement_id );

		$this->log( __FUNCTION__, "Info: ConfirmBillingAgreement for Billing Agreement ID: {$amazon_billing_agreement_id}." );

		return $response;

	}

	/**
	 * Use 'ValidateBillingAgreement' action to validate the billing agreement.
	 * See: https://payments.amazon.com/documentation/automatic/201752090#201757360
	 *
	 * @param string $amazon_billing_agreement_id
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function validate_billing_agreement( $amazon_billing_agreement_id ) {

		$response = WC_Amazon_Payments_Advanced_API::request( array(
			'Action'                   => 'ValidateBillingAgreement',
			'AmazonBillingAgreementId' => $amazon_billing_agreement_id
		) );

		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		if ( isset( $response->Error->Message ) ) {
			throw new Exception( (string) $response->Error->Message );
		}

		if ( isset( $response->ValidateBillingAgreementResult->FailureReasonCode ) ) {
			throw new Exception( (string) $response->ValidateBillingAgreementResult->FailureReasonCode );
		}

		return $response;

	}

	/**
	 * Authorize (and potentially capture) payment for an order w/subscriptions
	 *
	 * @param $order
	 * @param $amazon_billing_agreement_id
	 *
	 * @return array
	 */
	function authorize_payment( $order, $amazon_billing_agreement_id ) {

		switch ( $this->payment_capture ) {

			case 'manual' :

				// Mark as on-hold
				$order->update_status( 'on-hold', __( 'Amazon order opened. Use the "Amazon Payments Advanced" box to authorize and/or capture payment. Authorized payments must be captured within 7 days.', 'woocommerce-gateway-amazon-payments-advanced' ) );

				// Reduce stock levels
				$order->reduce_order_stock();

				$this->log( __FUNCTION__, "Info: 'manual' payment_capture processed for (subscription) order {$order->id}." );

				break;

			case 'authorize' :

				// Authorize only
				$result = WC_Amazon_Payments_Advanced_API::authorize_recurring_payment( $order->id, $amazon_billing_agreement_id, false );

				if ( $result ) {

					// Mark as on-hold
					$order->update_status( 'on-hold', __( 'Amazon order opened. Use the "Amazon Payments Advanced" box to authorize and/or capture payment. Authorized payments must be captured within 7 days.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					// Reduce stock levels
					$order->reduce_order_stock();

					$this->log( __FUNCTION__, "Info: 'authorize' payment_capture processed for (subscription) order {$order->id}." );

				} else {

					$order->update_status( 'failed', __( 'Could not authorize Amazon payment.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					$this->log( __FUNCTION__, "Error: 'authorize' payment_capture failed for (subscription) order {$order->id}." );

				}

				break;

			default :

				// Capture
				$result = WC_Amazon_Payments_Advanced_API::authorize_recurring_payment( $order->id, $amazon_billing_agreement_id, true );

				if ( $result ) {

					// Payment complete
					$order->payment_complete();

					$this->log( __FUNCTION__, "Info: authorize and capture processed for (subscription) order {$order->id}." );

				} else {

					$order->update_status( 'failed', __( 'Could not authorize Amazon payment.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					$this->log( __FUNCTION__, "Error: authorize and capture failed for (subscription) order {$order->id}." );

				}

				break;

		}

		// Remove cart
		WC()->cart->empty_cart();

		// Return thank you page redirect
		return array(
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order )
		);

	}

	/**
	 * Process a scheduled subscription payment.
	 *
	 * @param $amount_to_charge float The amount to charge.
	 * @param $order WC_Order The WC_Order object of the order which the subscription was purchased in.
	 */
	function scheduled_subscription_payment( $amount_to_charge, $order ) {

		$amazon_billing_agreement_id = get_post_meta( $order->id, 'amazon_billing_agreement_id', true );

		try {

			if ( ! $amazon_billing_agreement_id ) {

				throw new Exception( __( 'An Amazon Billing Agreement ID was not found.', 'woocommerce-gateway-amazon-payments-advanced' ) );

			}

			$this->log( __FUNCTION__, "Info: Begin recurring payment for (subscription) order {$order->id} for the amount of {$order->get_total()} {$order->get_order_currency()}." );

			// 'AuthorizeOnBillingAgreement' has a maximum request quota of 10 and a restore rate of one request every second
			// In sandbox mode, quota = 2 and restore = one every two seconds
			// See: https://payments.amazon.com/documentation/apireference/201751630#201751940
			$settings = WC_Amazon_Payments_Advanced_API::get_settings();

			sleep( ( 'yes' === $settings['sandbox'] ) ? 2 : 1 );

			// Authorize/Capture recurring payment
			$result = WC_Amazon_Payments_Advanced_API::authorize_recurring_payment( $order->id, $amazon_billing_agreement_id, true );

			if ( $result ) {

				// Payment complete
				$order->payment_complete();

				$this->log( __FUNCTION__, "Info: Successful recurring payment for (subscription) order {$order->id} for the amount of {$order->get_total()} {$order->get_order_currency()}." );

			} else {

				$order->update_status( 'failed', __( 'Could not authorize Amazon payment.', 'woocommerce-gateway-amazon-payments-advanced' ) );

				$this->log( __FUNCTION__, "Error: Could not authorize Amazon payment for (subscription) order {$order->id} for the amount of {$order->get_total()} {$order->get_order_currency()}." );

			}

		} catch( Exception $e ) {

			$order->add_order_note( sprintf( __( 'Amazon subscription renewal failed - %s', 'woocommerce-gateway-amazon-payments-advanced' ), $e->getMessage() ) );

			$this->log( __FUNCTION__, "Error: Exception encountered: {$e->getMessage()}" );

		}

	}

	/**
	 * Use 'GetBillingAgreementDetails' action to retrieve details of the billing agreement.
	 * See: https://payments.amazon.com/documentation/apireference/201751710#201751690
	 *
	 * @param int    $order_id
	 * @param string $amazon_billing_agreement_id
	 *
	 * @return WP_Error|array WP_Error or parsed response array
	 * @throws Exception
	 */
	function get_billing_agreement_details( $order_id, $amazon_billing_agreement_id ) {

		$response = WC_Amazon_Payments_Advanced_API::request( array(
			'Action'                   => 'GetBillingAgreementDetails',
			'AmazonBillingAgreementId' => $amazon_billing_agreement_id,
		) );

		$this->handle_generic_api_response_errors( __FUNCTION__, $response, $order_id, $amazon_billing_agreement_id );

		$this->log( __FUNCTION__, "Info: GetBillingAgreementDetails for Billing Agreement ID: {$amazon_billing_agreement_id}." );

		return $response;

	}

	/**
	 * Store the billing and shipping addresses for this order in meta
	 * for both the order and the subscriptions it contains
	 *
	 * @param int    $order_id
	 * @param object $response SetBillingAgreementDetails response object
	 */
	function store_subscription_destination( $order_id, $response ) {

		if ( ! is_wp_error( $response ) && isset( $response->GetBillingAgreementDetailsResult->BillingAgreementDetails->Destination->PhysicalDestination ) ) {

			$billing_agreement_details = $response->GetBillingAgreementDetailsResult->BillingAgreementDetails;

			$this->store_order_address_details( $order_id, $billing_agreement_details );

			$subscriptions = wcs_get_subscriptions_for_order( $order_id );

			foreach ( $subscriptions as $subscription ) {

				$this->store_order_address_details( $subscription->id, $billing_agreement_details );

			}

		}

	}

	/**
	 * Use 'CloseBillingAgreement' to disallow future authorizations after cancelling a subscription.
	 *
	 * @param WC_Order $order
	 */
	function cancelled_subscription( $order ) {

		$amazon_billing_agreement_id = get_post_meta( $order->id, 'amazon_billing_agreement_id', true );

		if ( $amazon_billing_agreement_id ) {

			try {

				// 'CloseBillingAgreement' has a maximum request quota of 10 and a restore rate of one request every second
				// In sandbox mode, quota = 2 and restore = one every two seconds
				// https://payments.amazon.com/documentation/apireference/201751710#201751950
				$settings = WC_Amazon_Payments_Advanced_API::get_settings();

				sleep( ( 'yes' === $settings['sandbox'] ) ? 2 : 1 );

				$response = WC_Amazon_Payments_Advanced_API::request( array(
					'Action'                   => 'CloseBillingAgreement',
					'AmazonBillingAgreementId' => $amazon_billing_agreement_id
				) );

				$this->handle_generic_api_response_errors( __FUNCTION__, $response, $order->id, $amazon_billing_agreement_id );

				$this->log( __FUNCTION__, "Info: CloseBillingAgreement for order {$order->id} with billing agreement: {$amazon_billing_agreement_id}." );

			} catch ( Exception $e ) {

				$this->log( __FUNCTION__, "Error: Exception encountered: {$e->getMessage()}" );

				$order->add_order_note( sprintf( __( "Exception encountered in 'CloseBillingAgreement': %s" ), $e->getMessage() ) );

			}

		} else {

			$this->log( __FUNCTION__, "Error: No Amazon billing agreement found for order {$order->id}." );

		}

	}

	/**
	 * Convenience method to process generic Amazon API response errors.
	 *
	 * @param string $context
	 * @param object $response
	 * @param int    $order_id
	 * @param string $amazon_billing_agreement_id
	 *
	 * @throws Exception
	 */
	protected function handle_generic_api_response_errors( $context, $response, $order_id, $amazon_billing_agreement_id ) {

		if ( is_wp_error( $response ) ) {

			$error_message = $response->get_error_message();

			$this->log( $context, "Error: WP_Error '{$error_message}' for order {$order_id} with billing agreement: {$amazon_billing_agreement_id}." );

			throw new Exception( $error_message );

		}

		if ( isset( $response->Error->Message ) ) {

			$error_message = (string) $response->Error->Message;

			$this->log( $context, "Error: API Error '{$error_message}' for order {$order_id} with billing agreement: {$amazon_billing_agreement_id}." );

			throw new Exception( $error_message );
		}

	}

	/**
	 * Copy over the billing reference id and billing/shipping address info from a successful manual
	 * payment for a failed renewal.
	 *
	 * @param WC_Subscription $subscription The subscription for which the failing payment method relates.
	 * @param WC_Order $renewal_order The order which recorded the successful payment (to make up for the failed automatic payment).
	 */
	function update_failing_payment_method( $subscription, $renewal_order ) {

		$meta_keys_to_copy = array(
			'amazon_billing_agreement_id',
			'_billing_first_name',
			'_billing_last_name',
			'_billing_email',
			'_billing_phone',
			'_shipping_first_name',
			'_shipping_last_name',
			'_shipping_company',
			'_shipping_address_1',
			'_shipping_address_2',
			'_shipping_city',
			'_shipping_postcode',
			'_shipping_state',
			'_shipping_country'
		);

		foreach ( $meta_keys_to_copy as $meta_key ) {

			$meta_value = get_post_meta( $renewal_order->id, $meta_key, true );

			if ( $meta_value ) {

				update_post_meta( $subscription->id, $meta_key, $meta_value );

			}

		}

	}

	/**
	 * Retrieve full details from the order using 'GetBillingAgreementDetails' (if it contains a subscription).
	 *
	 * @param string $amazon_reference_id
	 *
	 * @return bool|object Boolean false on failure, object of OrderReferenceDetails on success.
	 */
	function get_amazon_order_details( $amazon_reference_id ) {

		if ( ! WC_Subscriptions_Cart::cart_contains_subscription() ) {

			return parent::get_amazon_order_details( $amazon_reference_id );

		}

		$response = WC_Amazon_Payments_Advanced_API::request( array(
			'Action'                   => 'GetBillingAgreementDetails',
			'AmazonBillingAgreementId' => $amazon_reference_id
		) );

		if ( ! is_wp_error( $response ) && isset( $response->GetBillingAgreementDetailsResult->BillingAgreementDetails ) ) {

			return $response->GetBillingAgreementDetailsResult->BillingAgreementDetails;

		}

		return false;

	}

}
