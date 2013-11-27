<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package dougkofsky
 */

get_header(); ?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main large-10 large-centered columns" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'dougkofsky' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe visit the <?php get_template_url(gallery, or contact me?', 'dougkofsky' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>