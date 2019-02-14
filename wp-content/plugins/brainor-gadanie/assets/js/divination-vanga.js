(function ($) {
    $(document).ready(function () {

        $('.divination-vanga').on('click', '.br-mb-question-row', function () {
            let questionRow = $(this);
            if(!questionRow.hasClass('showing')) {
                questionRow.addClass('showing');
                questionRow.find('.br-mb-answer').fadeOut(300);

                questionRow.find('.br-mb-cup .br-mb-cup-a').fadeIn(1500, function () {
                    let waterAnimate = $(this);
                    let answersCount = questionRow.find('.br-mb-answer').length;
                    $(questionRow.find('.br-mb-answer')[Math.floor(Math.random() * answersCount)]).delay(3000).fadeIn(700, function () {
                        waterAnimate.fadeOut(1500);
                        questionRow.removeClass('showing');
                    });
                });
            }
        });

    });
})(jQuery);