(function ($) {
    $(document).ready(function () {
        // Поворот изображения
        $.fn.animateRotatePointer = function(startAngle, endAngle, duration, easing, complete){
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
        
        $('.divination-rotate').on('click', '.br-rotate-pointer', function () {
            let pointer = $(this);
            let divinationBlock = pointer.closest('.divination-rotate');
            let roundCount = Math.floor(Math.random() * 5) + 3;

            console.log(roundCount);

            function round() {
                if(roundCount) {
                    roundCount--;
                    pointer.animateRotatePointer(pointer.data('current-rotate'), pointer.data('current-rotate') + 360, 1000, 'linear', round);
                } else {
                    let steps = Math.floor(Math.random() * 10) + 1;
                    let time = steps * 100;
                    let angle = pointer.data('current-rotate') + divinationBlock.data('step') * steps;
                    console.log(angle);
                    pointer.animateRotatePointer(pointer.data('current-rotate'), angle, time, 'linear', function () {
                        if(angle > 360) {
                            angle = Math.abs(360 - angle);
                        }
                        pointer.data('current-rotate', angle);
                    });
                }
            }

            round();
        });
    });
})(jQuery);