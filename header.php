<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<header class="site-header" role="banner">
		<div class="header-flex-container">
			<div class="title-bar-header-flex-item">
				<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
					<div class="title-bar-left">
						<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
						<span class="site-mobile-title title-bar-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</span>
					</div>
				</div>
			</div>

			<div class="front-hero" role="banner">
				<?php get_template_part( 'template-parts/featured-image' ); ?>
				<div class="marketing">
					<div class="tagline">
						<h1><?php bloginfo( 'name' ); ?></h1>
						<h4 class="subheader"><?php bloginfo( 'description' ); ?></h4>
						<nav class="site-navigation top-bar" role="navigation">
							<div class="top-bar-left">
								<?php foundationpress_top_bar_r(); ?>

								<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
									<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
								<?php endif; ?>
							</div>
						</nav>
						<a role="button" class="download large button sites-button" href="">Talk to me</a>
					</div>
				</div>

				<div class="visualizer">
					<audio id="audioElement"></audio>
					<div class="audioButtons">
						<a class="previous"><i class="fa fa-backward fa-3x"></i></a>
						<a class="play primary active pulse"><i class="fa fa-play-circle fa-5x"></i></a>
						<a class="pause primary"><i class="fa fa-pause-circle fa-5x"></i></a>
						<a class="next"><i class="fa fa-forward fa-3x"></i></a>
					</div>
					<span class="track-title"></span>
				</div>
		</div>
	</header>
