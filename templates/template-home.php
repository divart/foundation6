<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

	<div class="row">
		<!--HOME PAGE SLIDER-->
		<?php echo home_slider_template(); ?>
		<!--END of HOME PAGE SLIDER-->
	</div>

	<!-- BEGIN of main content -->
	<div class="row columns">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<!-- END of main content -->

<?php get_footer(); ?>