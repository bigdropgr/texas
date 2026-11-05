(function () {
	'use strict';

	var data = window.texasSmokerBuilder || { i18n: {} };
	var i18n = data.i18n;
	var PI = Math.PI;

	var form = document.getElementById('txs-form');
	if (!form) {
		return;
	}

	var chamberType = document.getElementById('txs-chamber-type');
	var fireboxType = document.getElementById('txs-firebox-type');
	var intakeType = document.getElementById('txs-intake-type');
	var errorEl = document.getElementById('txs-error');
	var resultEl = document.getElementById('txs-result');

	function num(id) {
		var el = document.getElementById(id);
		var v = parseFloat(el.value);
		return isNaN(v) ? null : v;
	}

	function showFields(containerId, type) {
		var container = document.getElementById(containerId);
		var fields = container.querySelectorAll('.txs-field');
		for (var i = 0; i < fields.length; i++) {
			fields[i].hidden = fields[i].getAttribute('data-for') !== type;
		}
	}

	chamberType.addEventListener('change', function () {
		showFields('txs-chamber-fields', chamberType.value);
	});
	fireboxType.addEventListener('change', function () {
		showFields('txs-firebox-fields', fireboxType.value);
	});
	intakeType.addEventListener('change', function () {
		var wrap = document.getElementById('txs-intake-fields');
		wrap.hidden = intakeType.value === '';
		if (intakeType.value) {
			showFields('txs-intake-fields', intakeType.value);
		}
	});

	function chamberVolume() {
		var type = chamberType.value;
		if (type === 'cylinder') {
			var d = num('txs-ch-d');
			var l = num('txs-ch-l');
			if (!d || !l) { return null; }
			return PI * Math.pow(d / 2, 2) * l;
		}
		if (type === 'tank') {
			var v = num('txs-ch-vol');
			if (!v) { return null; }
			return v * 1000;
		}
		var h = num('txs-ch-h');
		var w = num('txs-ch-w');
		var len = num('txs-ch-len');
		if (!h || !w || !len) { return null; }
		return h * w * len;
	}

	function fireboxVolume() {
		var type = fireboxType.value;
		if (type === 'square') {
			var h = num('txs-fb-h');
			var w = num('txs-fb-w');
			var l = num('txs-fb-l');
			if (!h || !w || !l) { return null; }
			return h * w * l;
		}
		var d = num('txs-fb-d');
		var len = num('txs-fb-len');
		if (!d || !len) { return null; }
		return PI * Math.pow(d / 2, 2) * len;
	}

	function fmt(n, digits) {
		return n.toLocaleString('el-GR', { maximumFractionDigits: digits === undefined ? 0 : digits });
	}

	function compute() {
		var chamber = chamberVolume();
		var firebox = fireboxVolume();
		var chimneyD = num('txs-chimney-d');

		if (!chamber || !firebox || !chimneyD) {
			errorEl.textContent = i18n.invalid;
			errorEl.hidden = false;
			resultEl.hidden = true;
			return;
		}
		errorEl.hidden = true;

		var fireboxRec = chamber / 3;
		var diffPct = ((firebox - fireboxRec) / fireboxRec) * 100;

		document.getElementById('txs-r-chamber').textContent = fmt(chamber) + ' cm³ (' + fmt(chamber / 1000, 0) + ' L)';
		document.getElementById('txs-r-firebox-rec').textContent = fmt(fireboxRec) + ' cm³';

		var userCell = document.getElementById('txs-r-firebox-user');
		var badge = diffPct < 0
			? ' <span class="txs-badge-warn">(' + fmt(diffPct, 1) + '% — ' + i18n.smaller + ')</span>'
			: ' <span class="txs-badge-ok">(' + fmt(diffPct, 1) + '% — ' + i18n.ok + ')</span>';
		userCell.innerHTML = fmt(firebox) + ' cm³' + badge;

		var chimneyVol = firebox * 0.05;
		var chimneyLen = chimneyVol / (PI * Math.pow(chimneyD / 2, 2));
		document.getElementById('txs-r-chimney').textContent = fmt(chimneyLen, 1) + ' cm';

		var intakeArea = firebox * 0.003;
		var holeArea = PI * Math.pow(5, 2);
		var count = Math.max(1, Math.ceil(intakeArea / holeArea));
		var intakeText = fmt(intakeArea, 1) + ' cm² ≈ ' + count + (count === 1 ? ' άνοιγμα' : ' ανοίγματα') + ' Ø10 cm';
		if (intakeType.value === 'square') {
			var iw = num('txs-in-w');
			var ih = num('txs-in-h');
			if (iw && ih) {
				var userArea = iw * ih;
				intakeText += ' — η δική σου: ' + fmt(userArea, 1) + ' cm² ' + (userArea >= intakeArea ? '(' + i18n.ok + ')' : '(λίγη)');
			}
		} else if (intakeType.value === 'round') {
			var id = num('txs-in-d');
			if (id) {
				var userArea = PI * Math.pow(id / 2, 2);
				intakeText += ' — η δική σου: ' + fmt(userArea, 1) + ' cm² ' + (userArea >= intakeArea ? '(' + i18n.ok + ')' : '(λίγη)');
			}
		}
		document.getElementById('txs-r-intake').textContent = intakeText;

		var openArea = firebox * 0.008;
		var roundD = Math.sqrt((4 * openArea) / PI);
		var halfMoonD = 2 * Math.sqrt((2 * openArea) / PI);
		document.getElementById('txs-r-opening').textContent =
			fmt(openArea, 1) + ' cm² · στρογγυλό Ø' + fmt(roundD, 1) + ' cm · μισοφέγγαρο Ø' + fmt(halfMoonD, 1) + ' cm';

		document.getElementById('txs-disclaimer').textContent = i18n.disclaimer;

		resultEl.hidden = false;
		resultEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	}

	showFields('txs-chamber-fields', chamberType.value);
	showFields('txs-firebox-fields', fireboxType.value);

	form.addEventListener('submit', function (e) {
		e.preventDefault();
		compute();
	});
})();
