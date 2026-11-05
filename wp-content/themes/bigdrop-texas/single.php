<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$type = get_post_type();
	if ( $type !== 'post' && $type !== 'page' && locate_template( "template-parts/content-{$type}.php" ) ) {
		get_template_part( 'template-parts/content', $type );
	} else {
		get_template_part( 'template-parts/content', 'single' );
	}
endwhile;
get_footer();
