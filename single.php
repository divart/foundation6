<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header(); ?>

<div class="row">
	<!-- BEGIN of post content -->
	<div class="large-8 medium-8 small-12 columns">
		<main class="main-content">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="page-title"><?php the_title(); ?></h1>

						<?php if ( has_post_thumbnail()) : ?>
							<div title="<?php the_title_attribute(); ?>" class="thumbnail">
								<?php the_post_thumbnail('large'); ?>
							</div>
						<?php endif; ?>
						<p class="entry-meta">Written by <?php the_author_posts_link(); ?> on <?php the_time(get_option('date_format')); ?></p>
						<?php the_content(); ?>
						<h6><?php _e('Posted Under:', 'foundation' );?> <?php the_category(', '); ?></h6>
						<?php // comments_template(); ?>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
		</main>
	</div>
	<!-- END of post content -->
	
	<!-- BEGIN of sidebar -->
	<div class="large-4 medium-4 small-12 columns sidebar">
		<?php get_sidebar('right'); ?>
	</div>
	<!-- END of sidebar -->
</div>

<?php get_footer(); ?>