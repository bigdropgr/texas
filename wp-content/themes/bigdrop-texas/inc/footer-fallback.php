<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function texas_footer_fallback() {
	$links = array(
		'/odigoi/'      => __( 'Οδηγοί', 'texas' ),
		'/syntages/'    => __( 'Συνταγές', 'texas' ),
		'/psisimata/'   => __( 'Ημερολόγιο ψησίματος', 'texas' ),
		'/lexiko/'      => __( 'Λεξικό', 'texas' ),
		'/ergaleia/'    => __( 'Εργαλεία', 'texas' ),
		'/epikoinonia/' => __( 'Επικοινωνία', 'texas' ),
		'/idiotikotita/' => __( 'Ιδιωτικότητα', 'texas' ),
		'/oroi/'        => __( 'Όροι χρήσης', 'texas' ),
	);
	echo '<ul class="footer-menu">';
	foreach ( $links as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( $url ) ), esc_html( $label ) );
	}
	echo '</ul>';
}
