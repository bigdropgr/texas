<?php
/**
 * Plugin Name: texas-cook-calc
 * Description: Υπολογιστής χρόνου ψησίματος για το texas.gr. Shortcode: [texas_cook_calc]. Τα assets φορτώνονται μόνο στη σελίδα με το shortcode.
 * Version: 0.1.0
 * Requires at least: 6.4
 * Requires PHP: 8.1
 * Text Domain: texas-cook-calc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TEXAS_COOK_CALC_VERSION', '0.1.0' );
define( 'TEXAS_COOK_CALC_PATH', plugin_dir_path( __FILE__ ) );
define( 'TEXAS_COOK_CALC_URI', plugin_dir_url( __FILE__ ) );

require_once TEXAS_COOK_CALC_PATH . 'includes/cuts.php';

add_action( 'init', 'texas_cook_calc_register' );
function texas_cook_calc_register() {
	load_plugin_textdomain( 'texas-cook-calc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	add_shortcode( 'texas_cook_calc', 'texas_cook_calc_shortcode' );
}

function texas_cook_calc_shortcode( $atts ) {
	texas_cook_calc_enqueue();
	ob_start();
	include TEXAS_COOK_CALC_PATH . 'templates/calculator.php';
	return ob_get_clean();
}

function texas_cook_calc_has_shortcode( $content ) {
	return has_shortcode( $content, 'texas_cook_calc' );
}

add_action( 'wp_enqueue_scripts', 'texas_cook_calc_maybe_enqueue' );
function texas_cook_calc_maybe_enqueue() {
	global $post;
	if ( ! ( is_singular() && $post && texas_cook_calc_has_shortcode( $post->post_content ) ) ) {
		return;
	}
	texas_cook_calc_enqueue();
}

function texas_cook_calc_enqueue() {
	static $done = false;
	if ( $done ) {
		return;
	}
	$done = true;

	wp_enqueue_style(
		'texas-cook-calc',
		TEXAS_COOK_CALC_URI . 'assets/css/calculator.css',
		array(),
		TEXAS_COOK_CALC_VERSION
	);

	wp_enqueue_script(
		'texas-cook-calc',
		TEXAS_COOK_CALC_URI . 'assets/js/calculator.js',
		array(),
		TEXAS_COOK_CALC_VERSION,
		true
	);

	wp_localize_script( 'texas-cook-calc', 'texasCookCalc', array(
		'cuts' => texas_cook_calc_cuts(),
		'i18n' => array(
			'hours'   => __( 'ώρες', 'texas-cook-calc' ),
			'minutes' => __( 'λεπτά', 'texas-cook-calc' ),
			'startAt' => __( 'Άναψε στις', 'texas-cook-calc' ),
			'target'  => __( 'Τελική εσωτερική θερμοκρασία', 'texas-cook-calc' ),
			'wrap'    => __( 'Τύλιγμα (stall)', 'texas-cook-calc' ),
			'rest'    => __( 'Ξεκούραση', 'texas-cook-calc' ),
			'wood'    => __( 'Προτεινόμενο ξύλο', 'texas-cook-calc' ),
			'range'   => __( 'Εύρος ψησίματος', 'texas-cook-calc' ),
			'invalid' => __( 'Βάλε βάρος μεγαλύτερο από 0.', 'texas-cook-calc' ),
			'disclaimer' => __( 'Οι χρόνοι είναι εκτιμήσεις σχεδιασμού. Η ετοιμότητα μετριέται πάντα με θερμόμετρο, όχι με το ρολόι.', 'texas-cook-calc' ),
		),
	) );
}
