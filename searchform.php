<?php
/**
 * Searchform
 *
 * Custom template for search form
 */
?>

<!-- BEGIN of search form -->
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" xmlns="http://www.w3.org/1999/html">
	<input type="search" name="s" id="s" placeholder="<?php _e('Search', 'foundation'); ?>" value="<?php echo get_search_query(); ?>"/>
	<button type="submit" name="submit" id="searchsubmit" ><?php _e('Search', 'foundation'); ?></button>
</form>
<!-- END of search form -->