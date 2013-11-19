<?php
/**
 * WC_Shipping_UPS class.
 *
 * @extends WC_Shipping_Method
 */
class WC_Shipping_UPS extends WC_Shipping_Method {

	private $endpoint = 'https://www.ups.com/ups.app/xml/Rate';

	private $pickup_code = array(
		'01' => "Daily Pickup",
		'03' => "Customer Counter",
		'06' => "One Time Pickup",
		'07' => "On Call Air",
		'19' => "Letter Center",
		'20' => "Air Service Center",
	);

	private $services = array(
		// Domestic
		"12" => "3 Day Select",
		"03" => "Ground",
		"02" => "2nd Day Air",
		"59" => "2nd Day Air AM",
		"01" => "Next Day Air",
		"13" => "Next Day Air Saver",
		"14" => "Next Day Air Early AM",

		// International
		"11" => "Standard",
		"07" => "Worldwide Express",
		"54" => "Worldwide Express Plus",
		"08" => "Worldwide Expedited",
		"65" => "Saver",

	);

	// Packaging not offered at this time: 00 = UNKNOWN, 30 = Pallet, 04 = Pak
	// Code 21 = Express box is valid code, but doesn't have dimensions
	// References:
	// http://www.ups.com/content/us/en/resources/ship/packaging/supplies/envelopes.html
	// http://www.ups.com/content/us/en/resources/ship/packaging/supplies/paks.html
	// http://www.ups.com/content/us/en/resources/ship/packaging/supplies/boxes.html
	private $packaging = array(
		"01" => array(
					"name" 	 => "UPS Letter",
					"length" => "12.5",
					"width"  => "9.5",
					"height" => "0.25",
					"weight" => "0.5"
				),
		"03" => array(
					"name" 	 => "Tube",
					"length" => "38",
					"width"  => "6",
					"height" => "6",
					"weight" => "100"
				),
		"24" => array(
					"name" 	 => "25KG Box",
					"length" => "19.375",
					"width"  => "17.375",
					"height" => "14",
					"weight" => "25"
				),
		"25" => array(
					"name" 	 => "10KG Box",
					"length" => "16.5",
					"width"  => "13.25",
					"height" => "10.75",
					"weight" => "10"
				),
		"2a" => array(
					"name" 	 => "Small Express Box",
					"length" => "13",
					"width"  => "11",
					"height" => "2",
					"weight" => "100"
				),
		"2b" => array(
					"name" 	 => "Medium Express Box",
					"length" => "15",
					"width"  => "11",
					"height" => "3",
					"weight" => "100"
				),
		"2c" => array(
					"name" 	 => "Large Express Box",
					"length" => "18",
					"width"  => "13",
					"height" => "3",
					"weight" => "30"
				)
	);

	private $packaging_select = array(
		"01" => "UPS Letter",
		"03" => "Tube",
		"24" => "25KG Box",
		"25" => "10KG Box",
		"2a" => "Small Express Box",
		"2b" => "Medium Express Box",
		"2c" => "Large Express Box",
	);

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->id                 = 'ups';
		$this->method_title       = __( 'UPS', 'wc_ups' );
		$this->method_description = __( 'The <strong>UPS</strong> extension obtains rates dynamically from the UPS API during cart/checkout.', 'wc_ups' );
		$this->init();
	}

    /**
     * init function.
     *
     * @access public
     * @return void
     */
    private function init() {
		global $woocommerce;
		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->enabled			= isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : $this->enabled;
		$this->title			= isset( $this->settings['title'] ) ? $this->settings['title'] : $this->method_title;
		$this->availability    	= isset( $this->settings['availability'] ) ? $this->settings['availability'] : 'all';
		$this->countries       	= isset( $this->settings['countries'] ) ? $this->settings['countries'] : array();

		// API Settings
		$this->user_id         	= isset( $this->settings['user_id'] ) ? $this->settings['user_id'] : '';
		$this->password        	= isset( $this->settings['password'] ) ? $this->settings['password'] : '';
		$this->access_key      	= isset( $this->settings['access_key'] ) ? $this->settings['access_key'] : '';
		$this->shipper_number  	= isset( $this->settings['shipper_number'] ) ? $this->settings['shipper_number'] : '';
		$this->negotiated      	= isset( $this->settings['negotiated'] ) && $this->settings['negotiated'] == 'yes' ? true : false;
		$this->origin_postcode 	= isset( $this->settings['origin_postcode'] ) ? $this->settings['origin_postcode'] : '';
		$this->origin_country_state   = isset( $this->settings['origin_country_state'] ) ? $this->settings['origin_country_state'] : '';
		$this->debug      		= isset( $this->settings['debug'] ) && $this->settings['debug'] == 'yes' ? true : false;

		// Pickup and Destination
		$this->pickup			= isset( $this->settings['pickup'] ) ? $this->settings['pickup'] : '01';
		$this->residential		= isset( $this->settings['residential'] ) && $this->settings['residential'] == 'yes' ? true : false;

		// Services and Packaging
		$this->offer_rates     	= isset( $this->settings['offer_rates'] ) ? $this->settings['offer_rates'] : 'all';
		$this->fallback		   	= ! empty( $this->settings['fallback'] ) ? $this->settings['fallback'] : '';
		$this->packing_method  	= isset( $this->settings['packing_method'] ) ? $this->settings['packing_method'] : 'per_item';
		$this->ups_packaging	= isset( $this->settings['ups_packaging'] ) ? $this->settings['ups_packaging'] : array();
		$this->custom_services  = isset( $this->settings['services'] ) ? $this->settings['services'] : array();
		$this->boxes           	= isset( $this->settings['boxes'] ) ? $this->settings['boxes'] : array();

		// Units
		$this->units			= isset( $this->settings['units'] ) ? $this->settings['units'] : 'imperial';

		if ( $this->units == 'metric' ) {
			$this->weight_unit = 'KGS';
			$this->dim_unit    = 'CM';
		} else {
			$this->weight_unit = 'LBS';
			$this->dim_unit    = 'IN';
		}

		if (strstr($this->origin_country_state, ':')) :
    		$this->origin_country = current(explode(':',$this->origin_country_state));
    		$this->origin_state   = end(explode(':',$this->origin_country_state));
    	else :
    		$this->origin_country = $this->origin_country_state;
    		$this->origin_state   = '';
    	endif;

		if ( $this->origin_country == 'PL' ) {
			// Valid Poland to Poland Same Day values
			$this->services["82"] = "UPS Today Standard";
			$this->services["83"] = "UPS Today Dedicated Courier";
			$this->services["84"] = "UPS Today Intercity";
			$this->services["85"] = "UPS Today Express";
			$this->services["86"] = "UPS Today Express Saver";
		}

		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'clear_transients' ) );

	}

	/**
	 * environment_check function.
	 *
	 * @access public
	 * @return void
	 */
	private function environment_check() {
		global $woocommerce;

		$error_message = '';

		// Check for UPS User ID
		if ( ! $this->user_id && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the UPS User ID has not been set.', 'wc_ups' ) . '</p>';
		}

		// Check for UPS Password
		if ( ! $this->password && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the UPS Password has not been set.', 'wc_ups' ) . '</p>';
		}

		// Check for UPS Access Key
		if ( ! $this->access_key && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the UPS Access Key has not been set.', 'wc_ups' ) . '</p>';
		}

		// Check for UPS Shipper Number
		if ( ! $this->shipper_number && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the UPS Shipper Number has not been set.', 'wc_ups' ) . '</p>';
		}

		// Check for Origin Postcode
		if ( ! $this->origin_postcode && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the origin postcode has not been set.', 'wc_ups' ) . '</p>';
		}

		// Check for Origin country
		if ( ! $this->origin_country_state && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but the origin country/state has not been set.', 'wc_ups' ) . '</p>';
		}

		// If user has selected to pack into boxes,
		// Check if at least one UPS packaging is chosen, or a custom box is defined
		if ( ( $this->packing_method == 'box_packing' ) && ( $this->enabled == 'yes' ) ) {
			if ( empty( $this->ups_packaging )  && empty( $this->boxes ) ){
				$error_message .= '<p>' . __( 'UPS is enabled, and Parcel Packing Method is set to \'Pack into boxes\', but no UPS Packaging is selected and there are no custom boxes defined. Items will be packed individually.', 'wc_ups' ) . '</p>';
			}
		}

		// Check for at least one service enabled
		$ctr=0;
		if ( isset($this->custom_services ) && is_array( $this->custom_services ) ){
			foreach ( $this->custom_services as $key => $values ){
				if ( $values['enabled'] == 1)
					$ctr++;
			}
		}
		if ( ( $ctr == 0 ) && $this->enabled == 'yes' ) {
			$error_message .= '<p>' . __( 'UPS is enabled, but there are no services enabled.', 'wc_ups' ) . '</p>';
		}


		if ( ! $error_message == '' ) {
			echo '<div class="error">';
			echo $error_message;
			echo '</div>';
		}


	}

	/**
	 * admin_options function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_options() {
		// Check users environment supports this method
		$this->environment_check();

		// Show settings
		parent::admin_options();
	}

	/**
	 *
	 * generate_single_select_country_html function
	 *
	 * @access public
	 * @return void
	 */
	function generate_single_select_country_html() {
		global $woocommerce;

		ob_start();
		?>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="origin_country"><?php _e( 'Origin Country', 'wc_ups' ); ?></label>
			</th>
            <td class="forminp"><select name="woocommerce_ups_origin_country_state" id="woocommerce_ups_origin_country_state" style="width: 250px;" data-placeholder="<?php _e('Choose a country&hellip;', 'woocommerce'); ?>" title="Country" class="chosen_select">
	        	<?php echo $woocommerce->countries->country_dropdown_options( $this->origin_country, $this->origin_state ? $this->origin_state : '*' ); ?>
	        </select> <span class="description"><?php _e( 'Enter the country for the <strong>sender</strong>.', 'wc_ups' ) ?></span>
       		</td>
       	</tr>
		<?php
		return ob_get_clean();
	}

	/**
	 * generate_services_html function.
	 *
	 * @access public
	 * @return void
	 */
	function generate_services_html() {
		ob_start();
		?>
		<tr valign="top" id="service_options">
			<th scope="row" class="titledesc"><?php _e( 'Services', 'wc_ups' ); ?></th>
			<td class="forminp">
				<table class="ups_services widefat">
					<thead>
						<th class="sort">&nbsp;</th>
						<th><?php _e( 'Service Code', 'wc_ups' ); ?></th>
						<th><?php _e( 'Name', 'wc_ups' ); ?></th>
						<th><?php _e( 'Enabled', 'wc_ups' ); ?></th>
						<th><?php echo sprintf( __( 'Price Adjustment (%s)', 'wc_ups' ), get_woocommerce_currency_symbol() ); ?></th>
						<th><?php _e( 'Price Adjustment (%)', 'wc_ups' ); ?></th>
					</thead>
					<tfoot>
						<tr>
							<th colspan="6">
								<small class="description"><?php _e( '<strong>Domestic Rates</strong>: Next Day Air, 2nd Day Air, Ground, 3 Day Select, Next Day Air Saver, Next Day Air Early AM, 2nd Day Air AM', 'wc_ups' ); ?></small><br/>
								<small class="description"><?php _e( '<strong>International Rates</strong>: Worldwide Express, Worldwide Expedited, Standard, Worldwide Express Plus, UPS Saver', 'wc_ups' ); ?></small>
							</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$sort = 0;
							$this->ordered_services = array();

							foreach ( $this->services as $code => $name ) {

								if ( isset( $this->custom_services[ $code ]['order'] ) ) {
									$sort = $this->custom_services[ $code ]['order'];
								}

								while ( isset( $this->ordered_services[ $sort ] ) )
									$sort++;

								$this->ordered_services[ $sort ] = array( $code, $name );

								$sort++;
							}

							ksort( $this->ordered_services );

							foreach ( $this->ordered_services as $value ) {
								$code = $value[0];
								$name = $value[1];
								?>
								<tr>
									<td class="sort"><input type="hidden" class="order" name="ups_service[<?php echo $code; ?>][order]" value="<?php echo isset( $this->custom_services[ $code ]['order'] ) ? $this->custom_services[ $code ]['order'] : ''; ?>" /></td>
									<td><strong><?php echo $code; ?></strong></td>
									<td><input type="text" name="ups_service[<?php echo $code; ?>][name]" placeholder="<?php echo $name; ?> (<?php echo $this->title; ?>)" value="<?php echo isset( $this->custom_services[ $code ]['name'] ) ? $this->custom_services[ $code ]['name'] : ''; ?>" size="50" /></td>
									<td><input type="checkbox" name="ups_service[<?php echo $code; ?>][enabled]" <?php checked( ( ! isset( $this->custom_services[ $code ]['enabled'] ) || ! empty( $this->custom_services[ $code ]['enabled'] ) ), true ); ?> /></td>
									<td><input type="text" name="ups_service[<?php echo $code; ?>][adjustment]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ]['adjustment'] ) ? $this->custom_services[ $code ]['adjustment'] : ''; ?>" size="4" /></td>
									<td><input type="text" name="ups_service[<?php echo $code; ?>][adjustment_percent]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ]['adjustment_percent'] ) ? $this->custom_services[ $code ]['adjustment_percent'] : ''; ?>" size="4" /></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</td>
		</tr>
		<?php
		return ob_get_clean();
	}


	/**
	 * generate_box_packing_html function.
	 *
	 * @access public
	 * @return void
	 */
	public function generate_box_packing_html() {
		ob_start();
		?>
		<tr valign="top" id="packing_options">
			<th scope="row" class="titledesc"><?php _e( 'Custom Boxes', 'wc_ups' ); ?></th>
			<td class="forminp">
				<style type="text/css">
					.ups_boxes td, .ups_services td {
						vertical-align: middle;
						padding: 4px 7px;
					}
					.ups_boxes td input {
						margin-right: 4px;
					}
					.ups_boxes .check-column {
						vertical-align: middle;
						text-align: left;
						padding: 0 7px;
					}
					.ups_services th.sort {
						width: 16px;
					}
					.ups_services td.sort {
						cursor: move;
						width: 16px;
						padding: 0;
						cursor: move;
						background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAHUlEQVQYV2O8f//+fwY8gJGgAny6QXKETRgEVgAAXxAVsa5Xr3QAAAAASUVORK5CYII=) no-repeat center;					}
				</style>
				<table class="ups_boxes widefat">
					<thead>
						<tr>
							<th class="check-column"><input type="checkbox" /></th>
							<th><?php _e( 'Outer Length', 'wc_ups' ); ?></th>
							<th><?php _e( 'Outer Width', 'wc_ups' ); ?></th>
							<th><?php _e( 'Outer Height', 'wc_ups' ); ?></th>
							<th><?php _e( 'Inner Length', 'wc_ups' ); ?></th>
							<th><?php _e( 'Inner Width', 'wc_ups' ); ?></th>
							<th><?php _e( 'Inner Height', 'wc_ups' ); ?></th>
							<th><?php _e( 'Box Weight', 'wc_ups' ); ?></th>
							<th><?php _e( 'Max Weight', 'wc_ups' ); ?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th colspan="3">
								<a href="#" class="button plus insert"><?php _e( 'Add Box', 'wc_ups' ); ?></a>
								<a href="#" class="button minus remove"><?php _e( 'Remove selected box(es)', 'wc_ups' ); ?></a>
							</th>
							<th colspan="6">
								<small class="description"><?php _e( 'Items will be packed into these boxes depending based on item dimensions and volume. Outer dimensions will be passed to UPS, whereas inner dimensions will be used for packing. Items not fitting into boxes will be packed individually.', 'wc_ups' ); ?></small>
							</th>
						</tr>
					</tfoot>
					<tbody id="rates">
						<?php
							if ( $this->boxes && ! empty( $this->boxes ) ) {
								foreach ( $this->boxes as $key => $box ) {
									?>
									<tr>
										<td class="check-column"><input type="checkbox" /></td>
										<td><input type="text" size="5" name="boxes_outer_length[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['outer_length'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_outer_width[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['outer_width'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_outer_height[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['outer_height'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_inner_length[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['inner_length'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_inner_width[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['inner_width'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_inner_height[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['inner_height'] ); ?>" /><?php echo $this->dim_unit; ?></td>
										<td><input type="text" size="5" name="boxes_box_weight[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['box_weight'] ); ?>" /><?php echo $this->weight_unit; ?></td>
										<td><input type="text" size="5" name="boxes_max_weight[<?php echo $key; ?>]" value="<?php echo esc_attr( $box['max_weight'] ); ?>" /><?php echo $this->weight_unit; ?></td>
									</tr>
									<?php
								}
							}
						?>
					</tbody>
				</table>
				<script type="text/javascript">

					jQuery(window).load(function(){

						jQuery('.ups_boxes .insert').click( function() {
							var $tbody = jQuery('.ups_boxes').find('tbody');
							var size = $tbody.find('tr').size();
							var code = '<tr class="new">\
									<td class="check-column"><input type="checkbox" /></td>\
									<td><input type="text" size="5" name="boxes_outer_length[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_outer_width[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_outer_height[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_inner_length[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_inner_width[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_inner_height[' + size + ']" /><?php echo $this->dim_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_box_weight[' + size + ']" /><?php echo $this->weight_unit; ?></td>\
									<td><input type="text" size="5" name="boxes_max_weight[' + size + ']" /><?php echo $this->weight_unit; ?></td>\
								</tr>';

							$tbody.append( code );

							return false;
						} );

						jQuery('.ups_boxes .remove').click(function() {
							var $tbody = jQuery('.ups_boxes').find('tbody');

							$tbody.find('.check-column input:checked').each(function() {
								jQuery(this).closest('tr').hide().find('input').val('');
							});

							return false;
						});

						// Ordering
						jQuery('.ups_services tbody').sortable({
							items:'tr',
							cursor:'move',
							axis:'y',
							handle: '.sort',
							scrollSensitivity:40,
							forcePlaceholderSize: true,
							helper: 'clone',
							opacity: 0.65,
							placeholder: 'wc-metabox-sortable-placeholder',
							start:function(event,ui){
								ui.item.css('baclbsround-color','#f6f6f6');
							},
							stop:function(event,ui){
								ui.item.removeAttr('style');
								ups_services_row_indexes();
							}
						});

						function ups_services_row_indexes() {
							jQuery('.ups_services tbody tr').each(function(index, el){
								jQuery('input.order', el).val( parseInt( jQuery(el).index('.ups_services tr') ) );
							});
						};

					});

				</script>
			</td>
		</tr>
		<?php
		return ob_get_clean();
	}

	/**
	 * validate_single_select_country_field function.
	 *
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function validate_single_select_country_field( $key ) {

		if ( isset( $_POST['woocommerce_ups_origin_country_state'] ) )
			return $_POST['woocommerce_ups_origin_country_state'];
		return '';
	}
	/**
	 * validate_box_packing_field function.
	 *
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function validate_box_packing_field( $key ) {

		$boxes = array();

		if ( isset( $_POST['boxes_outer_length'] ) ) {
			$boxes_outer_length = $_POST['boxes_outer_length'];
			$boxes_outer_width  = $_POST['boxes_outer_width'];
			$boxes_outer_height = $_POST['boxes_outer_height'];
			$boxes_inner_length = $_POST['boxes_inner_length'];
			$boxes_inner_width  = $_POST['boxes_inner_width'];
			$boxes_inner_height = $_POST['boxes_inner_height'];
			$boxes_box_weight   = $_POST['boxes_box_weight'];
			$boxes_max_weight   = $_POST['boxes_max_weight'];


			for ( $i = 0; $i < sizeof( $boxes_outer_length ); $i ++ ) {

				if ( $boxes_outer_length[ $i ] && $boxes_outer_width[ $i ] && $boxes_outer_height[ $i ] && $boxes_inner_length[ $i ] && $boxes_inner_width[ $i ] && $boxes_inner_height[ $i ] ) {

					$boxes[] = array(
						'outer_length' => floatval( $boxes_outer_length[ $i ] ),
						'outer_width'  => floatval( $boxes_outer_width[ $i ] ),
						'outer_height' => floatval( $boxes_outer_height[ $i ] ),
						'inner_length' => floatval( $boxes_inner_length[ $i ] ),
						'inner_width'  => floatval( $boxes_inner_width[ $i ] ),
						'inner_height' => floatval( $boxes_inner_height[ $i ] ),
						'box_weight'   => floatval( $boxes_box_weight[ $i ] ),
						'max_weight'   => floatval( $boxes_max_weight[ $i ] ),
					);

				}

			}

		}

		return $boxes;
	}

	/**
	 * validate_services_field function.
	 *
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function validate_services_field( $key ) {
		$services         = array();
		$posted_services  = $_POST['ups_service'];

		foreach ( $posted_services as $code => $settings ) {

			$services[ $code ] = array(
				'name'               => woocommerce_clean( $settings['name'] ),
				'order'              => woocommerce_clean( $settings['order'] ),
				'enabled'            => isset( $settings['enabled'] ) ? true : false,
				'adjustment'         => woocommerce_clean( $settings['adjustment'] ),
				'adjustment_percent' => str_replace( '%', '', woocommerce_clean( $settings['adjustment_percent'] ) )
			);

		}

		return $services;
	}

	/**
	 * clear_transients function.
	 *
	 * @access public
	 * @return void
	 */
	public function clear_transients() {
		global $wpdb;

		$wpdb->query( "DELETE FROM `$wpdb->options` WHERE `option_name` LIKE ('_transient_ups_quote_%') OR `option_name` LIKE ('_transient_timeout_ups_quote_%')" );
	}

    /**
     * init_form_fields function.
     *
     * @access public
     * @return void
     */
    public function init_form_fields() {
	    global $woocommerce;

    	$this->form_fields  = array(
			'enabled'          => array(
				'title'           => __( 'Enable/Disable', 'wc_ups' ),
				'type'            => 'checkbox',
				'label'           => __( 'Enable this shipping method', 'wc_ups' ),
				'default'         => 'no'
			),
			'title'            => array(
				'title'           => __( 'Method Title', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'This controls the title which the user sees during checkout.', 'wc_ups' ),
				'default'         => __( 'UPS', 'wc_ups' )
			),
		    'availability'  => array(
				'title'           => __( 'Method Availability', 'wc_ups' ),
				'type'            => 'select',
				'default'         => 'all',
				'class'           => 'availability',
				'options'         => array(
					'all'            => __( 'All Countries', 'wc_ups' ),
					'specific'       => __( 'Specific Countries', 'wc_ups' ),
				),
			),
			'countries'        => array(
				'title'           => __( 'Specific Countries', 'wc_ups' ),
				'type'            => 'multiselect',
				'class'           => 'chosen_select',
				'css'             => 'width: 450px;',
				'default'         => '',
				'options'         => $woocommerce->countries->get_allowed_countries(),
			),
		    'api'           => array(
				'title'           => __( 'API Settings', 'wc_ups' ),
				'type'            => 'title',
				'description'     => __( 'You need to obtain UPS account credentials by registering on via their website.', 'wc_ups' ),
		    ),
		    'user_id'           => array(
				'title'           => __( 'UPS User ID', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'Obtained from UPS after getting an account.', 'wc_ups' ),
				'default'         => '',
		    ),
		    'password'            => array(
				'title'           => __( 'UPS Password', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'Obtained from UPS after getting an account.', 'wc_ups' ),
				'default'         => '',
		    ),
		    'access_key'          => array(
				'title'           => __( 'UPS Access Key', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'Obtained from UPS after getting an account.', 'wc_ups' ),
				'default'         => '',
		    ),
		    'shipper_number'      => array(
				'title'           => __( 'UPS Account Number', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'Obtained from UPS after getting an account.', 'wc_ups' ),
				'default'         => '',
		    ),
		    'origin_postcode'      => array(
				'title'           => __( 'Origin Postcode', 'wc_ups' ),
				'type'            => 'text',
				'description'     => __( 'Enter the zip/postcode for the <strong>sender</strong>.', 'wc_ups' ),
				'default'         => '',
		    ),
			'origin_country_state'      => array(
				'type'            => 'single_select_country',
			),
			'units'      => array(
				'title'           => __( 'Weight/Dimension Units', 'wc_ups' ),
				'type'            => 'select',
				'description'     => __( 'If you see "This measurement system is not valid for the selected country" errors, switch this to metric units.', 'wc_ups' ),
				'default'         => 'imperial',
				'options'         => array(
				    'imperial'    => __( 'LB / IN', 'wc_ups' ),
				    'metric'      => __( 'KG / CM', 'wc_ups' ),
				),
		    ),
		    'negotiated'  => array(
				'title'           => __( 'Negotiated Rates', 'wc_ups' ),
				'label'           => __( 'Enable negotiated rates', 'wc_ups' ),
				'type'            => 'checkbox',
				'default'         => 'no',
				'description'     => __( 'Enable this if this shipping account has negotiated rates available.', 'wc_ups' )
			),
		    'debug'  => array(
				'title'           => __( 'Debug Mode', 'wc_ups' ),
				'label'           => __( 'Enable debug mode', 'wc_ups' ),
				'type'            => 'checkbox',
				'default'         => 'no',
				'description'     => __( 'Enable debug mode to show debugging information on your cart/checkout.', 'wc_ups' )
			),
		    'pickup_destination'  => array(
				'title'           => __( 'Pickup and Destination', 'wc_ups' ),
				'type'            => 'title',
				'description'     => '',
		    ),
		    'pickup'  => array(
				'title'           => __( 'Pickup', 'wc_ups' ),
				'type'            => 'select',
				'css'			  => 'width: 250px;',
				'class'			  => 'chosen_select',
				'default'         => '01',
				'options'         => $this->pickup_code,
			),
		    'residential'  => array(
				'title'           => __( 'Residential', 'wc_ups' ),
				'label'           => __( 'Enable residential address flag', 'wc_ups' ),
				'type'            => 'checkbox',
				'default'         => 'no',
				'description'     => __( 'Enable this to indicate to UPS that the receiver is a residential address.', 'wc_ups' )
			),
		    'services_packaging'  => array(
				'title'           => __( 'Services and Packaging', 'wc_ups' ),
				'type'            => 'title',
				'description'     => '',
		    ),
			'services'  => array(
				'type'            => 'services'
			),
			'offer_rates'   => array(
				'title'           => __( 'Offer Rates', 'wc_ups' ),
				'type'            => 'select',
				'description'     => '',
				'default'         => 'all',
				'options'         => array(
				    'all'         => __( 'Offer the customer all returned rates', 'wc_ups' ),
				    'cheapest'    => __( 'Offer the customer the cheapest rate only', 'wc_ups' ),
				),
		    ),
		    'fallback' => array(
				'title'       => __( 'Fallback', 'wc_ups' ),
				'type'        => 'text',
				'description' => __( 'If UPS returns no matching rates, offer this amount for shipping so that the user can still checkout. Leave blank to disable.', 'wc_ups' ),
				'default'     => ''
			),
			'packing_method'  => array(
				'title'           => __( 'Parcel Packing Method', 'wc_ups' ),
				'type'            => 'select',
				'default'         => '',
				'class'           => 'packing_method',
				'options'         => array(
					'per_item'       => __( 'Default: Pack items individually', 'wc_ups' ),
					'box_packing'    => __( 'Recommended: Pack into boxes with weights and dimensions', 'wc_ups' ),
				),
			),
			'ups_packaging'  => array(
				'title'           => __( 'UPS Packaging', 'wc_ups' ),
				'type'            => 'multiselect',
				'description'	  => __( 'Select UPS standard packaging options to enable', 'wc_ups' ),
				'default'         => array(),
				'css'			  => 'width: 450px;',
				'class'           => 'ups_packaging chosen_select',
				'options'         => $this->packaging_select
			),

			'boxes'  => array(
				'type'            => 'box_packing'
			),

		);
    }

    /**
     * calculate_shipping function.
     *
     * @access public
     * @param mixed $package
     * @return void
     */
    public function calculate_shipping( $package ) {
    	global $woocommerce;

    	$rates            = array();
    	$ups_responses	  = array();
    	libxml_use_internal_errors( true );

		// Only return rates if the package has a destination including country, postcode
		if ( ( ''==$package['destination']['country'] ) || ( ''==$package['destination']['postcode'] ) ) {
			if ( $this->debug ) {
				$woocommerce->add_message( __('UPS: Country, or Zip not yet supplied. Rates not requested.', 'wc_ups') );
			}
			return; 
		}

    	$package_requests = $this->get_package_requests( $package );

    	if ( $package_requests ) {

			$rate_requests = $this->get_rate_requests( $package_requests, $package );

			if ( ! $rate_requests ) {
				if ( $this->debug ) {
					$woocommerce->add_message( __('UPS: No Services are enabled in admin panel.', 'wc_ups') );
				}
			}

			// get live or cached result for each rate
			foreach ( $rate_requests as $code => $request ) {

				$send_request           = str_replace( array( "\n", "\r" ), '', $request );
				$transient              = 'ups_quote_' . md5( $request );
				$cached_response        = get_transient( $transient );
				$ups_responses[ $code ] = false;

				if ( $cached_response === false ) {
					$response = wp_remote_post( $this->endpoint,
			    		array(
							'timeout'   => 70,
							'sslverify' => 0,
							'body'      => $send_request
					    )
					);

					if ( ! empty( $response['body'] ) ) {
						$ups_responses[ $code ] = $response['body'];
						set_transient( $transient, $response['body'] );
					}

				} else {
					$ups_responses[ $code ] = $cached_response;

					if ( $this->debug )
		    			$woocommerce->add_message( __( 'UPS: Using cached response.', 'wc_ups' ) );
				}

	    		if ( $this->debug ) {
					$woocommerce->add_message( 'UPS REQUEST: <pre>' . print_r( htmlspecialchars( $request ), true ) . '</pre>' );
					$woocommerce->add_message( 'UPS RESPONSE: <pre>' . print_r( htmlspecialchars( $ups_responses[ $code ] ), true ) . '</pre>' );
				}

			} // foreach ( $rate_requests )

			// parse the results
			foreach ( $ups_responses as $code => $response ) {

				$xml = simplexml_load_string( preg_replace('/<\?xml.*\?>/','', $response ) );

				if ( $this->debug ) {
					if ( ! $xml ) {
						$woocommerce->add_error( __( 'Failed loading XML', 'wc_ups' ) );
					}
				}

				if ( $xml->Response->ResponseStatusCode == 1 ) {

					$service_name = $this->services[ $code ];

					if ( $this->negotiated && isset( $xml->RatedShipment->NegotiatedRates->NetSummaryCharges->GrandTotal->MonetaryValue ) )
						$rate_cost = (float) $xml->RatedShipment->NegotiatedRates->NetSummaryCharges->GrandTotal->MonetaryValue;
					else
						$rate_cost = (float) $xml->RatedShipment->TotalCharges->MonetaryValue;

					$rate_id     = $this->id . ':' . $code;
					$rate_name   = $service_name . ' (' . $this->title . ')';

					// Name adjustment
					if ( ! empty( $this->custom_services[ $code ]['name'] ) )
						$rate_name = $this->custom_services[ $code ]['name'];

					// Cost adjustment %
					if ( ! empty( $this->custom_services[ $code ]['adjustment_percent'] ) )
						$rate_cost = $rate_cost + ( $rate_cost * ( floatval( $this->custom_services[ $code ]['adjustment_percent'] ) / 100 ) );
					// Cost adjustment
					if ( ! empty( $this->custom_services[ $code ]['adjustment'] ) )
						$rate_cost = $rate_cost + floatval( $this->custom_services[ $code ]['adjustment'] );

					// Sort
					if ( isset( $this->custom_services[ $code ]['order'] ) ) {
						$sort = $this->custom_services[ $code ]['order'];
					} else {
						$sort = 999;
					}

					$rates[ $rate_id ] = array(
						'id' 	=> $rate_id,
						'label' => $rate_name,
						'cost' 	=> $rate_cost,
						'sort'  => $sort
					);

				} else {
					// Either there was an error on this rate, or the rate is not valid (i.e. it is a domestic rate, but shipping international)
					if ( $this->debug ) {

						$woocommerce->add_error( sprintf( __( '[UPS] No rate returned for service code %s, %s (UPS code: %s)', 'wc_ups' ),
											$code,
											$xml->Response->Error->ErrorDescription,
											$xml->Response->Error->ErrorCode ) );
					}
				}

			} // foreach ( $ups_responses )

		} // foreach ( $package_requests )

		// Add rates
		if ( $rates ) {

			if ( $this->offer_rates == 'all' ) {

				uasort( $rates, array( $this, 'sort_rates' ) );
				foreach ( $rates as $key => $rate ) {
					$this->add_rate( $rate );
				}

			} else {

				$cheapest_rate = '';

				foreach ( $rates as $key => $rate ) {
					if ( ! $cheapest_rate || $cheapest_rate['cost'] > $rate['cost'] )
						$cheapest_rate = $rate;
				}

				$cheapest_rate['label'] = $this->title;

				$this->add_rate( $cheapest_rate );

			}
		// Fallback
		} elseif ( $this->fallback ) {
			$this->add_rate( array(
				'id' 	=> $this->id . '_fallback',
				'label' => $this->title,
				'cost' 	=> $this->fallback,
				'sort'  => 0
			) );
			if ( $this->debug ) {
				$woocommerce->add_message( __('UPS: Using Fallback setting.', 'wc_ups') );
			}
		}
    }

    /**
     * sort_rates function.
     *
     * @access public
     * @param mixed $a
     * @param mixed $b
     * @return void
     */
    public function sort_rates( $a, $b ) {
		if ( $a['sort'] == $b['sort'] ) return 0;
		return ( $a['sort'] < $b['sort'] ) ? -1 : 1;
    }

    /**
     * get_package_requests
	 *
	 *
     *
     * @access private
     * @return void
     */
    private function get_package_requests( $package ) {

	    // Choose selected packing
    	switch ( $this->packing_method ) {
	    	case 'box_packing' :
	    		$requests = $this->box_shipping( $package );
	    	break;
	    	case 'per_item' :
	    	default :
	    		$requests = $this->per_item_shipping( $package );
	    	break;
    	}

    	return $requests;
    }

	/**
	 * get_rate_requests
	 *
	 * Get rate requests for all
	 * @access private
	 * @return array of strings - XML
	 *
	 */
	private function get_rate_requests( $package_requests, $package ) {
		global $woocommerce;

		$customer = $woocommerce->customer;

		$rate_requests = array();

		foreach ( $this->custom_services as $code => $params ) {
			if ( 1 == $params['enabled'] ) {

			// Security Header
			$request  = "<?xml version=\"1.0\" ?>" . "\n";
			$request .= "<AccessRequest xml:lang='en-US'>" . "\n";
			$request .= "	<AccessLicenseNumber>" . $this->access_key . "</AccessLicenseNumber>" . "\n";
			$request .= "	<UserId>" . $this->user_id . "</UserId>" . "\n";
			// Ampersand will break XML doc, so replace with encoded version.
			$valid_pass = str_replace( '&', '&amp;', $this->password );
			$request .= "	<Password>" . $valid_pass . "</Password>" . "\n";
			$request .= "</AccessRequest>" . "\n";
	    		$request .= "<?xml version=\"1.0\" ?>" . "\n";
	    		$request .= "<RatingServiceSelectionRequest>" . "\n";
	    		$request .= "	<Request>" . "\n";
	    		$request .= "	<TransactionReference>" . "\n";
	    		$request .= "		<CustomerContext>Rating and Service</CustomerContext>" . "\n";
	    		$request .= "		<XpciVersion>1.0</XpciVersion>" . "\n";
	    		$request .= "	</TransactionReference>" . "\n";
	    		$request .= "	<RequestAction>Rate</RequestAction>" . "\n";
	    		$request .= "	<RequestOption>Rate</RequestOption>" . "\n";
	    		$request .= "	</Request>" . "\n";
	    		$request .= "	<PickupType>" . "\n";
	    		$request .= "		<Code>" . $this->pickup . "</Code>" . "\n";
	    		$request .= "		<Description>" . $this->pickup_code[$this->pickup] . "</Description>" . "\n";
	    		$request .= "	</PickupType>" . "\n";
				// Shipment information
	    		$request .= "	<Shipment>" . "\n";
	    		$request .= "		<Description>WooCommerce Rate Request</Description>" . "\n";
	    		$request .= "		<Shipper>" . "\n";
	    		$request .= "			<ShipperNumber>" . $this->shipper_number . "</ShipperNumber>" . "\n";
	    		$request .= "			<Address>" . "\n";
	    		$request .= "				<PostalCode>" . $this->origin_postcode . "</PostalCode>" . "\n";
	    		$request .= "				<CountryCode>" . $this->origin_country . "</CountryCode>" . "\n";
	    		$request .= "			</Address>" . "\n";
	    		$request .= "		</Shipper>" . "\n";
	    		$request .= "		<ShipTo>" . "\n";
	    		$request .= "			<Address>" . "\n";
	    		$request .= "				<StateProvinceCode>" . $package['destination']['state'] . "</StateProvinceCode>" . "\n";
	    		$request .= "				<PostalCode>" . $package['destination']['postcode'] . "</PostalCode>" . "\n";
			if ( ( "PR" == $package['destination']['state'] ) && ( "US" == $package['destination']['country'] ) ) {		
	    			$request .= "				<CountryCode>PR</CountryCode>" . "\n";
			} else {
	    			$request .= "				<CountryCode>" . $package['destination']['country'] . "</CountryCode>" . "\n";
			}
	    		if ( $this->residential ) {
	    		$request .= "				<ResidentialAddressIndicator></ResidentialAddressIndicator>" . "\n";
	    		}
	    		$request .= "			</Address>" . "\n";
	    		$request .= "		</ShipTo>" . "\n";
	    		$request .= "		<ShipFrom>" . "\n";
	    		$request .= "			<Address>" . "\n";
	    		$request .= "				<PostalCode>" . $this->origin_postcode . "</PostalCode>" . "\n";
	    		$request .= "				<CountryCode>" . $this->origin_country . "</CountryCode>" . "\n";
	    		if ( $this->negotiated && $this->origin_state ) {
	    		$request .= "				<StateProvinceCode>" . $this->origin_state . "</StateProvinceCode>" . "\n";
	    		}
	    		$request .= "			</Address>" . "\n";
	    		$request .= "		</ShipFrom>" . "\n";
	    		$request .= "		<Service>" . "\n";
	    		$request .= "			<Code>" . $code . "</Code>" . "\n";
	    		$request .= "		</Service>" . "\n";
				// packages
	    		foreach ( $package_requests as $key => $package_request ) {
	    			$request .= $package_request;
	    		}
				// negotiated rates flag
	    		if ( $this->negotiated ) {
	    		$request .= "		<RateInformation>" . "\n";
	    		$request .= "			<NegotiatedRatesIndicator />" . "\n";
	    		$request .= "		</RateInformation>" . "\n";
				}
	    		$request .= "	</Shipment>" . "\n";
	    		$request .= "</RatingServiceSelectionRequest>" . "\n";

				$rate_requests[$code] = $request;

			} // if (enabled)
		} // foreach()

		return $rate_requests;
	}

    /**
     * per_item_shipping function.
     *
     * @access private
     * @param mixed $package
     * @return mixed $requests - an array of XML strings
     */
    private function per_item_shipping( $package ) {
	    global $woocommerce;

	    $requests = array();

		$ctr=0;
    	foreach ( $package['contents'] as $item_id => $values ) {
    		$ctr++;

    		if ( ! $values['data']->needs_shipping() ) {
    			if ( $this->debug )
    				$woocommerce->add_message( sprintf( __( 'Product #%d is virtual. Skipping.', 'wc_ups' ), $ctr ) );
    			continue;
    		}

    		if ( ! $values['data']->get_weight() ) {
	    		if ( $this->debug )
	    			$woocommerce->add_error( sprintf( __( 'Product #%d is missing weight. Aborting.', 'wc_ups' ), $ctr ) );
	    		return;
    		}

			// get package weight
    		$weight = woocommerce_get_weight( $values['data']->get_weight(), $this->weight_unit );

			// get package dimensions
    		if ( $values['data']->length && $values['data']->height && $values['data']->width ) {

				$dimensions = array( number_format( woocommerce_get_dimension( $values['data']->length, $this->dim_unit ), 2, '.', ''),
									 number_format( woocommerce_get_dimension( $values['data']->height, $this->dim_unit ), 2, '.', ''),
									 number_format( woocommerce_get_dimension( $values['data']->width, $this->dim_unit ), 2, '.', '') );
				sort( $dimensions );

			} 

			// get quantity in cart
			$cart_item_qty = $values['quantity'];
			// get weight, or 1 if less than 1 lbs.
			$_weight = ( floor( $weight ) < 1 ) ? 1 : $weight;

			$request  = '<Package>' . "\n";
			$request .= '	<PackagingType>' . "\n";
			$request .= '		<Code>02</Code>' . "\n";
			$request .= '		<Description>Package/customer supplied</Description>' . "\n";
			$request .= '	</PackagingType>' . "\n";
			$request .= '	<Description>Rate</Description>' . "\n";

			if ( $values['data']->length && $values['data']->height && $values['data']->width ) {
				$request .= '	<Dimensions>' . "\n";
				$request .= '		<UnitOfMeasurement>' . "\n";
				$request .= '	 		<Code>' . $this->dim_unit . '</Code>' . "\n";
				$request .= '		</UnitOfMeasurement>' . "\n";
				$request .= '		<Length>' . $dimensions[2] . '</Length>' . "\n";
				$request .= '		<Width>' . $dimensions[1] . '</Width>' . "\n";
				$request .= '		<Height>' . $dimensions[0] . '</Height>' . "\n";
				$request .= '	</Dimensions>' . "\n";
			}

			$request .= '	<PackageWeight>' . "\n";
			$request .= '		<UnitOfMeasurement>' . "\n";
			$request .= '			<Code>' . $this->weight_unit . '</Code>' . "\n";
			$request .= '		</UnitOfMeasurement>' . "\n";
			$request .= '		<Weight>' . $_weight . '</Weight>' . "\n";
			$request .= '	</PackageWeight>' . "\n";
			$request .= '</Package>' . "\n";

			for ( $i=0; $i < $cart_item_qty ; $i++)
				$requests[] = $request;
    	}

		return $requests;
    }

    /**
     * box_shipping function.
     *
     * @access private
     * @param mixed $package
     * @return void
     */
    private function box_shipping( $package ) {
	    global $woocommerce;

	    $requests = array();

	  	if ( ! class_exists( 'WC_Boxpack' ) )
	  		include_once 'box-packer/class-wc-boxpack.php';

	    $boxpack = new WC_Boxpack();

		// Add Standard UPS boxes
		if ( ! empty( $this->ups_packaging )  ) {
			foreach ( $this->ups_packaging as $key => $box_code ) {

				$box = $this->packaging[ $box_code ];
				$newbox = $boxpack->add_box( $key, $box['length'], $box['width'], $box['height'] );

				$newbox->set_inner_dimensions( $box['length'], $box['width'], $box['height'] );

				if ( $box['weight'] )
					$newbox->set_max_weight( $box['weight'] );

			}
		}

	    // Define boxes
	    if ( ! empty( $this->boxes ) ) {
			foreach ( $this->boxes as $box ) {

				$newbox = $boxpack->add_box( $box['outer_length'], $box['outer_width'], $box['outer_height'], $box['box_weight'] );

				$newbox->set_inner_dimensions( $box['inner_length'], $box['inner_width'], $box['inner_height'] );

				if ( $box['max_weight'] )
					$newbox->set_max_weight( $box['max_weight'] );

			}
		}

		// Add items
		$ctr = 0;
		foreach ( $package['contents'] as $item_id => $values ) {
			$ctr++;

    		if ( ! $values['data']->needs_shipping() ) {
    			if ( $this->debug )
    				$woocommerce->add_message( sprintf( __( 'Product #%d is virtual. Skipping.', 'wc_ups' ), $ctr ) );
    			continue;
    		}

			if ( $values['data']->length && $values['data']->height && $values['data']->width && $values['data']->weight ) {

				$dimensions = array( $values['data']->length, $values['data']->height, $values['data']->width );

				for ( $i = 0; $i < $values['quantity']; $i ++ ) {
					$boxpack->add_item(
						number_format( woocommerce_get_dimension( $dimensions[2], $this->dim_unit ), 2, '.', ''),
						number_format( woocommerce_get_dimension( $dimensions[1], $this->dim_unit ), 2, '.', ''),
						number_format( woocommerce_get_dimension( $dimensions[0], $this->dim_unit ), 2, '.', ''),
						number_format( woocommerce_get_weight( $values['data']->get_weight(), $this->weight_unit ), 2, '.', ''),
						$values['data']->get_price()
					);
				}

			} else {
	    		if ( $this->debug )
					$woocommerce->add_error( sprintf( __( 'UPS Parcel Packing Method is set to Pack into Boxes. Product #%d is missing dimensions. Aborting.', 'wc_ups' ), $ctr ) );
				return;
			}
		}

		// Pack it
		$boxpack->pack();

		// Get packages
		$box_packages = $boxpack->get_packages();

		$ctr=0;
		foreach ( $box_packages as $key => $box_package ) {
			$ctr++;

			if ( $this->debug )
				$woocommerce->add_error( "PACKAGE " . $ctr . " (" . $key . ")\n<pre>" . print_r( $box_package,true ) . "</pre>");

			$weight     = $box_package->weight;
    		$dimensions = array( $box_package->length, $box_package->width, $box_package->height );

			sort( $dimensions );
			// get weight, or 1 if less than 1 lbs.
			$_weight = ( floor( $weight ) < 1 ) ? 1 : $weight;

			$request  = '<Package>' . "\n";
			$request .= '	<PackagingType>' . "\n";
			$request .= '		<Code>02</Code>' . "\n";
			$request .= '		<Description>Package/customer supplied</Description>' . "\n";
			$request .= '	</PackagingType>' . "\n";
			$request .= '	<Description>Rate</Description>' . "\n";

			$request .= '	<Dimensions>' . "\n";
			$request .= '		<UnitOfMeasurement>' . "\n";
			$request .= '	 		<Code>' . $this->dim_unit . '</Code>' . "\n";
			$request .= '		</UnitOfMeasurement>' . "\n";
			$request .= '		<Length>' . $dimensions[2] . '</Length>' . "\n";
			$request .= '		<Width>' . $dimensions[1] . '</Width>' . "\n";
			$request .= '		<Height>' . $dimensions[0] . '</Height>' . "\n";
			$request .= '	</Dimensions>' . "\n";

			$request .= '	<PackageWeight>' . "\n";
			$request .= '		<UnitOfMeasurement>' . "\n";
			$request .= '			<Code>' . $this->weight_unit . '</Code>' . "\n";
			$request .= '		</UnitOfMeasurement>' . "\n";
			$request .= '		<Weight>' . $_weight . '</Weight>' . "\n";
			$request .= '	</PackageWeight>' . "\n";
			$request .= '</Package>' . "\n";

			$requests[] = $request;

		}

		return $requests;
    }

}
