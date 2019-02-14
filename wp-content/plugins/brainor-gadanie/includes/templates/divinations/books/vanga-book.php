<script>
    if (!document.getElementById('divination-vanga-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-vanga-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-vanga.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-vanga-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-vanga.js';
        script.id = 'divination-vanga-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<div class="divination-vanga" id="<?php echo uniqid() ?>">
    <div class="br-mb-questions">

        <!-- Блок с ответами -->
        <div class="br-mb-question-row">

            <div class="br-mb-answers">

                <div class="br-mb-answer">
                    <div>
                        <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/vanga/van1.png" alt="">
                        <br>
                        <span>Он полюбил тебя с первого взгляда</span>
                    </div>
                </div>

                <div class="br-mb-answer">
                    <div>
                        <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/vanga/van1.png" alt="">
                        <br>
                        <span>Он полюбил тебя с первого взгляда 2</span>
                    </div>
                </div>

            </div>

            <div class="br-mb-cup">
                <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/vanga/cupq.gif" class="br-mb-cup-a" alt="">
            </div>
        </div>
        <!-- Конец блока с ответами -->

    </div>
</div>