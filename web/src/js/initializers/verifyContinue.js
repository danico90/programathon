/* 
    USAGE: 
    - Add the following class on the button/link: verify-cancel
    - Add the message you want to show with a data attr: data-message=""
*/

(function() {

    "use strict";

    function init() {
        var elements = $(".verify-continue");
        elements.unbind("click");
        setEvent(elements);
    }

    function setEvent(jqElements) {

        jqElements.click(function(e) {

            var self = $(this);

            if( !self.hasClass("verify-continue") ) {
                
                self.unbind("click");

            } else {

                var message = self.attr("data-message");

                // Default message
                if(!message){
                    message = "¿Desea proseguir?"
                }

                var confirmation = confirm(message);

                if (confirmation == false) {
                    return false;
                }
            }
            
        });
    }

    app.initializers.verifyContinue = {
        init: init
    };

})();
