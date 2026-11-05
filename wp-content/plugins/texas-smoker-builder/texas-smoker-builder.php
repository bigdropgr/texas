<?php
/**
 * Plugin Name: texas-smoker-builder
 * Description: Διαστασιολόγηση custom smoker για το texas.gr (firebox, καμινάδα, εισαγωγή αέρα, άνοιγμα θαλάμου). Shortcode: [texas_smoker_builder]. Τα assets φορτώνονται μόνο στη σελίδα με το shortcode.
 * Version: 0.1.0
 * Requires at least: 6.4
 * Requires PHP: 8.1
 * Text Domain: texas-smoker-builder
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TEXAS_SMOKER_BUILDER_VERSION', '0.1.0' );
define( 'TEXAS_SMOKER_BUILDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'TEXAS_SMOKER_BUILDER_URI', plugin_dir_url( __FILE__ ) );

add_action( 'init', 'texas_smoker_builder_register' );
function texas_smoker_builder_register() {
	load_plugin_textdomain( 'texas-smoker-builder', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	add_shortcode( 'texas_smoker_builder', 'texas_smoker_builder_shortcode' );
}

function texas_smoker_builder_shortcode( $atts ) {
	texas_smoker_builder_enqueue();
	ob_start();
	include TEXAS_SMOKER_BUILDER_PATH . 'templates/calculator.php';
	return ob_get_clean();
}

add_action( 'wp_enqueue_scripts', 'texas_smoker_builder_maybe_enqueue' );
function texas_smoker_builder_maybe_enqueue() {
	global $post;
	if ( ! ( is_singular() && $post && has_shortcode( $post->post_content, 'texas_smoker_builder' ) ) ) {
		return;
	}
	texas_smoker_builder_enqueue();
}

function texas_smoker_builder_enqueue() {
	static $done = false;
	if ( $done ) {
		return;
	}
	$done = true;

	wp_enqueue_style(
		'texas-smoker-builder',
		TEXAS_SMOKER_BUILDER_URI . 'assets/css/calculator.css',
		array(),
		TEXAS_SMOKER_BUILDER_VERSION
	);

	wp_enqueue_script(
		'texas-smoker-builder',
		TEXAS_SMOKER_BUILDER_URI . 'assets/js/calculator.js',
		array(),
		TEXAS_SMOKER_BUILDER_VERSION,
		true
	);

	wp_localize_script( 'texas-smoker-builder', 'texasSmokerBuilder', array(
		'i18n' => array(
			'disclaimer' => __( 'Οι αναλογίες είναι κατευθυντήριες γραμμές κατασκευής (firebox 1/3 θαλάμου, καμινάδα 5%, εισαγωγή 0,3%, άνοιγμα 0,8% του firebox). Κάθε κατασκευή θέλει δοκιμή και διόρθωση.', 'texas-smoker-builder' ),
			'invalid'    => __( 'Συμπλήρωσε σωστά όλες τις διαστάσεις (θετικοί αριθμοί).', 'texas-smoker-builder' ),
			'smaller'    => __( 'μικρότερο από το προτεινόμενο', 'texas-smoker-builder' ),
			'ok'         => __( 'εντάξει', 'texas-smoker-builder' ),
		),
	) );
}
