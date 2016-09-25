(function() {
	'use strict';

	$(document).ready(function() {
		// FB SDK init
		app.initializers.fbSDK.init();

		// Bootstrap date picker init
		app.initializers.datePicker.init();
	});
})();