(function ($) {
   $(document).ready(function () {
       function reload(button) {
           button.data('need-reload', 0);
           button.data('count', 6);
           $(button.closest('.divination-twins').find('.twins-element').hide(500));
           $(button.closest('.twins-control').find('.twins-count').text(button.data('count')));
           button.text('Гадать');
       }

       $('.divination-twins').on('click', '.br-divination-btn', function () {
           let button = $(this);

           if(button.data('need-reload')) {
               reload(button)
           }

           let colors = ['black', 'blue', 'green', 'red', 'white', 'yellow'];

           let leftBrother;
           let rightBrother;

           button.attr('disabled', true);

           let i = 0;
           let result;
           function animateDivination(colors, button) {
               let leftBrother;
               let rightBrother;

               for(let j = 0; j < 5; j++)
               {
                   leftBrother = colors[Math.floor(Math.random() * 6)];
                   rightBrother = colors[Math.floor(Math.random() * 6)];

                   $(button.closest('.twins-control').find('img')[0]).attr("src", "/wp-content/plugins/brainor-gadanie/assets/imgs/twins/" + leftBrother + ".jpg");
                   $(button.closest('.twins-control').find('img')[1]).attr("src", "/wp-content/plugins/brainor-gadanie/assets/imgs/twins/" + rightBrother + ".jpg");
               }

               return [leftBrother, rightBrother];
           }

           function loop() {
               setTimeout(function () {
                   i++;
                   if (i < 5) {
                       loop();
                       result = animateDivination(colors, button);
                   } else {
                       leftBrother = result[0];
                       rightBrother = result[1];

                       button.data('count', button.data('count') - 1);
                       $(button.closest('.twins-control').find('.twins-count').text(button.data('count')));

                       if(button.data('count') <= 0 || leftBrother === rightBrother) {
                           button.data('need-reload', 1);
                           button.text('Гадать заново');

                           if(leftBrother === rightBrother) {
                               $(button.closest('.divination-twins').find('.twins-element').hide(500));
                               $(button.closest('.divination-twins').find('.twins-' + leftBrother).show(500));
                           } else {
                               $(button.closest('.divination-twins').find('.twins-element').hide(500));
                               $(button.closest('.divination-twins').find('.twins-none').show(500));
                           }
                       }

                       button.attr('disabled', false);
                   }
               }, 200);
           }

           loop();
       })
   });
})(jQuery);