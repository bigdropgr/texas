<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$metriseis = get_post_meta( get_the_ID(), 'metriseis', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
	<header class="article-head">
		<h1><?php the_title(); ?></h1>
		<p class="article-meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</p>
	</header>
	<?php if ( $metriseis && is_array( $metriseis ) ) : ?>
		<table class="table">
			<thead>
				<tr>
					<th scope="col"><?php esc_html_e( 'Ώρα', 'texas' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Θάλαμος (°C)', 'texas' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Κρέας (°C)', 'texas' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $metriseis as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row['ora'] ?? '' ); ?></td>
						<td><?php echo esc_html( $row['thalamos'] ?? '' ); ?></td>
						<td><?php echo esc_html( $row['kreas'] ?? '' ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	<div class="article-content">
		<?php the_content(); ?>
	</div>
</article>
