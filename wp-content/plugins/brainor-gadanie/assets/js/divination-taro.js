(function ($) {
    $(document).ready(function () {
        let totalCardsCount = $('.divination').data('card-count');
        let cardsNumbers = [];

        while (cardsNumbers.length < totalCardsCount) {
            var r = Math.floor(Math.random() * 78) + 1;
            if (cardsNumbers.indexOf(r) === -1) cardsNumbers.push(r);
        }

        let currentCardCounter = 0;

        $('.divination').on('click', '.hand-card', function () {
            if (currentCardCounter < cardsNumbers.length) {
                let num = cardsNumbers.pop();
                let card = $('#hidden-card-' + num.toString());
                $('#desk-card-' + (++currentCardCounter).toString() + ' a').stop().animate({opacity: 0}, 1000, function () {
                    $(this).css({'background': 'url(' + card.data('img') + ')'})
                        .animate({opacity: 1}, {duration: 1000});
                });
                $('#desk-card-' + (currentCardCounter).toString()).addClass('card-loaded');
                $('#desk-card-' + (currentCardCounter).toString()).data('card-number', num.toString());
            }

            if (currentCardCounter >= cardsNumbers.length) {
                $('#divination-again').show(500);
            }
        });

        $('.divination').on('click', '.card-loaded', function () {
            $('#show-desk').show(500);
            $('.hidden-card').hide(500);
            $('#hidden-card-' + $(this).data('card-number')).show(500);
        });
    });
})(jQuery);