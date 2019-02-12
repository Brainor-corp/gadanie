(function ($) {
    $(document).ready(function () {
        function resizeDivination() {
            $('.divination-rotate.ball-of-destiny .crc').each(function () {
                $(this).css({'height': $(this).width() + 'px'});
            });

            console.log('resize');
        }

        resizeDivination();
        $( window ).resize(function() {
            resizeDivination();
        });

        $( window ).load(function() {
            resizeDivination();
        });
    });
})(jQuery);