<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
	<header class="article-head">
		<h1><?php the_title(); ?></h1>
		<p class="article-meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-hidden="true">·</span>
			<?php printf( esc_html__( '%d λεπτά ανάγνωσης', 'texas' ), texas_reading_time() ); ?>
		</p>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="article-hero">
			<?php the_post_thumbnail( 'texas-hero' ); ?>
			<?php if ( get_post( get_post_thumbnail_id() ) && get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
				<figcaption><?php echo esc_html( get_post( get_post_thumbnail_id() )->post_excerpt ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>
	<div class="article-content">
		<?php the_content(); ?>
	</div>
	<footer class="article-foot">
		<?php
		$terms = get_the_terms( get_the_ID(), 'kopi' );
		if ( $terms && ! is_wp_error( $terms ) ) :
			echo '<p class="article-tags">' . esc_html__( 'Κοπές:', 'texas' ) . ' ';
			$links = array();
			foreach ( $terms as $term ) {
				$links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
			}
			echo wp_kses_post( implode( ', ', $links ) );
			echo '</p>';
		endif;
		?>
	</footer>
</article>
