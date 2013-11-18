<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>
	
	<div class="row">
		<div class="product-nav large-12 columns">
			
				<span class="page-next"><?php next_post_link_plus('format=%link&order_by=menu_order&meta_key=&loop=1&thumb=0&max_length=0&in_same_cat=0&excats=&num_results=1'); ?></span>
				<span class="page-previous"><?php previous_post_link_plus('format=%link&order_by=menu_order&meta_key=&loop=1&thumb=0&max_length=0&in_same_cat=0&excats=&num_results=1'); ?></span>
		</div>
	</div> 
	<div class="row">
		<div class="summary entry-summary product-main large-8 large-offset-1 columns">
			<h1 class="product_title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			
			<div id="addToCartModal" class="reveal-modal tiny">
			<?php
				do_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
				
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
			<a class="close-reveal-modal">x</a>
			
			</div>
			
		</div><!-- .summary -->
    	
		<div id="product-sidebar" class="large-3 columns">
			<hr>
			<button href="#" class="button radius" data-reveal-id="addToCartModal">Purchase a Print</button>
			<hr>
			<div class="social">
				<h4>Share this:</h4>
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/twitter_button.png" alt="Share on Twitter"></a>
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/facebook_button.png" alt="Share on Facebook"></a>
				<?php if(get_field('flickr_link')) : ?>  
			    	<a href="<?php the_field('flickr_link'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/flickr_button.png" alt="View on Flickr"></a>
				<?php endif; ?>
			</div>
			<hr>
		</div>
		
	</div>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>