(function () {
	'use strict';

	var data = window.texasCookCalc || { cuts: [], i18n: {} };
	var i18n = data.i18n;
	var cuts = data.cuts;

	var form = document.getElementById('txc-form');
	if (!form) {
		return;
	}

	var cutEl = document.getElementById('txc-cut');
	var weightEl = document.getElementById('txc-weight');
	var tempEl = document.getElementById('txc-temp');
	var servingEl = document.getElementById('txc-serving');
	var errorEl = document.getElementById('txc-error');
	var resultEl = document.getElementById('txc-result');

	function findCut(key) {
		for (var i = 0; i < cuts.length; i++) {
			if (cuts[i].key === key) {
				return cuts[i];
			}
		}
		return cuts[0];
	}

	function formatDuration(minutes) {
		var h = Math.floor(minutes / 60);
		var m = Math.round(minutes % 60);
		if (h > 0 && m > 0) {
			return h + ' ' + i18n.hours + ' ' + m + ' ' + i18n.minutes;
		}
		if (h > 0) {
			return h + ' ' + i18n.hours;
		}
		return m + ' ' + i18n.minutes;
	}

	function tempFactor(temp) {
		var t = Math.min(160, Math.max(90, temp));
		return Math.pow(107 / t, 1.2);
	}

	function compute() {
		var cut = findCut(cutEl.value);
		var weight = parseFloat(weightEl.value);
		var temp = parseFloat(tempEl.value);

		if (!weight || weight <= 0) {
			errorEl.textContent = i18n.invalid;
			errorEl.hidden = false;
			resultEl.hidden = true;
			return;
		}
		errorEl.hidden = true;

		var factor = tempFactor(temp);
		var minH, maxH;
		if (cut.fixedMin) {
			minH = cut.fixedMin * factor;
			maxH = cut.fixedMax * factor;
		} else {
			minH = cut.minKg * weight * factor;
			maxH = cut.maxKg * weight * factor;
		}

		document.getElementById('txc-l-range').textContent = i18n.range;
		document.getElementById('txc-r-range').textContent = formatDuration(minH * 60) + ' – ' + formatDuration(maxH * 60);

		var startCell = document.getElementById('txc-r-start');
		var startLabel = document.getElementById('txc-l-start');
		if (servingEl.value) {
			var serving = new Date(servingEl.value);
			var start = new Date(serving.getTime() - maxH * 3600000 - restMinutes(cut));
			startLabel.textContent = i18n.startAt;
			startCell.textContent = start.toLocaleString('el-GR', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' });
			startCell.parentElement.style.display = '';
		} else {
			startCell.parentElement.style.display = 'none';
		}

		document.getElementById('txc-l-target').textContent = i18n.target;
		document.getElementById('txc-r-target').textContent = cut.target + ' °C';

		var wrapCell = document.getElementById('txc-r-wrap');
		var wrapLabel = document.getElementById('txc-l-wrap');
		if (cut.wrap) {
			wrapLabel.textContent = i18n.wrap;
			wrapCell.textContent = '~' + cut.wrap + ' °C';
			wrapCell.parentElement.style.display = '';
		} else {
			wrapCell.parentElement.style.display = 'none';
		}

		document.getElementById('txc-l-rest').textContent = i18n.rest;
		document.getElementById('txc-r-rest').textContent = cut.rest;

		document.getElementById('txc-l-wood').textContent = i18n.wood;
		document.getElementById('txc-r-wood').textContent = cut.wood;

		document.getElementById('txc-disclaimer').textContent = i18n.disclaimer;

		resultEl.hidden = false;
		resultEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	}

	function restMinutes(cut) {
		var map = { '1–2 ώρες': 90, '45–90 λεπτά': 67, '1 ώρα': 60, '15–30 λεπτά': 22, '10–20 λεπτά': 15, '30–60 λεπτά': 45, '5–10 λεπτά': 7 };
		return (map[cut.rest] || 30) * 60000;
	}

	cutEl.addEventListener('change', function () {
		var cut = findCut(cutEl.value);
		if (cut.preferredTemp) {
			tempEl.value = String(cut.preferredTemp);
		}
	});

	form.addEventListener('submit', function (e) {
		e.preventDefault();
		compute();
	});
})();
