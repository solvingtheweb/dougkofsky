<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $errors ) return;
?>
<div class="large-12 columns">
	<ul class="woocommerce-error alert-box radius alert">
		<?php foreach ( $errors as $error ) : ?>
			<li><?php echo wp_kses_post( $error ); ?></li>
		<?php endforeach; ?>
	</ul>
</div>