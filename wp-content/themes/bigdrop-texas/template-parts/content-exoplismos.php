<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
	<header class="article-head">
		<h1><?php the_title(); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="article-hero"><?php the_post_thumbnail( 'texas-hero' ); ?></figure>
	<?php endif; ?>
	<div class="article-content">
		<?php the_content(); ?>
	</div>
</article>
