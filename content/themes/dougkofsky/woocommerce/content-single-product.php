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
	
	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	<div class="large-12 columns">
		<div class="row">
			<div class="large-10 columns large-centered">
				<h1 class="product_title"><?php the_title(); ?></h1>
				<div class="row">
					<div id="product-sidebar" class="large-4 push-8 columns">
						<div class="next_prev_thumbs">
							<div class="previous_thumb">
								<?php previous_post_link_plus( array('thumb' => 'thumbnail', 'link' => false, 'format' => '%link', 'loop' => true) ); ?>
								<div class="previous_thumb_arrow"></div>
							</div>
							<div class="current_thumb">
								<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
							</div>
							<div class="next_thumb">
								<?php next_post_link_plus( array('thumb' => 'thumbnail', 'link' => false, 'format' => '%link', 'loop' => true) ); ?>
								<div class="next_thumb_arrow"></div>
							</div>
							
						</div>
						<?php
						global $product;
						if ( $product->get_price_html() ) : ?>
						<hr>
						<button href="#" class="button radius" data-reveal-id="addToCartModal">Purchase a Print</button>
						<?php endif; ?>
						<hr>
						<div class="social">
							<h4>Share this:</h4>
    	
							<a href="http://www.twitter.com/home?status=Doug%20Kofsky%20Photography%20-%20<?php the_permalink(); ?>" title="Share on Twitter" onclick="window.open(this.href, 'mywin','left=200,top=60,width=500,height=500,toolbar=1,resizable=1'); return false;"><img src="<?php bloginfo('template_directory'); ?>/images/twitter_button2.png" alt="Share on Twitter"></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Share on Facebook" target="_blank" onclick="window.open(this.href, 'mywin','left=200,top=60,width=500,height=500,toolbar=1,resizable=1'); return false;"><img src="<?php bloginfo('template_directory'); ?>/images/facebook_button2.png" alt="Share on Facebook"></a>
							<?php if(get_field('flickr_link')) : ?>  
						    	<a href="<?php the_field('flickr_link'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/flickr_button2.png" alt="View on Flickr"></a>
							<?php endif; ?>
						</div>
						<hr>
					</div>
    	
					<div class="summary entry-summary product-main large-8 pull-4 columns">
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
    		
				</div>
			</div><!-- large-10 -->
			
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