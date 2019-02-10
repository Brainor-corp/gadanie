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
                <span>Загадайте желание и кликните...</span>
            </div>
            <div class="br-mb-answers">

                <div class="br-mb-answer">
                    <span>...Нет, но это будет к лучшему</span>
                </div>

                <div class="br-mb-answer">
                    <span>...До того времени многое еще должно измениться</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Со временем</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Если ты не желаешь невозможного</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Возложи всю надежду свою на и изменчивость человеческого сердца, этот расчет верен и не обманет тебя.</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Старайся их не высказывать, действуй политичнее, тогда без труда получишь то что желаешь</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Это непременно случится</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Откажись от всякой недежды</span>
                </div>

                <div class="br-mb-answer">
                    <span>...Если успеешь шепнуть его падающей звездочке</span>
                </div>

                <div class="br-mb-answer">
                    <span>...То, чего ты желаешь, ничтожно в сравнении с тем, что ты получишь</span>
                </div>

            </div>
        </div>
        <!-- Конец блока вопроса с ответами -->

    </div>
</div>