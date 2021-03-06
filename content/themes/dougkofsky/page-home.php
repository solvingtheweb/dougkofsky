<?php

/* Template Name: Home */
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

		<main id="main" class="site-main large-10 large-centered columns" role="main">

			<div id="mypanorama">
				<div class="panorama_titel">
					<h1>Doug Kofsky</h1>
					<p>Epicly Gorgeous Himalayan Photography</p>
					<a href="" class="button">View The Gallery</a>
				</div>
				<div class="panorama_img"><img data-src="<?php bloginfo('template_directory'); ?>/images/from_samdo_ri.jpg"></div>
				<div class="panorama_preloader" style="margin: 0 auto; width:32px; top:50%; margin-top: -16px;"><img src="<?php bloginfo('template_directory'); ?>/images/loading.gif"></div>    
			</div>		
			<!-- end panorama-->

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
