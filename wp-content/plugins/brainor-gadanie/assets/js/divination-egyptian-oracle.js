(function ($) {
    $(document).ready(function () {
        $(".br-eg-tile .back").css( "display", "block");
        $(".br-eg-tile").flip({
            trigger: 'manual'
        });

        function showAnswers(divinationBlock, numStrength, numWeakness, numOutcome) {
            divinationBlock.find('.br-eg-answers .br-eg-answer-strength .br-eg-answer-' + numStrength).show();
            divinationBlock.find('.br-eg-answers .br-eg-answer-weakness .br-eg-answer-' + numWeakness).show();
            divinationBlock.find('.br-eg-answers .br-eg-answer-outcome .br-eg-answer-' + numOutcome).show();

            divinationBlock.find('.br-eg-answers').show('slow');
        }

        function shuffle(a) {
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }

        $('.divination-egyptian-oracle').on('click', '.br-eg-tile', function () {
            let card = $(this);
            let divinationBlock = card.closest('.divination-egyptian-oracle');

            if(divinationBlock.data('time') < 3 && !card.data("flip-model").isFlipped) {
                card.flip(true);

                switch (divinationBlock.data('time')) {
                    case 0: divinationBlock.data('strength', card.find('.br-eg-number').data('num')); break;
                    case 1: divinationBlock.data('weakness', card.find('.br-eg-number').data('num')); break;
                    case 2: divinationBlock.data('outcome', card.find('.br-eg-number').data('num'));
                        showAnswers(
                            divinationBlock,
                            divinationBlock.data('strength'),
                            divinationBlock.data('weakness'),
                            divinationBlock.data('outcome')
                        );
                        break;
                }

                divinationBlock.data('time', divinationBlock.data('time') + 1);
            }
        });

        $('.divination-egyptian-oracle').on('click', '.br-eg-restart', function () {
            let restartButton = $(this);
            let divinationBlock = restartButton.closest('.divination-egyptian-oracle');

            $("#" + divinationBlock.attr('id') +" .br-eg-tile").flip(false, function () {
                divinationBlock.data('strength', '');
                divinationBlock.data('weakness', '');
                divinationBlock.data('outcome', '');
                divinationBlock.data('time', 0);

                divinationBlock.find('.br-eg-answers').hide('slow');
                divinationBlock.find('.br-eg-answers .br-eg-answer').hide();

                let numbers = [];

                for(let i = 1; i <= 21; i++) {
                    numbers.push(i);
                }
                numbers = shuffle(numbers);

                divinationBlock.find('.br-eg-number').each(function () {
                    let num = numbers.pop();
                    $(this).data('num', num);
                    $(this).html(num);
                });
            });
        });
    });
})(jQuery);