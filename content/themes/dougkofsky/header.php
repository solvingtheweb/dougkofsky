<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package dougkofsky
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,300,800,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site" style="
	<?php
	$postID = get_the_id();
	if (is_page()) :
	?>
		background:url('<?php the_field('background_image'); ?>') no-repeat top center;
		background-size:100% auto;
	<?php else : ?>
		<?php if (has_post_thumbnail( $postID ) ) : ?>
			
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' ); ?>
		<?php endif; ?>
		<!--
		background:url('<?php echo $image[0]; ?>') no-repeat top center;
		background-size:200% auto;
	-->
	<?php endif; ?>
	">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header-container" role="banner">
		<div class="site-header row">
			<div class="site-branding large-4 columns">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<nav id="site-navigation" class="main-navigation large-8 columns" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'dougkofsky' ); ?></h1>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
		
	</header><!-- #masthead -->
	<?php global $woocommerce; ?>
	<?php if($woocommerce->cart->cart_contents_count) : ?>
	<div class="mini-cart-container">
		<div class="mini-cart row">
			<div class="large-12 columns">
				<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"> Your Cart</a>
				<span><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?> | </span>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="Checkout">Checkout</a>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content">
