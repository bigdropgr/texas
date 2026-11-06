<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="archive-head">
	<h1><?php printf( esc_html__( 'Αποτελέσματα για: %s', 'texas' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	<?php get_search_form(); ?>
</section>
<div class="card-grid">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			texas_card( get_the_ID() );
		endwhile;
	else :
		?>
		<p><?php esc_html_e( 'Κανένα αποτέλεσμα. Δοκίμασε άλλη αναζήτηση.', 'texas' ); ?></p>
		<?php
	endif;
	?>
</div>
<?php
the_posts_pagination( array(
	'mid_size'  => 1,
	'prev_text' => __( 'Προηγούμενα', 'texas' ),
	'next_text' => __( 'Επόμενα', 'texas' ),
) );
get_footer();
