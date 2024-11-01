"use strict";

(function ($) {
    $(document).on("ready", function () {
        $('#login_form').submit(function() {
            $('.gif-preload').css('visibility', 'visible');
        });
    })
})(jQuery);