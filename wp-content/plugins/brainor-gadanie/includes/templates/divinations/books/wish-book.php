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

<div class="divination-magic-book wish-book" id="<?php echo uniqid() ?>">
    <h1>Книга желаний</h1>
    <div class="br-mb-questions">

        <!-- Блок вопроса с ответами -->
        <div class="br-mb-question-row">
            <div class="br-mb-question">
                <span>Загадайте желание и кликните..</span>
            </div>
            <div class="br-mb-answers">

                <div class="br-mb-answer">
                    <span>Всё будет, но не сразу</span>
                </div>

                <div class="br-mb-answer">
                    <span>В сутках 24 часа</span>
                </div>

                <div class="br-mb-answer">
                    <span>Ещё ответ</span>
                </div>

                <div class="br-mb-answer">
                    <span>Другой ответ</span>
                </div>

            </div>
        </div>
        <!-- Конец блока вопроса с ответами -->

    </div>
</div>