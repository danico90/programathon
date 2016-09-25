(function() {
	
	function init() {
        onEstadoInputChange();
        onIsActiveInputChange();
	}

    // Sets the value of the "EstadoID" select into the
    // hidden EstadoID for the user, needed for validation in the model.
    function onEstadoInputChange() {
        
        $( "select#pyme-estadoid" ).change();

        $( "select#pyme-estadoid" ).change( function(e) {
            $( "#usuario-usuarioestadoid" ).val($(this).val());
        });

    }

    function onIsActiveInputChange() {
        $(".IsActiveInput").change(function(e) {

            $submitButton = $("button[type=submit]");

            if($(this).is(":checked")) {
                $submitButton.removeClass("verify-continue");
            }
            else {
                $submitButton.addClass("verify-continue");
            }

            // inits the verifyContinue functionality 
            app.initializers.verifyContinue.init();
            
        });
    }

	app.templates.pymeCreateUpdateForm = {
		init: init
	}
})();
