<script>
    if (!document.getElementById('divination-twins-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-twins-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-twins.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-twins-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-twins.js';
        script.id = 'divination-twins-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<?php
    $colors = ['black', 'blue', 'green', 'red', 'white', 'yellow'];

    $leftBrother = $colors[rand(0, 5)];
    $rightBrother = $colors[rand(0, 5)];
?>

<div class="divination-twins" id="<?php echo uniqid() ?>">
    <div class="twins-control">
        <div class="twins-images">
            <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/twins/<?php echo $leftBrother?>.jpg" alt="">
            <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/twins/<?php echo $rightBrother?>.jpg" alt="">
        </div>
        <div class="twins-counter">
            <span>Осталось попыток: <strong class="twins-count">6</strong></span>
        </div>
        <div>
            <button class="br-divination-btn" data-count="6">Гадать</button>
        </div>
    </div>
    <div class="twins-description">
        <p>
            Пермский оракул, онлайн гадание Двойняшки — это очень известное и популярное гадание для ответа на интересующий вопрос.
            Раньше это гадание проводили с помощью двух одинаковых кубиков,
            а в современном онлайн варианте вместо кубиков используются изображения древних идолов.
            Перед началом гадания нужно задать вопрос, а затем бросить кубики на гладкую поверхность.
        </p>
        <p>
            Если на кубиках сразу выпадают грани одинакового цвета, это говорит о максимальной правдивости предсказания.
            Если цвет граней не совпадает, значит мнения Двойняшек не сходятся, и у вас остается еще пять попыток.
        </p>
    </div>
</div>