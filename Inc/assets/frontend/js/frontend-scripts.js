"use strict";

(function ($) {
    $(document).on("ready", function () {
        var lengthscomments = $(".comment-tripadvisor").length;
        
        if ( lengthscomments > 5 ) {
            $('.comment-tripadvisor').slice(5).addClass("hide");
                // $('.show-button').show();
                $('.show-button').removeClass("hide");

            $('body').on('click', '.show-button', function () {
                $('.comment-tripadvisor').slice(5).removeClass("hide");
                $('.show-button').addClass("hide");
                $('.comments-tripadvisor p').removeClass("hide");

            });
        }else{
            $('.comments-tripadvisor p').removeClass("hide");
        }

    })
})(jQuery);
