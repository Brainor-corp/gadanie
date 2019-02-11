<script>
    if (!document.getElementById('divination-rotate-ball-of-destiny-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-rotate-ball-of-destiny-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-rotate-ball-of-destiny.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-rotate-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-rotate.js';
        script.id = 'divination-rotate-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<script type="text/javascript" src="/wp-content/plugins/brainor-gadanie/assets/js/divination-rotate-destiny.js"></script>

<div class="divination-rotate ball-of-destiny" id="<?php echo uniqid() ?>" data-step="36" data-items="10">
    <div class="br-rotate-block">
        <div class="crc"></div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Пора в отпуск</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Доверяй, <br> но проверяй</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Действуй и <br> всё получится</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Успех во всех <br> начинаниях</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Будь осторожен</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Ждите важного <br> сообщения</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Больше <br> решимости</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Испытание, <br> трудный этап</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Решение важных <br> вопросов</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Смени курс</div>
        </div>
        <div class="br-rotate-pointer" data-current-rotate="0">
            <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/rotate/arrow-destiny.png" alt="">
        </div>
        <div class="br-rotate-name">
            <h3>На карьеру</h3>
        </div>
    </div>
    <div class="br-rotate-block">
        <div class="crc"></div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Случайная <br> встреча</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Хорошие <br> новости</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Романтический <br> сюрприз</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Прислушивайся к <br> своему сердцу</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Продолжай в <br> том же духе</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Больше <br> решимости</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Расскажи о своих <br> чувствах</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Неожиданный <br> звонок</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Не торопи <br> события</div>
        </div>
        <div class="br-rt-arc">
            <div class="br-rt-answer">Поддержи свою <br> вторую половину</div>
        </div>
        <div class="br-rotate-pointer" data-current-rotate="0">
            <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/rotate/arrow-destiny.png" alt="">
        </div>
        <div class="br-rotate-name">
            <h3>На любовь</h3>
        </div>
    </div>
</div>