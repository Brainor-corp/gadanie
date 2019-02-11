(function ($) {
    $(document).ready(function () {
        $('.divination-magic-book:not(.vanga-book)').on('click', '.br-mb-question-row', function () {
            let questionRow = $(this);
            if(!questionRow.hasClass('showing')) {
                questionRow.addClass('showing');
                questionRow.find('.br-mb-answer').hide(300);

                let answersCount = questionRow.find('.br-mb-answer').length;
                $(questionRow.find('.br-mb-answer')[Math.floor(Math.random() * answersCount)]).show(500, function () {
                    questionRow.removeClass('showing');
                });
            }
        });

        $('.divination-magic-book.vanga-book').on('click', '.br-mb-question-row', function () {
            let questionRow = $(this);
            if(!questionRow.hasClass('showing')) {
                questionRow.addClass('showing');
                questionRow.find('.br-mb-answer').fadeOut(300);

                let answersCount = questionRow.find('.br-mb-answer').length;
                $(questionRow.find('.br-mb-answer')[Math.floor(Math.random() * answersCount)]).fadeIn(700, function () {
                    questionRow.removeClass('showing');
                });
            }
        });
    });
})(jQuery);