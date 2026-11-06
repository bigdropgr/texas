<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function texas_reading_time( $post_id = 0 ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return 1;
	}
	$words = str_word_count( wp_strip_all_tags( $post->post_content ) );
	return max( 1, (int) ceil( $words / 200 ) );
}

function texas_post_thumbnail( $size = 'texas-card', $class = '' ) {
	if ( ! has_post_thumbnail() ) {
		return;
	}
	the_post_thumbnail( $size, array( 'class' => $class ) );
}

function texas_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Διαδρομή', 'texas' ) . '">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Αρχική', 'texas' ) . '</a>';
	if ( is_singular() ) {
		$type = get_post_type_object( get_post_type() );
		if ( $type && ! in_array( get_post_type(), array( 'post', 'page' ), true ) ) {
			echo ' <span aria-hidden="true">/</span> <a href="' . esc_url( get_post_type_archive_link( get_post_type() ) ) . '">' . esc_html( $type->labels->name ) . '</a>';
		}
		echo ' <span aria-hidden="true">/</span> <span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_archive() ) {
		echo ' <span aria-hidden="true">/</span> <span aria-current="page">' . esc_html( get_the_archive_title() ) . '</span>';
	}
	echo '</nav>';
}

function texas_card( $post_id, $show_excerpt = true ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return;
	}
	$type = get_post_type_object( $post->post_type );
	$archive = ( $post->post_type !== 'post' && $post->post_type !== 'page' ) ? get_post_type_archive_link( $post->post_type ) : home_url( '/odigoi/' );
	?>
	<article class="card">
		<a class="card-media" href="<?php echo esc_url( get_permalink( $post ) ); ?>" tabindex="-1" aria-hidden="true">
			<?php echo get_the_post_thumbnail( $post, 'texas-card' ); ?>
		</a>
		<div class="card-body">
			<?php if ( $type && $post->post_type !== 'post' ) : ?>
				<p class="card-kicker"><?php echo esc_html( $type->labels->singular_name ); ?></p>
			<?php endif; ?>
			<h3 class="card-title"><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h3>
			<?php if ( $show_excerpt && has_excerpt( $post ) ) : ?>
				<p class="card-excerpt"><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
			<?php endif; ?>
		</div>
	</article>
	<?php
}
