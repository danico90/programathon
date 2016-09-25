(function() {
	
	function init() {
        onEstadoInputChange();
	}

    // Sets the value of the "EstadoID" select into the
    // hidden EstadoID for the user, needed for validation in the model.
    function onEstadoInputChange() {
        
        $( "select#pyme-estadoid" ).change( function(e) {

            $( "#usuario-estadoid" ).val($(this).val());
            
        });

    }

	app.templates.pymeCreateUpdateForm = {
		init: init
	}
})();
