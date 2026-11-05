<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="not-found">
	<h1><?php esc_html_e( '404 — Η σελίδα δεν βρέθηκε', 'texas' ); ?></h1>
	<p><?php esc_html_e( 'Αυτή η σελίδα δεν υπάρχει (ή μετακινήθηκε). Δοκίμασε ένα από τα παρακάτω:', 'texas' ); ?></p>
	<ul>
		<li><a href="<?php echo esc_url( home_url( '/odigoi/' ) ); ?>"><?php esc_html_e( 'Οδηγοί', 'texas' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/ergaleia/' ) ); ?>"><?php esc_html_e( 'Εργαλεία', 'texas' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Αρχική', 'texas' ); ?></a></li>
	</ul>
</section>
<?php
get_footer();
