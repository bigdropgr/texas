<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
	<header class="article-head">
		<h1><?php the_title(); ?></h1>
		<?php $meta = get_post_meta( get_the_ID(), 'elliniki_apodosi', true ); ?>
		<?php if ( $meta ) : ?>
			<p class="article-meta"><?php echo esc_html( $meta ); ?></p>
		<?php endif; ?>
	</header>
	<div class="article-content">
		<?php the_content(); ?>
	</div>
</article>
