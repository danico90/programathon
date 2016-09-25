(function() {
	function init() {
		$('.date-picker').datepicker({});
	}

	app.initializers.datePicker = {
		init: init
	};
})();
