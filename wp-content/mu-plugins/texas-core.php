<?php
/**
 * Plugin Name: texas-core
 * Description: Τύποι περιεχομένου, ταξινομίες και θωράκιση για το texas.gr. Φορτώνεται ως mu-plugin.
 * Version: 0.1.0
 * Text Domain: texas-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'texas_core_register_post_types' );
function texas_core_register_post_types() {
	$types = array(
		'syntagi' => array(
			'name'          => __( 'Συνταγές', 'texas-core' ),
			'singular_name' => __( 'Συνταγή', 'texas-core' ),
			'slug'          => 'syntages',
			'menu_icon'     => 'dashicons-food',
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		),
		'psimo' => array(
			'name'          => __( 'Ψησίματα', 'texas-core' ),
			'singular_name' => __( 'Ψήσιμο', 'texas-core' ),
			'slug'          => 'psisimata',
			'menu_icon'     => 'dashicons-chart-line',
			'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		),
		'leksiko' => array(
			'name'          => __( 'Λεξικό', 'texas-core' ),
			'singular_name' => __( 'Λήμμα', 'texas-core' ),
			'slug'          => 'lexiko',
			'menu_icon'     => 'dashicons-book-alt',
			'supports'      => array( 'title', 'editor', 'custom-fields' ),
		),
		'exoplismos' => array(
			'name'          => __( 'Εξοπλισμός', 'texas-core' ),
			'singular_name' => __( 'Κριτική', 'texas-core' ),
			'slug'          => 'exoplismos',
			'menu_icon'     => 'dashicons-tool',
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		),
	);

	foreach ( $types as $key => $args ) {
		register_post_type( $key, array(
			'labels'        => array(
				'name'          => $args['name'],
				'singular_name' => $args['singular_name'],
			),
			'public'        => true,
			'has_archive'   => false,
			'rewrite'       => array( 'slug' => $args['slug'], 'with_front' => false ),
			'menu_icon'     => $args['menu_icon'],
			'show_in_rest'  => true,
			'supports'      => $args['supports'],
			'menu_position' => 20,
		) );
	}
}

add_action( 'init', 'texas_core_register_taxonomies' );
function texas_core_register_taxonomies() {
	$taxonomies = array(
		'kopi'     => array( __( 'Κοπές', 'texas-core' ), __( 'Κοπή', 'texas-core' ), array( 'post', 'syntagi', 'psimo' ) ),
		'zwo'      => array( __( 'Ζώο', 'texas-core' ), __( 'Ζώο', 'texas-core' ), array( 'post', 'syntagi', 'psimo' ) ),
		'xylo'     => array( __( 'Ξύλα', 'texas-core' ), __( 'Ξύλο', 'texas-core' ), array( 'post', 'syntagi', 'psimo' ) ),
		'tefhniki' => array( __( 'Τεχνικές', 'texas-core' ), __( 'Τεχνική', 'texas-core' ), array( 'post', 'syntagi' ) ),
		'exoplismos-xrisimopoiithike' => array( __( 'Εξοπλισμός', 'texas-core' ), __( 'Εξοπλισμός', 'texas-core' ), array( 'post', 'psimo' ) ),
	);

	foreach ( $taxonomies as $key => $args ) {
		register_taxonomy( $key, $args[2], array(
			'labels'      => array(
				'name'          => $args[0],
				'singular_name' => $args[1],
			),
			'public'      => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'     => array( 'slug' => $key, 'with_front' => false ),
		) );
	}
}

add_action( 'init', 'texas_core_register_meta' );
function texas_core_register_meta() {
	$syntagi_meta = array( 'kopo', 'varos', 'temp_thalamos', 'temp_tyligma', 'temp_teliki', 'xylo', 'ores ekspert', 'ores_xekourasis', 'merides' );
	foreach ( $syntagi_meta as $key ) {
		register_post_meta( 'syntagi', $key, array(
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
			'auth_callback' => '__return_true',
		) );
	}

	register_post_meta( 'psimo', 'metriseis', array(
		'type'         => 'array',
		'single'       => true,
		'show_in_rest' => array(
			'schema' => array(
				'type'  => 'array',
				'items' => array(
					'type'       => 'object',
					'properties' => array(
						'ora'      => array( 'type' => 'string' ),
						'thalamos' => array( 'type' => 'string' ),
						'kreas'    => array( 'type' => 'string' ),
					),
				),
			),
		),
		'auth_callback' => '__return_true',
	) );

	register_post_meta( 'leksiko', 'elliniki_apodosi', array(
		'type'         => 'string',
		'single'       => true,
		'show_in_rest' => true,
		'auth_callback' => '__return_true',
	) );
}

add_action( 'init', 'texas_core_hardening' );
function texas_core_hardening() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'xmlrpc_enabled', '__return_false' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
