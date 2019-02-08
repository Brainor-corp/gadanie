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
    <div class="twins-elements">
        <div class="twins-element twins-none">
            <strong>Значение: </strong>
            <p>Братья не сошлись во мнении.</p>
        </div>
        <div class="twins-element twins-black">
            <strong>Черные. Значение: </strong>
            <p>
                Оракул говорит: "Плохое предзнаменование! Ничего хорошего вам не светит.
                Впереди у вас – стечение враждебных, неблагоприятных обстоятельств, неприятные эмоции.
                Бесполезный жизненный опыт, которого лучше избежать. Вы заблуждаетесь, рассчитывая что-то выиграть.
                Что бы вы ни предпринимали, положительный результат маловероятен.
                Лучше всего вообще отказаться от действий – в конце концов, это может быть просто опасно".
            </p>
            <p>
                Ключевые слова: УГРОЗА, СЛОЖНАЯ СИТУАЦИЯ, ОШИБКИ, ПОТЕРИ, НЕТ ВЫХОДА
            </p>
            <p>
                И здесь вам суждено: ТРЕВОГА, ЗЛОСТЬ, СОЖАЛЕНИЕ
            </p>
        </div>
        <div class="twins-element twins-white">
            <strong>Белые. Значение: </strong>
            <p>
                Оракул говорит: "Все правильно! Даже если вы сомневаетесь, в событиях есть логика и здравый смысл.
                Скоро с неопределенностью будет покончено, и вы ясно увидите, что к чему.
                Новые отношения будут чистыми, все поступки будут разумны.
                Вам станет гораздо легче, чем теперь. Вы на правильном пути!
                Ничего плохого не произойдет, переживания напрасны, можно расслабиться.
                Все получится немного скучно, но зато безопасно".
            </p>
            <p>
                Ключевые слова: ЧИСТОТА, ЗДРАВЫЙ СМЫСЛ, ПРАВИЛЬНОСТЬ, НОРМА, БЕЗОПАСНОСТЬ
            </p>
            <p>
                И здесь вам суждено: УДОВЛЕТВОРЕНИЕ, СПОКОЙСТВИЕ, ОПТИМИЗМ
            </p>
        </div>
        <div class="twins-element twins-yellow">
            <strong>Желтые. Значение: </strong>
            <p>
                Оракул говорит: "Вас ждут приятные сюрпризы! Дела пойдут в гору.
                То, о чем вы спрашиваете, послужит причиной значительного улучшения материального положения.
                Или деньги, или новые выгодные знакомства.
                Возможность неожиданной карьеры, целая серия приятных сюрпризов и удовольствий.
                Или даже все вместе и сразу! Ваша жизнь готова улучшиться.
                Судьба готова "подвинуться" в сторону успеха и процветания. Не упускайте свой шанс – он очень хорош!"
            </p>
            <p>
                Ключевые слова: МАТЕРИАЛЬНЫЙ УСПЕХ, ВЫГОДА, НОВАЯ ЭНЕРГИЯ, БЫСТРОТА, НЕОСТОРОЖНОСТЬ
            </p>
            <p>
                И здесь вам суждено: РАДОСТЬ, АЗАРТ, САМОУВЕРЕННОСТЬ
            </p>
        </div>
        <div class="twins-element twins-red">
            <strong>Красные. Значение: </strong>
            <p>
                Оракул говорит: "Надвигается что-то необыкновенное! Большие эмоциональные потрясения...
                Самые невероятные события будут развиваться стремительно и бесконтрольно.
                Вы будете ошеломлены, повышается риск фатального безрассудства.
                Вы поведете себя непредсказуемо, повинуясь вдохновению и внутренним импульсам.
                В вашей жизни произойдут важные перемены. Вас испугают новые события, но одновременно это вам понравится".
            </p>
            <p>
                Ключевые слова: АКТИВНОСТЬ, НЕУПРАВЛЯЕМОСТЬ, РОКОВОЕ СТЕЧЕНИЕ ОБСТОЯТЕЛЬСТВ, РАЗРУШЕНИЕ СТАРОГО, ЯРКОСТЬ
            </p>
            <p>
                И здесь вам суждено: ВОЗБУЖДЕНИЕ, ИСПУГ, НАСЛАЖДЕНИЕ
            </p>
        </div>
        <div class="twins-element twins-blue">
            <strong>Синие. Значение: </strong>
            <p>
                Оракул говорит: "Скоро все успокоится! Сколько сегодня в этом лишнего, ненужного, наносного!
                В ближайшее время все лишнее исчезнет само собой. Вы почувствуете себя увереннее.
                Отношения станут глубже и окрепнут. Многое прояснится, лишние переживания исчезнут.
                Возможно, вы станете зависимее, чем сейчас, зато важное станет устойчивым.
                Установятся новые связи и новый, устойчивый порядок вещей.
                Время замков на песке проходит – скоро вы почувствуете под собой надежный фундамент".
            </p>
            <p>
                Ключевые слова: ОХЛАЖДЕНИЕ, ГЛУБИНА, ПАССИВНОСТЬ, ГАРМОНИЯ, ОБРЕТЕНИЕ УСТОЙЧИВОСТИ
            </p>
            <p>
                И здесь вам суждено: СПОКОЙСТВИЕ, РАССЛАБЛЕНИЕ, СВЯЗАННОСТЬ
            </p>
        </div>
        <div class="twins-element twins-green">
            <strong>Зеленые. Значение: </strong>
            <p>
                Оракул говорит: "Надейтесь! У вас есть шансы, хотя и небольшие.
                Вы можете добиться прогресса и сделать по-своему, если постараетесь.
                Будьте внимательны к сегодняшнему дню: пока что все слишком шатко и ненадежно, велико влияние хаоса.
                От вас потребуется решительность и упорство. Ситуация нестабильна и требует от вас немедленных активных действий.
                Будущую победу, будущую радость нужно вырастить и защитить".
            </p>
            <p>
                Ключевые слова: РОСТ, НАДЕЖДА, НЕУВЕРЕННОСТЬ, НЕЗАЩИЩЕННОСТЬ, ОЖИДАНИЕ
            </p>
            <p>
                И здесь вам суждено: ОГРАНИЧЕННОСТЬ, НЕУВЕРЕННОСТЬ, СТРЕМЛЕНИЕ СДЕЛАТЬ ЛУЧШЕ
            </p>
        </div>
    </div>
</div>