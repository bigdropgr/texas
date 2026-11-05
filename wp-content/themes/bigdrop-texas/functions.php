<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TEXAS_VERSION', '0.1.0' );
define( 'TEXAS_PATH', get_template_directory() );
define( 'TEXAS_URI', get_template_directory_uri() );

require_once TEXAS_PATH . '/inc/setup.php';
require_once TEXAS_PATH . '/inc/enqueue.php';
require_once TEXAS_PATH . '/inc/template-tags.php';
require_once TEXAS_PATH . '/inc/footer-fallback.php';
