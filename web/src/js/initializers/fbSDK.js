(function($) {
	'use strict';

	function init() {
		var deferred = $.Deferred();

		$.ajaxSetup({ cache: true });
		$.getScript('//connect.facebook.net/en_US/sdk.js', fbInit).then(function() {
			deferred.resolve();
		});

		return deferred.promise();
	}

	function fbInit() {
		FB.init({
			appId      : '187524201658172',
			xfbml      : true,
			cookie     : true,
			version    : 'v2.7'
		});
		
		// Allow an status callback
		checkLoginState();
	}

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			console.log(response);
			return response;
		});
	}

	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);

		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			testAPI();
		} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
		}
	}

	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		
		FB.api('/me', function(response) {
			console.log(response);
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
		});
	}

	app.initializers.fbSDK = {
		init: init,
		checkLoginState: checkLoginState
	};
})($);
