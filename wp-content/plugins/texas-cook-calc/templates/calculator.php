<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$cuts = texas_cook_calc_cuts();
?>
<div class="txc-calc" id="txc-calc">
	<form class="txc-form card" id="txc-form" novalidate>
		<div class="txc-field">
			<label for="txc-cut"><?php esc_html_e( 'Κοπή', 'texas-cook-calc' ); ?></label>
			<select id="txc-cut" name="cut" required>
				<?php
				$group = '';
				foreach ( $cuts as $cut ) :
					if ( $cut['group'] !== $group ) :
						if ( $group !== '' ) {
							echo '</optgroup>';
						}
						$group = $cut['group'];
						echo '<optgroup label="' . esc_attr( $group ) . '">';
					endif;
					printf(
						'<option value="%s">%s</option>',
						esc_attr( $cut['key'] ),
						esc_html( $cut['label'] )
					);
				endforeach;
				echo '</optgroup>';
				?>
			</select>
		</div>
		<div class="txc-field">
			<label for="txc-weight"><?php esc_html_e( 'Βάρος', 'texas-cook-calc' ); ?></label>
			<div class="txc-input-unit">
				<input type="number" id="txc-weight" name="weight" min="0.1" step="0.1" inputmode="decimal" required>
				<span class="txc-unit">kg</span>
			</div>
		</div>
		<div class="txc-field">
			<label for="txc-temp"><?php esc_html_e( 'Θερμοκρασία θαλάμου', 'texas-cook-calc' ); ?></label>
			<div class="txc-input-unit">
				<select id="txc-temp" name="temp">
					<option value="100">100 °C</option>
					<option value="107" selected>107 °C</option>
					<option value="120">120 °C</option>
					<option value="135">135 °C</option>
					<option value="150">150 °C</option>
				</select>
			</div>
		</div>
		<div class="txc-field">
			<label for="txc-serving"><?php esc_html_e( 'Ώρα σερβιρίσματος (προαιρετικό)', 'texas-cook-calc' ); ?></label>
			<input type="datetime-local" id="txc-serving" name="serving">
		</div>
		<div class="txc-actions">
			<button type="submit" class="btn"><?php esc_html_e( 'Υπολόγισε', 'texas-cook-calc' ); ?></button>
		</div>
		<p class="txc-error" id="txc-error" role="alert" hidden></p>
	</form>

	<div class="txc-result" id="txc-result" aria-live="polite" hidden>
		<dl class="txc-result-list">
			<div><dt id="txc-l-range"></dt><dd id="txc-r-range"></dd></div>
			<div><dt id="txc-l-start"></dt><dd id="txc-r-start"></dd></div>
			<div><dt id="txc-l-target"></dt><dd id="txc-r-target"></dd></div>
			<div><dt id="txc-l-wrap"></dt><dd id="txc-r-wrap"></dd></div>
			<div><dt id="txc-l-rest"></dt><dd id="txc-r-rest"></dd></div>
			<div><dt id="txc-l-wood"></dt><dd id="txc-r-wood"></dd></div>
		</dl>
		<p class="txc-disclaimer" id="txc-disclaimer"></p>
	</div>

	<noscript>
		<p class="txc-noscript"><?php esc_html_e( 'Ο υπολογιστής χρειάζεται JavaScript. Χωρίς αυτό μπορείς να ακολουθήσεις τις συνταγές με τους πίνακες θερμοκρασιών.', 'texas-cook-calc' ); ?></p>
	</noscript>
</div>
