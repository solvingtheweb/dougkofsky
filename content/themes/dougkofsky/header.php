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

<script> <!-- Google Analytics -->
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46047932-1', 'dougkofsky.com');
  ga('send', 'pageview');

</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site" style="
	<?php
	$postID = get_the_id();
	if (is_page()) :
	?>
		background-image:url('<?php the_field('background_image'); ?>');
	<?php else : ?>
		<?php if (has_post_thumbnail( $postID ) ) : ?>
			
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' ); ?>
		<?php endif; ?>
		<!--
		background:url('<?php echo $image[0]; ?>') no-repeat;
		background-size:200% auto;
	-->
	<?php endif; ?>
	">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header-container" role="banner">
		<div class="site-header row">
			<div class="site-branding large-4 columns">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/images/DKP_logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></div>
			</div>

			<nav id="site-navigation" class="main-navigation large-8 columns" role="navigation">
				<div class="menu-toggle"><?php _e( 'Menu', 'dougkofsky' ); ?></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content"  style="
	<?php
	$postID = get_the_id();
	if (is_page()) :
	?>
		background-image:url('<?php the_field('background_image'); ?>');
	<?php else : ?>
		<?php if (has_post_thumbnail( $postID ) ) : ?>
			
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' ); ?>
		<?php endif; ?>
		<!--
		background:url('<?php echo $image[0]; ?>') no-repeat;
		background-size:200% auto;
	-->
	<?php endif; ?>
	">

	<?php get_template_part( 'partials/mini', 'cart' ); ?>
