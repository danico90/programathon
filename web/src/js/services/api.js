(function($) {
	var api = {
		call: call
	};

	function call(method, url, data) {
		return $.ajax({
			method: method,
			url: url,
			data: data
		});
	}

	app.services.api = api;
})($);
