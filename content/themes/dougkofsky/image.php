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

				<div class="entry-content full-image">
					<div class="entry-attachment">
						<div class="attachment">
							<a href="<?php echo get_permalink($post->post_parent); ?>" title="Back to Photo Details">
								<div class="mountainblock"></div>
								<?php dougkofsky_the_attached_image(); ?>
								<script type="text/javascript">
									jQuery( document ).ready(function( $ ) {					
										var img = $(".attachment-full"); // Get img elem
										var pic_real_width, pic_real_height;
										$("<img/>") // Make in memory copy of image to avoid css issues
										    .attr("src", $(img).attr("src"))
										    .load(function() {
										        pic_real_width = this.width;   // Note: $(this).width() will not
										        pic_real_height = this.height; // work for in memory images.
												$(".mountainblock").css({"width": + pic_real_width, "height": + pic_real_height});
										    });
									});
								</script>
							</a>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->
					<nav role="navigation" id="image-navigation" class="image-navigation">
						
						<a href="<?php echo get_permalink($post->post_parent); ?>">&larr; Back to Photo Details</a>
						
					</nav><!-- #image-navigation -->

				</div><!-- .entry-content -->
			</article><!-- #post-## -->


		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
