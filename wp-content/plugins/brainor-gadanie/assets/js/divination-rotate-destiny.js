(function ($) {
    $(document).ready(function () {
        function resizeDivination() {
            $('.divination-rotate.ball-of-destiny .crc').each(function () {
                $(this).css({'height': $(this).width() + 'px'});
            });
        }

        resizeDivination();
        $( window ).resize(function() {
            resizeDivination();
        });
    });
})(jQuery);