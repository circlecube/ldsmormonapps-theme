<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package LDS Mormon Apps
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="apple-touch-icon" sizes="57x57" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/manifest.json">
<link rel="shortcut icon" href="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="msapplication-TileImage" content="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/mstile-144x144.png">
<meta name="msapplication-config" content="https://ldsmormonapps.com/wp-content/themes/ldsmormonapps/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ldsmormonapps' ); ?></a>
	
	<header id="masthead" class="site-header row" role="banner">
		<div class="site-branding small-12 columns">
			<div class="row">
				<div class=" small-8 small-centered medium-5 medium-centered large-3 large-centered columns">
					<a class="app-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<div class="app-thumbnail-mask"></div>
						<img class="app-thumbnail" alt="<?php bloginfo( 'name' ); ?>" src="/wp-content/themes/ldsmormonapps/img/lds-mormon-apps-icon.png">
					</a>
				</div>
				<div class="app-description small-12 columns">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation small-12 columns" role="navigation">
<!-- 			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', 'ldsmormonapps' ); ?></button> -->
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div class="row">
	<div id="content" class="site-content small-11 small-centered medium-12 large-12 columns">
