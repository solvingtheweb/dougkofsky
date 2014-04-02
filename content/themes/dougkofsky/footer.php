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

	

	<div id="page_footer"></div>
</div><!-- #page -->
<div id="footer">
	<footer id="colophon" class="site-footer-container" role="contentinfo">
		<div class="site-footer row">
			<div class="site-info large-12 columns">
				&copy;<?php echo date('Y'); ?> Doug Kofsky
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div>
<?php wp_footer(); ?>

<script>
	jQuery(document).ready(function($) {
		jQuery(document).foundation(); // initializes Foundation
		
		// initialize chosen
		$("#size").chosen({disable_search_threshold: 10, width: '330px'});
	});
</script>

</body>
</html>