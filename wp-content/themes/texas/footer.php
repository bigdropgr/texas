<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</div>
</main>
<footer class="site-footer">
	<div class="wrap footer-grid">
		<div>
			<p class="footer-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
			<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
		</div>
		<nav aria-label="<?php esc_attr_e( 'Μενού υποσέλιδου', 'texas' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'fallback_cb'    => 'texas_footer_fallback',
				'depth'          => 1,
			) );
			?>
		</nav>
	</div>
	<div class="wrap footer-base">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
