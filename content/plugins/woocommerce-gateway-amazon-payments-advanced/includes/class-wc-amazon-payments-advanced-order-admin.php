<?php
/**
 * Handle admin orders interface
 */
class WC_Amazon_Payments_Advanced_Order_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'meta_box' ) );
		add_action( 'wp_ajax_amazon_order_action', array( $this, 'order_actions' ) );
	}

	/**
	 * Perform order actions for amazon
	 */
	public function order_actions() {
		check_ajax_referer( 'amazon_order_action', 'security' );

		$order_id = absint( $_POST['order_id'] );
		$id       = isset( $_POST['amazon_id'] ) ? woocommerce_clean( $_POST['amazon_id'] ) : '';
		$action   = sanitize_title( $_POST['amazon_action'] );

		switch ( $action ) {
			case 'refresh' :
				$this->clear_stored_states( $order_id );
			break;
			case 'authorize' :
				// Delete old
				delete_post_meta( $order_id, 'amazon_authorization_id' );
				delete_post_meta( $order_id, 'amazon_capture_id' );

				WC_Amazon_Payments_Advanced_API::authorize_payment( $order_id, $id, false );
				$this->clear_stored_states( $order_id );
			break;
			case 'authorize_capture' :
				// Delete old
				delete_post_meta( $order_id, 'amazon_authorization_id' );
				delete_post_meta( $order_id, 'amazon_capture_id' );

				WC_Amazon_Payments_Advanced_API::authorize_payment( $order_id, $id, true );
				$this->clear_stored_states( $order_id );
			break;
			case 'close_authorization' :
				WC_Amazon_Payments_Advanced_API::close_authorization( $order_id, $id );
				$this->clear_stored_states( $order_id );
			break;
			case 'capture' :
				WC_Amazon_Payments_Advanced_API::capture_payment( $order_id, $id );
				$this->clear_stored_states( $order_id );
			break;
			case 'refund' :
				$amazon_refund_amount = floatval( woocommerce_clean( $_POST['amazon_refund_amount'] ) );
				$amazon_refund_note   = woocommerce_clean( $_POST['amazon_refund_note'] );

				WC_Amazon_Payments_Advanced_API::refund_payment( $order_id, $id, $amazon_refund_amount, $amazon_refund_note );
				$this->clear_stored_states( $order_id );
			break;
		}

		die();
	}

	/**
	 * Wipe states so the value is refreshed
	 */
	public function clear_stored_states( $order_id ) {
		delete_post_meta( $order_id, 'amazon_reference_state' );
		delete_post_meta( $order_id, 'amazon_capture_state' );
		delete_post_meta( $order_id, 'amazon_authorization_state' );
	}

	/**
	 * Amazon Payments authorization metabox
	 */
	public function meta_box() {
		global $post, $wpdb;

		$order_id = absint( $post->ID );
		$order    = new WC_Order( $order_id );

		if ( 'amazon_payments_advanced' == $order->payment_method ) {
			add_meta_box( 'woocommerce-amazon-payments-advanced', __( 'Amazon Payments Advanced', 'woocommerce-gateway-amazon-payments-advanced' ), array( $this, 'authorization_box' ), 'shop_order', 'side' );
		}
	}

	/**
	 * Authorization metabox content.
	 */
	public function authorization_box() {
		global $post, $wpdb, $theorder;

		$actions  = array();
		$order_id = absint( $post->ID );

		if ( ! is_object( $theorder ) ) {
			$theorder = new WC_Order( $order_id );
		}

		// Get ids
		$amazon_authorization_id = get_post_meta( $order_id, 'amazon_authorization_id', true );
		$amazon_reference_id     = get_post_meta( $order_id, 'amazon_reference_id', true );
		$amazon_capture_id       = get_post_meta( $order_id, 'amazon_capture_id', true );
		$amazon_refund_ids       = get_post_meta( $order_id, 'amazon_refund_id', false );

		if ( $amazon_capture_id ) {

			$amazon_capture_state = WC_Amazon_Payments_Advanced_API::get_capture_state( $order_id, $amazon_capture_id );

			switch ( $amazon_capture_state ) {
				case 'Pending' :

					echo wpautop( sprintf( __( 'Capture Reference %s is <strong>%s</strong>.', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_capture_id ), esc_html( $amazon_capture_state ) ) . ' <a href="#" data-action="refresh" class="refresh">' . __( 'Refresh', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>' );

					// Admin will need to re-check this, so clear the stored value
					$this->clear_stored_states( $order_id );
				break;
				case 'Declined' :

					echo wpautop( __( 'The capture was declined.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					$actions['authorize'] = array(
						'id'     => $amazon_reference_id,
						'button' => __( 'Re-authorize?', 'woocommerce-gateway-amazon-payments-advanced' )
					);

				break;
				case 'Completed' :

					echo wpautop( sprintf( __( 'Capture Reference %s is <strong>%s</strong>.', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_capture_id ), esc_html( $amazon_capture_state ) ) . ' <a href="#" class="toggle_refund">' . __( 'Make a refund?', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>' );

					// Refund form
					?>
					<p class="refund_form" style="display:none">
						<input type="number" step="any" style="width:100%" class="amazon_refund_amount" value="<?php echo esc_attr( $theorder->get_total() ); ?>" />
						<input type="text" style="width:100%" class="amazon_refund_note" placeholder="<?php _e( 'Add a note about this refund', 'woocommerce-gateway-amazon-payments-advanced' ); ?>" /><br/>
						<a href="#" class="button" data-action="refund" data-id="<?php echo esc_attr( $amazon_capture_id ); ?>"><?php _e( 'Refund', 'woocommerce-gateway-amazon-payments-advanced' ); ?></a>
					</form>
					<?php

				break;
				case 'Closed' :

					echo wpautop( sprintf( __( 'Capture Reference %s is <strong>%s</strong>.', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_capture_id ), esc_html( $amazon_capture_state ) ) );

				break;
			}

			// Display refunds
			if ( $amazon_refund_ids ) {
				$refunds = (array) get_post_meta( $order_id, 'amazon_refunds', true );

				foreach ( $amazon_refund_ids as $amazon_refund_id ) {

					if ( isset( $refunds[ $amazon_refund_id ] ) ) {
						echo wpautop( sprintf( __( 'Refund %s of %s is <strong>%s</strong> (%s).', 'woocommerce-gateway-amazon-payments-advanced' ), $amazon_refund_id, woocommerce_price( $refunds[ $amazon_refund_id ]['amount'] ), $refunds[ $amazon_refund_id ]['state'], $refunds[ $amazon_refund_id ]['note'] ) );
					} else {

						$response = WC_Amazon_Payments_Advanced_API::request( array(
							'Action'         => 'GetRefundDetails',
							'AmazonRefundId' => $amazon_refund_id,
						) );

						if ( ! is_wp_error( $response ) && ! isset( $response['Error']['Message'] ) ) {

							$note   = (string) $response->GetRefundDetailsResult->RefundDetails->SellerRefundNote;
							$state  = (string) $response->GetRefundDetailsResult->RefundDetails->RefundStatus->State;
							$amount = (string) $response->GetRefundDetailsResult->RefundDetails->RefundAmount->Amount;

							echo wpautop( sprintf( __( 'Refund %s of %s is <strong>%s</strong> (%s).', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_refund_id ), woocommerce_price( $amount ), esc_html( $state ), esc_html( $note ) ) );

							if ( $state == 'Completed' ) {
								$refunds[ $amazon_refund_id ] = array(
									'state'  => $state,
									'amount' => $amount,
									'note'   => $note
								);
							}
						}

					}
				}

				update_post_meta( $order_id, 'amazon_refunds', $refunds );
			}
		}

		elseif ( $amazon_authorization_id ) {

			$amazon_authorization_state = WC_Amazon_Payments_Advanced_API::get_authorization_state( $order_id, $amazon_authorization_id );

			echo wpautop( sprintf( __( 'Auth Reference %s is <strong>%s</strong>.', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_reference_id ), esc_html( $amazon_authorization_state ) ) . ' <a href="#" data-action="refresh" class="refresh">' . __( 'Refresh', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>' );

			switch ( $amazon_authorization_state ) {
				case 'Open' :

					$actions['capture'] = array(
						'id'     => $amazon_authorization_id,
						'button' => __( 'Capture funds', 'woocommerce-gateway-amazon-payments-advanced' )
					);

					$actions['close_authorization'] = array(
						'id'     => $amazon_authorization_id,
						'button' => __( 'Close Authorization', 'woocommerce-gateway-amazon-payments-advanced' )
					);

				break;
				case 'Pending' :

					echo wpautop( __( 'You cannot capture funds whilst the authorization is pending. Try again later.', 'woocommerce-gateway-amazon-payments-advanced' ) );

					// Admin will need to re-check this, so clear the stored value
					$this->clear_stored_states( $order_id );

				break;
				case 'Closed' :
				case 'Declined' :
					$actions['authorize'] = array(
						'id'     => $amazon_reference_id,
						'button' => __( 'Authorize again', 'woocommerce-gateway-amazon-payments-advanced' )
					);
				break;
			}
		}

		elseif ( $amazon_reference_id ) {

			$amazon_reference_state = WC_Amazon_Payments_Advanced_API::get_reference_state( $order_id, $amazon_reference_id );

			echo wpautop( sprintf( __( 'Order Reference %s is <strong>%s</strong>.', 'woocommerce-gateway-amazon-payments-advanced' ), esc_html( $amazon_reference_id ), esc_html( $amazon_reference_state ) ) . ' <a href="#" data-action="refresh" class="refresh">' . __( 'Refresh', 'woocommerce-gateway-amazon-payments-advanced' ) . '</a>' );

			switch ( $amazon_reference_state ) {
				case 'Open' :

					$actions['authorize'] = array(
						'id'     => $amazon_reference_id,
						'button' => __( 'Authorize', 'woocommerce-gateway-amazon-payments-advanced' )
					);

					$actions['authorize_capture'] = array(
						'id'     => $amazon_reference_id,
						'button' => __( 'Authorize &amp; Capture', 'woocommerce-gateway-amazon-payments-advanced' )
					);

				break;
				case 'Suspended' :

					echo wpautop( __( 'The reference has been suspended. Another form of payment is required.', 'woocommerce-gateway-amazon-payments-advanced' ) );

				break;
				case 'Canceled' :
				case 'Suspended' :

					echo wpautop( __( 'The reference has been cancelled/closed. No authorizations can be made.', 'woocommerce-gateway-amazon-payments-advanced' ) );

				break;
			}
		}

		if ( ! empty( $actions ) ) {

			echo '<p class="buttons">';

			foreach ( $actions as $action_name => $action ) {
				echo '<a href="#" class="button" data-action="' . esc_attr( $action_name ) . '" data-id="' . esc_attr( $action['id'] ) . '">' . esc_html( $action['button'] ) . '</a> ';
			}

			echo '</p>';

		}

		$js = "
			jQuery( '#woocommerce-amazon-payments-advanced' ).on( 'click', 'a.button, a.refresh', function() {

				jQuery( '#woocommerce-amazon-payments-advanced' ).block({
					message:    null,
					overlayCSS: {
						background: '#fff url(" . WC()->plugin_url() . "/assets/images/ajax-loader.gif) no-repeat center',
						opacity:    0.6
					}
				});

				var data = {
					action:               'amazon_order_action',
					security:             '" . wp_create_nonce( 'amazon_order_action' ) . "',
					order_id:             '$order_id',
					amazon_action:        jQuery( this ).data( 'action' ),
					amazon_id:            jQuery( this ).data( 'id' ),
					amazon_refund_amount: jQuery( '.amazon_refund_amount' ).val(),
					amazon_refund_note:   jQuery( '.amazon_refund_note' ).val(),
				};

				// Ajax action
				jQuery.ajax({
					url:     '" . admin_url( 'admin-ajax.php' ) . "',
					data:    data,
					type:    'POST',
					success: function( result ) {
						location.reload();
					}
				});

				return false;
			});

			jQuery( '#woocommerce-amazon-payments-advanced' ).on( 'click', 'a.toggle_refund', function() {
				jQuery( '.refund_form' ).slideToggle();
				return false;
			});
		";

		wc_enqueue_js( $js );
	}

}

new WC_Amazon_Payments_Advanced_Order_Admin();
