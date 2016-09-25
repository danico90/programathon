(function() {

    function send() {
        $('#fbError').html('');
        if (window.fbStatus != 'connected') {

            FB.login(function(response) {
                console.log(response);
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', 'get', { fields: 'id,name,gender' }, function(responseG) {
                        if (responseG.gender == 'male') {
                            $('#respuesta-generoid').val('M');
                        }
                        else {
                            if (responseG.gender == 'male') {
                                $('#respuesta-generoid').val('F');
                            }
                            else {
                                $('#respuesta-generoid').val('N');
                            }
                        }
                        window.facebookID = responseG.id;
                        $('#poll-form').submit();
                    });
                } else {
                    $('#fbError').html('Necesita autorizar la aplicación para guardar los datos.');
                }
            });
          
        }
        else {
            console.log('else');
            FB.api('/me', 'get', { fields: 'id,name,gender' }, function(responseG) {
                 if (responseG.gender == 'male') {
                        $('#respuesta-generoid').val('M');
                    }
                    else {
                        if (responseG.gender == 'male') {
                            $('#respuesta-generoid').val('F');
                        }
                        else {
                            $('#respuesta-generoid').val('N');
                        }
                    }
                    $('#poll-form').submit();
            });
        }

        return false;
        
    }

	app.templates.createRespuesta = {
		send: send
	}
})();
