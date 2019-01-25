// Перемешивание значений массива
function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}


// Перезагрузка гадания
function reloadSolitaire($, divinationIdStr) {
    let elements = [];
    $('#' + divinationIdStr + '.divination-solitaire .elements .element').each(function( ) {
        elements.push($(this).data('img'));
    });

    elements = shuffle(elements);

    $('#' + divinationIdStr + '.divination-solitaire .card-img').each(function( ) {
        let image = $(this);

        image.fadeOut('slow', function () {
            image.attr('src', elements.pop());
            image.fadeIn('slow', function () {
                let angle = image.data('rotate') - 90 * Math.floor(Math.random() * 3 + 1);
                image.animateRotate(image.data('rotate'), angle, 500, 'linear', image.data('rotate', angle));
            });
        });

        image.closest('.sol-col').addClass('loaded');
    });
}

(function ($) {
    // Поворот изображения
    $.fn.animateRotate = function(startAngle, endAngle, duration, easing, complete){
        return this.each(function(){
            var elem = $(this);

            $({deg: startAngle}).animate({deg: endAngle}, {
                duration: duration,
                easing: easing,
                step: function(now){
                    elem.css({
                        '-moz-transform':'rotate('+now+'deg)',
                        '-webkit-transform':'rotate('+now+'deg)',
                        '-o-transform':'rotate('+now+'deg)',
                        '-ms-transform':'rotate('+now+'deg)',
                        'transform':'rotate('+now+'deg)'
                    });
                },
                complete: complete || $.noop
            });
        });
    };

    $(document).ready(function () {
        $('.divination-solitaire').on('click', '.reload', function () {
            reloadSolitaire($, $(this).closest('.divination-solitaire').attr('id'));
        });

        // Клик по кнопке поворота против часовой стрелки
        $('.divination-solitaire').on('click', '.rotate-left', function (e) {
            e.preventDefault();
            let img = $(this).siblings('img');
            let angle = img.data('rotate') - 90;
            img.animateRotate(img.data('rotate'), angle, 500, 'linear', img.data('rotate', angle));
        });

        // Клик по кнопке поворота против по часовой стрелке
        $('.divination-solitaire').on('click', '.rotate-right', function (e) {
            e.preventDefault();
            let img = $(this).siblings('img');
            let angle = img.data('rotate') + 90;
            img.animateRotate(img.data('rotate'), angle, 500, 'linear', img.data('rotate', angle));
        });
    });
})(jQuery);