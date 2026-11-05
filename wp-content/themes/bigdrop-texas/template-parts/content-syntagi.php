<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$fields = array(
	'kopo'        => __( 'Κοπή', 'texas' ),
	'varos'       => __( 'Βάρος ωμό (kg)', 'texas' ),
	'temp_thalamos' => __( 'Θερμοκρασία θαλάμου (°C)', 'texas' ),
	'temp_tyligma'  => __( 'Θερμοκρασία τυλίγματος (°C)', 'texas' ),
	'temp_teliki'   => __( 'Τελική εσωτερική (°C)', 'texas' ),
	'xylo'        => __( 'Ξύλο', 'texas' ),
	'ores ekspert'  => __( 'Ώρες ψησίματος', 'texas' ),
	'ores_xekourasis' => __( 'Ώρες ξεκούρασης', 'texas' ),
	'merides'     => __( 'Μερίδες', 'texas' ),
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
	<header class="article-head">
		<h1><?php the_title(); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="article-hero"><?php the_post_thumbnail( 'texas-hero' ); ?></figure>
	<?php endif; ?>
	<table class="table recipe-fields">
		<tbody>
			<?php foreach ( $fields as $key => $label ) : ?>
				<?php $value = get_post_meta( get_the_ID(), $key, true ); ?>
				<?php if ( $value ) : ?>
					<tr>
						<th scope="row"><?php echo esc_html( $label ); ?></th>
						<td><?php echo esc_html( $value ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="article-content">
		<?php the_content(); ?>
	</div>
</article>
