<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package dougkofsky
 */
?>

	</div><!-- #content -->

	<div class="push"></div>

	<footer id="colophon" class="site-footer-container" role="contentinfo">
		<div class="site-footer row">
			<div class="site-info large-12 columns">
				&copy;<?php the_time('Y'); ?> Doug Kofsky
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
	jQuery(document).ready(function($) {
		jQuery(document).foundation(); // initializes Foundation
	});
</script>

</body>
</html>