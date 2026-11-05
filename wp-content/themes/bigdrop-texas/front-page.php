<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="hero">
	<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
	<p class="hero-lead"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
	<p><a class="btn" href="<?php echo esc_url( home_url( '/odigoi/' ) ); ?>"><?php esc_html_e( 'Δες τους οδηγούς', 'texas' ); ?></a></p>
</section>

<section class="section">
	<h2><?php esc_html_e( 'Τελευταία άρθρα', 'texas' ); ?></h2>
	<div class="card-grid">
		<?php
		$latest = new WP_Query( array( 'posts_per_page' => 3, 'post_type' => 'post' ) );
		if ( $latest->have_posts() ) :
			while ( $latest->have_posts() ) :
				$latest->the_post();
				texas_card( get_the_ID() );
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>

<section class="section">
	<h2><?php esc_html_e( 'Τελευταία ψησίματα', 'texas' ); ?></h2>
	<div class="card-grid">
		<?php
		$cooks = new WP_Query( array( 'posts_per_page' => 3, 'post_type' => 'psimo' ) );
		if ( $cooks->have_posts() ) :
			while ( $cooks->have_posts() ) :
				$cooks->the_post();
				texas_card( get_the_ID() );
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>

<section class="section">
	<h2><?php esc_html_e( 'Εργαλεία', 'texas' ); ?></h2>
	<div class="card-grid">
		<article class="card">
			<div class="card-body">
				<h3 class="card-title"><a href="<?php echo esc_url( home_url( '/ergaleia/ypologismos-chronou-psisimatos/' ) ); ?>"><?php esc_html_e( 'Υπολογιστής χρόνου ψησίματος', 'texas' ); ?></a></h3>
				<p class="card-excerpt"><?php esc_html_e( 'Βάρος, κοπή και θερμοκρασία θαλάμου — βγάζει εύρος ωρών, θερμοκρασία-στόχο και πότε να ανάψεις.', 'texas' ); ?></p>
			</div>
		</article>
		<article class="card">
			<div class="card-body">
				<h3 class="card-title"><a href="<?php echo esc_url( home_url( '/ergaleia/diastasiologisi-smoker/' ) ); ?>"><?php esc_html_e( 'Διαστασιολόγηση smoker', 'texas' ); ?></a></h3>
				<p class="card-excerpt"><?php esc_html_e( 'Firebox, καμινάδα, εισαγωγή αέρα και άνοιγμα θαλάμου από τις διαστάσεις του δικού σου smoker.', 'texas' ); ?></p>
			</div>
		</article>
	</div>
</section>
<?php
get_footer();
