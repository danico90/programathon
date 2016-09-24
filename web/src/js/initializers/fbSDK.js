(function($) {
	'use strict';

	function init() {
		$.ajaxSetup({ cache: true });

		$.getScript('//connect.facebook.net/en_US/sdk.js', fbInit);
	}

	function fbInit() {
		FB.init({
			appId: '314013512283149',
			xfbml: true,
      		version: 'v2.7'
		});

		//$('#loginbutton, #feedbutton').removeAttr('disabled');
		
		// Allow an status callback
		FB.getLoginStatus(connectionCb);
	}

	function connectionCb() {
		console.log('FaceBook DK initialized');
	}

	app.initializers.fbSDK = {
		init: init
	};
})($);
