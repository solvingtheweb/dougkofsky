<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package dougkofsky
 */

get_header(); ?>

	<div id="primary" class="content-area row">
		<?php
		$postID = get_the_id();
		if( is_page(38) ) : ?>
			<main id="main" class="site-main" role="main">
		<?php else : ?>
			<main id="main" class="site-main large-10 large-centered columns" role="main">
		<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
