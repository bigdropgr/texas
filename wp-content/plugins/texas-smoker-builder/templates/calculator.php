<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="txs-calc" id="txs-calc">
	<form class="txs-form" id="txs-form" novalidate>
		<fieldset class="txs-group">
			<legend><?php esc_html_e( '1. Θάλαμος μαγειρέματος', 'texas-smoker-builder' ); ?></legend>
			<div class="txs-field">
				<label for="txs-chamber-type"><?php esc_html_e( 'Τύπος θαλάμου', 'texas-smoker-builder' ); ?></label>
				<select id="txs-chamber-type" name="chamber-type">
					<option value="cylinder"><?php esc_html_e( 'Κύλινδρος', 'texas-smoker-builder' ); ?></option>
					<option value="tank"><?php esc_html_e( 'Δεξαμενή (όγκος σε λίτρα)', 'texas-smoker-builder' ); ?></option>
					<option value="rectangle"><?php esc_html_e( 'Ορθογώνιος', 'texas-smoker-builder' ); ?></option>
				</select>
			</div>
			<div class="txs-grid" id="txs-chamber-fields">
				<div class="txs-field" data-for="cylinder">
					<label for="txs-ch-d"><?php esc_html_e( 'Διάμετρος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-d" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="cylinder">
					<label for="txs-ch-l"><?php esc_html_e( 'Μήκος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-l" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="tank">
					<label for="txs-ch-vol"><?php esc_html_e( 'Όγκος (λίτρα)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-vol" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="rectangle">
					<label for="txs-ch-h"><?php esc_html_e( 'Ύψος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-h" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="rectangle">
					<label for="txs-ch-w"><?php esc_html_e( 'Πλάτος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-w" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="rectangle">
					<label for="txs-ch-len"><?php esc_html_e( 'Μήκος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-ch-len" min="1" step="0.1" inputmode="decimal">
				</div>
			</div>
		</fieldset>

		<fieldset class="txs-group">
			<legend><?php esc_html_e( '2. Firebox', 'texas-smoker-builder' ); ?></legend>
			<div class="txs-field">
				<label for="txs-firebox-type"><?php esc_html_e( 'Σχήμα firebox', 'texas-smoker-builder' ); ?></label>
				<select id="txs-firebox-type" name="firebox-type">
					<option value="square"><?php esc_html_e( 'Τετράγωνο / ορθογώνιο', 'texas-smoker-builder' ); ?></option>
					<option value="round"><?php esc_html_e( 'Στρογγυλό', 'texas-smoker-builder' ); ?></option>
				</select>
			</div>
			<div class="txs-grid" id="txs-firebox-fields">
				<div class="txs-field" data-for="square">
					<label for="txs-fb-h"><?php esc_html_e( 'Ύψος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-fb-h" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="square">
					<label for="txs-fb-w"><?php esc_html_e( 'Πλάτος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-fb-w" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="square">
					<label for="txs-fb-l"><?php esc_html_e( 'Μήκος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-fb-l" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="round">
					<label for="txs-fb-d"><?php esc_html_e( 'Διάμετρος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-fb-d" min="1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="round">
					<label for="txs-fb-len"><?php esc_html_e( 'Μήκος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-fb-len" min="1" step="0.1" inputmode="decimal">
				</div>
			</div>
		</fieldset>

		<fieldset class="txs-group">
			<legend><?php esc_html_e( '3. Καμινάδα', 'texas-smoker-builder' ); ?></legend>
			<div class="txs-field">
				<label for="txs-chimney-d"><?php esc_html_e( 'Διάμετρος σωλήνα καμινάδας (cm)', 'texas-smoker-builder' ); ?></label>
				<input type="number" id="txs-chimney-d" min="1" step="0.1" inputmode="decimal">
			</div>
		</fieldset>

		<fieldset class="txs-group">
			<legend><?php esc_html_e( '4. Εισαγωγή αέρα (προαιρετικό — για σύγκριση)', 'texas-smoker-builder' ); ?></legend>
			<div class="txs-field">
				<label for="txs-intake-type"><?php esc_html_e( 'Σχήμα εισαγωγής', 'texas-smoker-builder' ); ?></label>
				<select id="txs-intake-type" name="intake-type">
					<option value=""><?php esc_html_e( 'Παράλειψη', 'texas-smoker-builder' ); ?></option>
					<option value="square"><?php esc_html_e( 'Τετράγωνη', 'texas-smoker-builder' ); ?></option>
					<option value="round"><?php esc_html_e( 'Στρογγυλή', 'texas-smoker-builder' ); ?></option>
				</select>
			</div>
			<div class="txs-grid" id="txs-intake-fields" hidden>
				<div class="txs-field" data-for="square">
					<label for="txs-in-w"><?php esc_html_e( 'Πλάτος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-in-w" min="0.1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="square">
					<label for="txs-in-h"><?php esc_html_e( 'Ύψος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-in-h" min="0.1" step="0.1" inputmode="decimal">
				</div>
				<div class="txs-field" data-for="round">
					<label for="txs-in-d"><?php esc_html_e( 'Διάμετρος (cm)', 'texas-smoker-builder' ); ?></label>
					<input type="number" id="txs-in-d" min="0.1" step="0.1" inputmode="decimal">
				</div>
			</div>
		</fieldset>

		<div class="txs-actions">
			<button type="submit" class="btn"><?php esc_html_e( 'Υπολόγισε', 'texas-smoker-builder' ); ?></button>
		</div>
		<p class="txs-error" id="txs-error" role="alert" hidden></p>
	</form>

	<div class="txs-result" id="txs-result" aria-live="polite" hidden>
		<table class="table txs-table">
			<tbody>
				<tr><th scope="row"><?php esc_html_e( 'Όγκος θαλάμου', 'texas-smoker-builder' ); ?></th><td id="txs-r-chamber"></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Προτεινόμενο firebox (1/3)', 'texas-smoker-builder' ); ?></th><td id="txs-r-firebox-rec"></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Firebox της κατασκευής σου', 'texas-smoker-builder' ); ?></th><td id="txs-r-firebox-user"></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Καμινάδα (5% firebox) — μήκος', 'texas-smoker-builder' ); ?></th><td id="txs-r-chimney"></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Εισαγωγή αέρα (0,3% firebox)', 'texas-smoker-builder' ); ?></th><td id="txs-r-intake"></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Άνοιγμα firebox → θάλαμος (0,8% firebox)', 'texas-smoker-builder' ); ?></th><td id="txs-r-opening"></td></tr>
			</tbody>
		</table>
		<p class="txs-disclaimer" id="txs-disclaimer"></p>
	</div>

	<noscript>
		<p class="txs-noscript"><?php esc_html_e( 'Ο υπολογιστής χρειάζεται JavaScript για να δουλέψει.', 'texas-smoker-builder' ); ?></p>
	</noscript>
</div>
