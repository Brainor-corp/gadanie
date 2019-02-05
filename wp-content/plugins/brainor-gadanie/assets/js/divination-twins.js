(function ($) {
   $(document).ready(function () {
       $('.divination-twins').on('click', '.br-divination-btn', function () {
           let button = $(this);

           let colors = ['black', 'blue', 'green', 'red', 'white', 'yellow'];

           let leftBrother;
           let rightBrother;

           for(let i = 0; i < 5; i++)
           {
               leftBrother = colors[Math.floor(Math.random() * 6)];
               rightBrother = colors[Math.floor(Math.random() * 6)];

               $(button.closest('.twins-control').find('img')[0]).attr("src", "/wp-content/plugins/brainor-gadanie/assets/imgs/twins/" + leftBrother + ".jpg");
               $(button.closest('.twins-control').find('img')[1]).attr("src", "/wp-content/plugins/brainor-gadanie/assets/imgs/twins/" + rightBrother + ".jpg");
           }

           console.log(leftBrother);
           console.log(rightBrother);
       })
   });
})(jQuery);