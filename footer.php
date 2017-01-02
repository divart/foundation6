<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<?php
			if (has_nav_menu('footer-menu')) {
				wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu','depth'=>1));
			}
			?>
		</div>
	</div>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
