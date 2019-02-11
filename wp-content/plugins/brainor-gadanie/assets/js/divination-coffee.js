(function ($) {
    $(document).ready(function () {
        $('.divination-coffee').on('click', '.br-cf-cup', function () {
            let places = [
                'В середине чашки:',
                'На дне чашки:',
                'Сверху у ободка чашки:'
            ];


            let coffeeCup = $(this);
            let divinationCfBlock = coffeeCup.closest('.divination-coffee');

            divinationCfBlock.find('.br-cf-answers').hide(300, function () {
                let answersCount = divinationCfBlock.find('.br-cf-items .br-cf-item').length;

                let firstAnswer = {
                    "place": places[Math.floor(Math.random() * places.length)],
                    "html": $(divinationCfBlock.find('.br-cf-items .br-cf-item')[Math.floor(Math.random() * answersCount)]).html()
                };

                let secondAnswer = {
                    "place": places[Math.floor(Math.random() * places.length)],
                    "html": $(divinationCfBlock.find('.br-cf-items .br-cf-item')[Math.floor(Math.random() * answersCount)]).html()
                };

                $(divinationCfBlock.find('.br-cf-answer-top.br-cf-answer')).html(
                    '<h3>' + firstAnswer.place + '</h3>' + firstAnswer.html
                );

                $(divinationCfBlock.find('.br-cf-answer-bottom.br-cf-answer')).html(
                    '<h3>' + secondAnswer.place + '</h3>' + secondAnswer.html
                );

                $(divinationCfBlock.find('.br-cf-answers')).show(700);
            });
        });
    });
})(jQuery);