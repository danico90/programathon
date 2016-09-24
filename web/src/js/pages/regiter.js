(function() {
	var api = app.services.api;

	function getStates(country) {
		var data = {}

		api.call('get', '/', data);
	}

	app.templates.register = {
		getStates: getStates
	}
})();
