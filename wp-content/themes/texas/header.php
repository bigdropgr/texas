<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Μετάβαση στο περιεχόμενο', 'texas' ); ?></a>
<header class="site-header">
	<div class="wrap header-inner">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo esc_html( get_bloginfo( 'name' ) );
			}
			?>
		</a>
		<button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle-bar"></span>
			<span class="nav-toggle-bar"></span>
			<span class="nav-toggle-bar"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Μενού', 'texas' ); ?></span>
		</button>
		<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Κύριο μενού', 'texas' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => false,
				'depth'          => 1,
			) );
			?>
		</nav>
	</div>
</header>
<main id="main" class="site-main">
	<div class="wrap">
		<?php texas_breadcrumbs(); ?>
