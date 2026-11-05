<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'texas_setup' );
function texas_setup() {
	load_theme_textdomain( 'texas', TEXAS_PATH . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array( 'height' => 40, 'width' => 160, 'flex-height' => true ) );

	add_image_size( 'texas-card', 800, 500, true );
	add_image_size( 'texas-hero', 1600, 900, true );

	register_nav_menus( array(
		'primary' => __( 'Κύριο μενού', 'texas' ),
		'footer'  => __( 'Μενού υποσέλιδου', 'texas' ),
	) );
}

add_action( 'init', 'texas_register_blocks_area' );
function texas_register_blocks_area() {
	register_block_pattern_category( 'texas', array( 'label' => 'texas.gr' ) );
}
