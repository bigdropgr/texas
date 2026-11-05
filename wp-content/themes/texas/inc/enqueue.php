<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'texas_enqueue_assets' );
function texas_enqueue_assets() {
	wp_enqueue_style( 'texas-style', TEXAS_URI . '/assets/css/style.css', array(), TEXAS_VERSION );
	wp_enqueue_script( 'texas-main', TEXAS_URI . '/assets/js/main.js', array(), TEXAS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_head', 'texas_preload_fonts' );
function texas_preload_fonts() {
	$fonts = array(
		TEXAS_URI . '/assets/fonts/inter-var.woff2',
	);
	foreach ( $fonts as $font ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>', esc_url( $font ) );
	}
}

add_filter( 'body_class', 'texas_body_class' );
function texas_body_class( $classes ) {
	$classes[] = 'texas';
	return $classes;
}
