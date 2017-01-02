<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<!--[if !(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9 ie8" lang="en"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/js/plugins/html5shiv.js"></script>
<![endif]-->
<!--[if gte IE 9]>
<style type="text/css">
	.gradient {
		filter: none;
	}
</style>
<![endif]-->

<head>
	<!-- Set up Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta charset="<?php bloginfo('charset'); ?>">

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<!-- Add Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- BEGIN of header -->
<header class="header">
	<div class="row medium-uncollapse small-collapse">
		<div class="medium-4 columns">
			<div class="logo small-only-text-center">
				<?php show_custom_logo(); ?>
			</div>
		</div>
		<div class="medium-8 columns">
			<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
				<button class="menu-icon" type="button" data-toggle></button>
				<div class="title-bar-title">Menu</div>
			</div>
			<nav class="top-bar" id="main-menu">
				<?php
				if (has_nav_menu('header-menu')) {
					wp_nav_menu(array('theme_location' => 'header-menu',
						'menu_class' => 'menu header-menu dropdown',
						'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
						'walker' => new foundation_navigation()));
				}
				?>
			</nav>
		</div>
	</div>
</header>
<!-- END of header -->
