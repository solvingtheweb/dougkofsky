<?php
/**
 * The template for displaying image attachments.
 *
 * @package dougkofsky
 */

get_header(); ?>

	<div id="primary" class="content-area image-attachment">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<nav role="navigation" id="image-navigation" class="image-navigation">
						<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'dougkofsky' ) ); ?></div>
						<div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'dougkofsky' ) ); ?></div>
					</nav><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="entry-content full-image">
					<div class="entry-attachment">
						<div class="attachment">
							<?php dougkofsky_the_attached_image(); ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->

				</div><!-- .entry-content -->
			</article><!-- #post-## -->


		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
