/* 
    USAGE: 
    - Add the following class on the button/link: verify-cancel
    - Add the message you want to show with a data attr: data-message=""
*/

(function() {

    "use strict";

    function init() {

        $(".verify-cancel").click(function(e) {

            var message = $(this).attr("data-message");

            // Default message
            if(!message){
                message = "¿Desea cancelar?"
            }

            var confirmation = confirm(message);

            if (confirmation == false) {
                return false;
            } 

        });
    }

    app.initializers.verifyCancel = {
        init: init,
    };

})();
