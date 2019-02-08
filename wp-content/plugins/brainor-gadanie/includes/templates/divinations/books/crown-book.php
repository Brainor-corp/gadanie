<script>
    if (!document.getElementById('divination-magic-book-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-magic-book-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-magic-book.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-magic-book-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-magic-book.js';
        script.id = 'divination-magic-book-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-magic-book-crown.css">

<div class="divination-magic-book crown-book" id="<?php echo uniqid() ?>">
    <div class="br-mb-questions">

        <!-- Блок вопроса с ответами -->
        <div class="br-mb-question-row">
            <div class="br-mb-question">
                <span>Представьте Вашего возлюбленного, подумайте о нём несколько секунд и нажмите на Корону любви..</span>
                <br>
                <img src="/wp-content/plugins/brainor-gadanie/includes/templates/divinations/books/korona.png" alt="">
            </div>
            <div class="br-mb-answers">

                <div class="br-mb-answer">
                    <span>Он Вас любит</span>
                </div>

                <div class="br-mb-answer">
                    <span>Он Вас не любит</span>
                </div>

                <div class="br-mb-answer">
                    <span>Да кто его знает</span>
                </div>

            </div>
        </div>
        <!-- Конец блока вопроса с ответами -->

    </div>
</div>