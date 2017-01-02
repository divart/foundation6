<?php
/**
 * Page
 */
get_header(); ?>

	<div class="row">
		<!-- BEGIN of page content -->
		<div class="large-8 medium-8 small-12 columns">
			<main class="main-content">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<article <?php post_class(); ?>>
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php if (has_post_thumbnail()) : ?>
								<div title="<?php the_title_attribute(); ?>" class="thumbnail">
									<?php the_post_thumbnail('large'); ?>
								</div>
							<?php endif; ?>
							<?php the_content(); ?>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
			</main>
		</div>
		<!-- END of page content -->
		<!-- BEGIN of sidebar -->
		<div class="large-4 medium-4 small-12 columns sidebar">
			<?php get_sidebar('right'); ?>
		</div>
		<!-- END of sidebar -->
	</div>

<?php get_footer(); ?>