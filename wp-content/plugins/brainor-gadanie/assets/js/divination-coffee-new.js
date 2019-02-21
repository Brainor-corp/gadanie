(function ($) {
    $(document).ready(function () {
        $('.divination-coffee-new').on('click', '.br-cf-step', function () {
            let coffeeCup = $(this);
            let divinationCfBlock = coffeeCup.closest('.divination-coffee-new');

            coffeeCup.hide(0, function () {
                coffeeCup.next().show();
            });

            divinationCfBlock.find('.br-cf-text span').text(coffeeCup.next().data('text'));
        });

        $('.divination-coffee-new').on('click', '.br-cf-step-last', function () {
            let coffeeCup = $(this);
            let divinationCfBlock = coffeeCup.closest('.divination-coffee-new');

            coffeeCup.hide();
            divinationCfBlock.find('.br-cf-items .br-cf-item').hide();

            let answersCount = divinationCfBlock.find('.br-cf-items .br-cf-item').length;
            $(divinationCfBlock.find('.br-cf-items .br-cf-item')[Math.floor(Math.random() * answersCount)]).show();
            divinationCfBlock.find('.br-cf-text span').text('Посмотрите результат гадания');

            divinationCfBlock.find('.br-cf-reload').show();
        });

        $('.divination-coffee-new').on('click', '.br-cf-reload', function () {
            let reloadButton = $(this);
            let divinationCfBlock = reloadButton.closest('.divination-coffee-new');

            reloadButton.hide();

            divinationCfBlock.find('.br-cf-items .br-cf-item').hide();

            divinationCfBlock.find('.br-cf-imgs img.br-cf-img').hide();
            $(divinationCfBlock.find('.br-cf-imgs img.br-cf-img')[0]).show();

            divinationCfBlock.find('.br-cf-text span').text('Выпейте кофе, нажав на чашку');
        });
    });
})(jQuery);