(function ($) {
    $(document).ready(function () {
        $('.divination-rune').on('click', '.drop-runes-button', function () {

            console.log('click');

            let runesButton = $(this);
            let divinationRnBlock = runesButton.closest('.divination-rune');

            divinationRnBlock.find('.br-rn-item').hide(300);

            let answersCount = divinationRnBlock.find('.br-rn-item').length;
            $(divinationRnBlock.find('.br-rn-item')[Math.floor(Math.random() * answersCount)]).show(700);
        });
    });
})(jQuery);