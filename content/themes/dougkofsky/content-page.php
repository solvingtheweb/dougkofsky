<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package dougkofsky
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-title">

			<?php
				$upper_headline = get_field('upper_headline');
				$main_headline = get_field('main_headline');
				$lower_headline = get_field('lower_headline');
				 
				if($upper_headline || $main_headline || $lower_headline )
				{
					if($upper_headline)
					{
					echo '<h1 class="upper_headline">' . $upper_headline . '</h1>';
					}
					if($main_headline)
					{
					echo '<h1 class="main_headline">' . $main_headline . '</h1>';
					}
					if($lower_headline)
					{
					echo '<h1 class="lower_headline">' . $lower_headline . '</h1>';
					}
				}
				else
				{
				echo '<h1 class="main_headline">' . get_the_title() . '</h1>';
				}
			 
			?>
		</div>
		
		<?php if (get_the_ID() == '86' || get_the_ID() == '90') { ?>
			<div class="social social-header">
				<?php if(get_field('social_links', 'option')): ?>
					<?php while(has_sub_field('social_links', 'option')): ?>						
						<a href="<?php the_sub_field('social_network_url'); ?>"><img src="<?php the_sub_field('social_network_icon'); ?>" alt="Find me on <?php the_sub_field('social_network_name'); ?>"></a>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		<?php } ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'dougkofsky' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'dougkofsky' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
