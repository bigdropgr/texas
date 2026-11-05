<?php
/**
 * Plugin Name: texas-contact-form
 * Description: Απλή φόρμα επικοινωνίας για το texas.gr (όνομα, email, μήνυμα) με nonce, honeypot και αποστολή μέσω wp_mail. Shortcode: [texas_contact_form].
 * Version: 0.1.0
 * Text Domain: texas-contact-form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'texas_contact_form_register' );
function texas_contact_form_register() {
	load_plugin_textdomain( 'texas-contact-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	add_shortcode( 'texas_contact_form', 'texas_contact_form_shortcode' );
}

add_action( 'wp_enqueue_scripts', 'texas_contact_form_assets' );
function texas_contact_form_assets() {
	global $post;
	if ( ! ( is_singular() && $post && has_shortcode( $post->post_content, 'texas_contact_form' ) ) ) {
		return;
	}
	wp_enqueue_style( 'texas-contact-form', plugins_url( 'assets/contact-form.css', __FILE__ ), array(), '0.1.0' );
}

function texas_contact_form_shortcode() {
	$status = '';
	$status_type = '';

	if ( isset( $_POST['texas_contact_submit'] ) ) {
		if ( ! isset( $_POST['texas_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['texas_contact_nonce'] ) ), 'texas_contact_form' ) ) {
			$status = __( 'Η φόρμα απέτυχε (μη έγκυρο nonce). Ξαναδοκίμασε.', 'texas-contact-form' );
			$status_type = 'error';
		} elseif ( ! empty( $_POST['texas_contact_website'] ) ) {
			$status = '';
		} else {
			$name    = sanitize_text_field( wp_unslash( $_POST['texas_contact_name'] ?? '' ) );
			$email   = sanitize_email( wp_unslash( $_POST['texas_contact_email'] ?? '' ) );
			$message = sanitize_textarea_field( wp_unslash( $_POST['texas_contact_message'] ?? '' ) );

			if ( ! $name || ! is_email( $email ) || ! $message ) {
				$status = __( 'Συμπλήρωσε όνομα, σωστό email και μήνυμα.', 'texas-contact-form' );
				$status_type = 'error';
			} else {
				$to      = get_option( 'admin_email' );
				$subject = 'Νέο μήνυμα από texas.gr — ' . $name;
				$body    = "Όνομα: {$name}\nEmail: {$email}\n\nΜήνυμα:\n{$message}";
				$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

				if ( wp_mail( $to, $subject, $body, $headers ) ) {
					$status = __( 'Το μήνυμά σου στάλθηκε. Ευχαριστούμε!', 'texas-contact-form' );
					$status_type = 'success';
				} else {
					$status = __( 'Αποτυχία αποστολής. Δοκίμασε ξανά αργότερα.', 'texas-contact-form' );
					$status_type = 'error';
				}
			}
		}
	}

	ob_start();
	?>
	<div class="txcf">
		<?php if ( $status ) : ?>
			<p class="txcf-status txcf-<?php echo esc_attr( $status_type ); ?>" role="status"><?php echo esc_html( $status ); ?></p>
		<?php endif; ?>
		<form method="post" class="txcf-form" novalidate>
			<?php wp_nonce_field( 'texas_contact_form', 'texas_contact_nonce' ); ?>
			<div class="txcf-field txcf-honeypot" aria-hidden="true">
				<label for="txcf-website">Website</label>
				<input type="text" id="txcf-website" name="texas_contact_website" tabindex="-1" autocomplete="off">
			</div>
			<div class="txcf-field">
				<label for="txcf-name"><?php esc_html_e( 'Όνομα', 'texas-contact-form' ); ?></label>
				<input type="text" id="txcf-name" name="texas_contact_name" required>
			</div>
			<div class="txcf-field">
				<label for="txcf-email"><?php esc_html_e( 'Email', 'texas-contact-form' ); ?></label>
				<input type="email" id="txcf-email" name="texas_contact_email" required>
			</div>
			<div class="txcf-field">
				<label for="txcf-message"><?php esc_html_e( 'Μήνυμα', 'texas-contact-form' ); ?></label>
				<textarea id="txcf-message" name="texas_contact_message" rows="6" required></textarea>
			</div>
			<button type="submit" name="texas_contact_submit" class="btn"><?php esc_html_e( 'Αποστολή', 'texas-contact-form' ); ?></button>
		</form>
	</div>
	<?php
	return ob_get_clean();
}
