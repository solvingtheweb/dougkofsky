<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package dougkofsky
 */
?>

<?php global $woocommerce; ?>
	<?php if($woocommerce->cart->cart_contents_count) : ?>
	<div class="mini-cart-container">
		<div class="mini-cart row">
			<div class="large-12 columns">
				<img src="<?php bloginfo('template_url'); ?>/images/cart.png">
				<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">Your Cart</a>
				<span> - <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?> <span class="cart-pipe">|</span> </span>
				<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="Checkout">Checkout</a>
			</div>
		</div>
	</div>
	<?php endif; ?>