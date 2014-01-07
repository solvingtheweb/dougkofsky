<?php
/*
	Plugin Name: WooCommerce UPS Shipping
	Plugin URI: http://woothemes.com/woocommerce
	Description: WooCommerce UPS Shipping allows a store to obtain shipping rates for your orders dynamically via the UPS Shipping API.
	Version: 2.0.12
	Author: WooThemes
	Author URI: http://woothemes.com

	Copyright: 2009-2011 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/


/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '8dae58502913bac0fbcdcaba515ea998', '18665' );

/**
 * Plugin activation check
 */
function wc_ups_activation_check(){
	if ( ! function_exists( 'simplexml_load_string' ) ) {
        deactivate_plugins( basename( __FILE__ ) );
        wp_die( "Sorry, but you can't run this plugin, it requires the SimpleXML library installed on your server/hosting to function." );
	}
}

register_activation_hook( __FILE__, 'wc_ups_activation_check' );

/**
 * Localisation
 */
load_plugin_textdomain( 'wc_ups', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Plugin page links
 */
function wc_ups_plugin_links( $links ) {

	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=woocommerce_settings&tab=shipping&section=WC_Shipping_UPS' ) . '">' . __( 'Settings', 'wc_ups' ) . '</a>',
		'<a href="http://support.woothemes.com/">' . __( 'Support', 'wc_ups' ) . '</a>',
		'<a href="http://wcdocs.woothemes.com/user-guide/ups/">' . __( 'Docs', 'wc_ups' ) . '</a>',
	);

	return array_merge( $plugin_links, $links );
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_ups_plugin_links' );

/**
 * Check if WooCommerce is active
 */
if ( is_woocommerce_active() ) {

	/**
	 * wc_ups_init function.
	 *
	 * @access public
	 * @return void
	 */
	function wc_ups_init() {
		include_once( 'classes/class-wc-shipping-ups.php' );
	}

	add_action( 'woocommerce_shipping_init', 'wc_ups_init' );

	/**
	 * wc_ups_add_method function.
	 *
	 * @access public
	 * @param mixed $methods
	 * @return void
	 */
	function wc_ups_add_method( $methods ) {
		$methods[] = 'WC_Shipping_UPS';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'wc_ups_add_method' );

	/**
	 * wc_ups_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function wc_ups_scripts() {
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	add_action( 'admin_enqueue_scripts', 'wc_ups_scripts' );
}
