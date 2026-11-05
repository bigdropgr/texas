<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="archive-head">
	<h1><?php echo esc_html( single_term_title( '', false ) ); ?></h1>
	<?php if ( term_description() ) : ?>
		<div class="archive-description"><?php echo wp_kses_post( term_description() ); ?></div>
	<?php endif; ?>
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
		<p><?php esc_html_e( 'Δεν βρέθηκε περιεχόμενο για αυτόν τον όρο.', 'texas' ); ?></p>
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
