<script>
    if (!document.getElementById('divination-solitaire-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-solitaire-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-solitaire.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-solitaire-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-solitaire.js';
        script.id = 'divination-solitaire-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<!--<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-solitaire-indian-solitaire.css">-->

<?php
global $wpdb;

$width = 5; /////////////////////////////// Ширина поля
$height = 5; ////////////////////////////// Высота поля

?>
<div class="row">
    <div class="col-12">
        <h2>Принципы и правила гадания</h2>
        Неизвестно кем был изобретен и когда впервые использован данный интересный пасьянс на нарисованных карточках.
        Большинство считает, что его изобретательницей была Жули Рекамье –
        известная в 19 веке хозяйка литературного и политического салона в Париже.
        Однако это и не важно. Пасьянс пережил несколько веков и, слегка изменившись и дополнившись новыми символами
        (такими как ноутбук, телефон, автомобиль и т.д.), дошел до наших дней, а интерес к нему не угас до сих пор.
        В отличие от русского варианта гадания «на карточках», представленного в другом разделе,
        во французской версии гадания участвует 25 карточек. Каждая из них поделена на четыре участка,
        на которых изображены половинки определенных символов.
        Для начала расклада следует тщательно перемешать и разложить карточки по 5 в ряд (получится 5 рядов).
        Затем следует посмотреть, совпадают ли половинки лежащих рядом карточек, и если да, то перевернуть их совпадающими
        символами друг к другу и записать результат.
    </div>
</div>

<div class="divination-solitaire rekamye-solitaire" id="<?php echo uniqid() ?>">
    <div style="text-align: center">
        <button class="reload">Разложить карты</button>
    </div>
    <div class="sol-table">
        <?php for ($i = 0; $i < $height; $i++): ?>
            <div class="sol-row">
                <?php for ($j = 0; $j < $width; $j++): ?>
                    <div class="sol-col">
                        <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/solitaire/bg.jpg" class="card-img"
                             data-rotate="0" alt="">
                        <a href="#" class="rotate-left"></a>
                        <a href="#" class="rotate-right"></a>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="elements">
        <?php for ($i = 0; $i < $width * $height; $i++): ?>
            <div class="element"
                 data-img="/wp-content/plugins/brainor-gadanie/assets/imgs/solitaire/rekamye/<?php echo $i + 1 ?>.jpg"></div>
        <?php endfor; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h2>Значение символов</h2>
    </div>
    <div class="col-12">
        <ul>
            <li>Аист - Весть о беременности. </li>
            <li>Аккордеон - Новое хобби. </li>
            <li>Амур со стрелой - Взаимная любовь. </li>
            <li>Веник - Держите сор в избе, иначе неприятностей не избежать.</li>
            <li>Весы - Впереди ситуация, в которой Вам будет сложно принять решение, как поступить дальше. </li>
            <li>Голубь - Благая весть. Деньги - Вас ожидает прибыль. </li>
            <li>Дерево - Вам нужно больше времени уделять собственным «корням». </li>
            <li>Дом - Смена места жительства. </li>
            <li>Замок и ключ - Тайна, которая скоро раскроется. </li>
            <li>Зеркало - Совсем скоро ситуация прояснится и всё предстанет в истинном свете. </li>
            <li>Зонтик - Сплетни, которые могут Вас опорочить. </li>
            <li>Кактус - Преодоление препятствий. </li>
            <li>Ключ - Вы найдёте решение, которое столь долго ищите. </li>
            <li>Книга - Получение новых знаний. </li>
            <li>Коктейльный фужер - Не теряйте головы, особенно когда Вас пригласят выпить в компании. </li>
            <li>Кольца - Вы получите предложение. Корзина - Впереди неожиданные траты.</li>
            <li>Коробка конфет - Приятная встреча.</li>
            <li>Корона - Наивысшее достижение, признание заслуг по достоинству.</li>
            <li>Крыса - Враг, прикидывающийся другом.</li>
            <li>Курица в гнезде - Общение в кругу семьи.</li>
            <li>Лебедь - Верность.</li>
            <li>Луна - Запутанная ситуация, ответа на которую пока нет.</li>
            <li>Машина - Путешествие.</li>
            <li>Нож - Опасность.</li>
            <li>Ножницы - Вы закончите с тем, что так долго Вас тяготит.</li>
            <li>Ноутбук - Впереди дела в «казённом» доме.</li>
            <li>Парусник - Романтическое приключение.</li>
            <li>Перчатки - Оскорбление.</li>
            <li>Письмо - Решение «бумажных» дел.</li>
            <li>Планета Земля - Глобальное предложение, которое может изменить всю Вашу жизнь.</li>
            <li>Помидор - Впереди ситуация, в которой Вам будет стыдно за себя.</li>
            <li>Посуда - Ждите гостей. Ребенок - С Вами произойдёт настояшее чудо.</li>
            <li>Роза - Роза всегда с шипами.</li>
            <li>Нужно немного потерпеть и всё наладится.</li>
            <li>Свечи - Скоро всё негативное пройдёт.</li>
            <li>Свинья - Будьте внимательны, что-то недоброе затевается за Вашей спиной.</li>
            <li>Солнце - Расцвет жизни, наступление светлой во всех смыслах полосы.</li>
            <li>Сорока - Подружки, с которыми Вы прекрасно проведёте время.</li>
            <li>Стрела в сердце - Ваше чувство не взаимно.</li>
            <li>Тапки - Из-за недуга Вам придётся некоторое время посидеть дома.</li>
            <li>Телефон - Вести издалека.</li>
            <li>Торт - Пора подумать о фигуре. </li>
            <li>Фиалки в корзине - Подарок, неожиданный сюрприз, комплимент.</li>
            <li>Цветок - Искренность.</li>
            <li>Чай - Пришла пора подумать о себе.</li>
            <li>Чемодан - Вам не кажется, что давно пора в отпуск?</li>
            <li>Вам нужно сменить картинку, Ваши нервы на пределе возможностей.</li>
            <li>Шампанское - Эмоции Вам ударят в голову.</li>
            <li>Ягоды - Вас ждёт наслаждение.</li>
        </ul>
    </div>
</div>