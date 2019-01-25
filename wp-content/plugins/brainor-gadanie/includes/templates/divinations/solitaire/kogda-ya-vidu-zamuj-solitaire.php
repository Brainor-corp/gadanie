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
$height = 4; ////////////////////////////// Высота поля

$divinationTable = $wpdb->get_blog_prefix() . 'br_divinations';
$divinationElementsTable = $wpdb->get_blog_prefix() . 'br_divination_elements';
$divinationPivotTable = $wpdb->get_blog_prefix() . 'br_divination_elements_pivot';

$slug = 'personal-card-of-the-year';
$wpdb->query('SET SESSION group_concat_max_len = 100000000000000000;');
$sql = '
    SELECT 
        D.id,
        D.name,
        D.slug,
        D.description,
        D.thumb,
        D.created_at,
        group_concat(
"<|>id","<:>",IFNULL(DE.id, "NULL"),"<->",
"name","<:>",IFNULL(DE.name, "NULL"),"<->",
"slug","<:>",IFNULL(DE.slug, "NULL"),"<->",
"class","<:>",IFNULL(DE.class, "NULL"),"<->",
"description","<:>",IFNULL(DE.description, "NULL"),"<->",
"thumb","<:>",IFNULL(DE.thumb, "NULL"),"<->",
"created_at","<:>",IFNULL(DE.created_at, "NULL"),"<->",
"pivot_thumb","<:>",IFNULL(DP.thumb, "NULL"),"<->",
"pivot_description","<:>",IFNULL(DP.description, NULL),"<->"
) as elements 
    from ' . $divinationTable . ' D
    LEFT JOIN ' . $divinationPivotTable . ' DP on DP.divination_id = D.id
    LEFT JOIN ' . $divinationElementsTable . ' DE on DP.divination_element_id = DE.id
    WHERE D.slug = \'' . $slug . '\'
    ORDER BY D.id ASC';
$divination = $wpdb->get_row($sql, ARRAY_A);

$resultArr = [];
$elements = explode('<|>', $divination['elements']);
foreach ($elements as $elKey => $element) {
    if (strlen($element) > 0) {
        $rows = explode('<->', $element);
        foreach ($rows as $rowKey => $row) {
            if (strlen($row) > 0) {
                $keyValues = explode('<:>', $row);
                $resultArr[$elKey][$keyValues[0]] = $keyValues[1];
            }
        }
    }

}
$divination['elements'] = $resultArr;
?>
<div class="row">
    <div class="col-12">
        Тема замужества всегда остается на пике популярности, поэтому такой пасьянс востребован во все времена. Пасьянс
        гадание «Когда я выйду замуж» онлайн — подскажет девушке, в каком направлении ей развиваться, чтобы это
        долгожданное событие произошло как можно раньше, как себя вести с мужчинами, как им понравиться, как стать
        любимой и желанной, и многое другое.
    </div>
    <div class="col-12">
        <h2>Принципы и правила гадания</h2>
        <p>
            Пасьянс гадание «Когда я выйду замуж» имеет в своей колоде карты с различными элементами атрибутики,
            связанной с любовными отношениями, романтикой, семейным бытом и конечно же со свадьбой. Раскладывая карты
            пасьянса, можно обнаружить, что таким образом возникают определенные цельные картинки,
            которые гадающая девушка может умело использовать в построении любовных отношений.
        </p>
    </div>
</div>

<div class="divination-solitaire indian-solitaire" id="<?php echo uniqid() ?>">
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
                 data-img="/wp-content/plugins/brainor-gadanie/assets/imgs/solitaire/kogda-ya-vidu-zamuj/<?php echo $i + 1 ?>.jpg"></div>
        <?php endfor; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h2>Значение символов</h2>
        <p>толкование всех карточек пасьянса:</p>
    </div>
    <div class="col-12">
        <ol>
            <li><strong>Алмазы</strong> – довольствуйся малым, судьба и так к тебе слишком благосклонна. Желая большего, рискуешь получить обратный эффект.</li>
            <li><strong>Амур</strong> – все в твоих руках, но нужно проявить больше настойчивости, иначе молодой человек охладеет к тебе навсегда.</li>
            <li><strong>Букет невесты</strong> — никому не рассказывай о своих планах на замужество, тогда оно случится раньше, чем ты мечтаешь.</li>
            <li><strong>Губки</strong> – осчастливь избранника незабываемым поцелуем, тогда он на век будет твоим, и не посмотрит больше ни на одну.</li>
            <li><strong>Губная помада</strong> – сейчас тебя никто не замечает. Измени ситуацию — займись своим внешним видом, стань эффектнее, и затми своей красотой всех.</li>
            <li><strong>Два голубя</strong> – чтобы чудесные моменты с твоим избранником не канули в прошлое, нужно срочно сделать совместное фото на память.</li>
            <li><strong>Два зайца</strong> – пришло время для того, чтобы сделать окончательный выбор. За двумя женихами погонишься, ни с чем останешься.</li>
            <li><strong>Два кольца</strong> – все сложилось. Ты все делаешь правильно, поэтому не останавливайся на полпути. Скоро свадьба.</li>
            <li><strong>Духи</strong> – ты сможешь удержать своего избранника возле себя просто тем, что будешь пользоваться ароматом, который нравится ему.</li>
            <li><strong>Жених</strong> – мужчинам тоже нужно внимание поэтому не забывай хвалить его и восхищаться им.</li>
            <li><strong>Зеркало</strong> – стоит приглядеться к своему избраннику, возможно он не тот, за кого себя выдает.</li>
            <li><strong>Ключ</strong> – твой избранник держит свои чувства под замком, попытайся найти ключик к его нежному сердечку и тогда он твой.</li>
            <li><strong>Книга</strong> – займись чтением умных книжек, твой избранник любит начитанных и умных девушек. Не бойся его удивить.</li>
            <li><strong>Мяч</strong> – у твоего избранника есть хобби, узнай, какое, и прояви к нему неподдельный интерес.</li>
            <li><strong>Невеста</strong> – ты в двух шагах от замужества, поэтому не нужно тянуть со свадьбой. Твой избранник тоже хочет этого.</li>
            <li><strong>Остров</strong> – работа работой, а отдыхать тоже нужно. Проведите отдых вместе, желательно вдали от всех.</li>
            <li><strong>Открытая дверь</strong> – будешь сидеть дома, жениха не высидишь. Пойди погуляй, сейчас самое время.</li>
            <li><strong>Пиалы</strong> – твои усилия тщетны. Оставь напрасные ожидания, поменяй приоритеты.</li>
            <li><strong>Письмо</strong> – твой любимый ждет от тебя весточки. Не забудь написать ему страстное письмо.</li>
            <li><strong>Платье</strong> – пора преобразиться и сменить свой гардероб. Твой уже давно не в моде.</li>
            <li><strong>Подарки</strong> – удивляйся и восхищайся даже самому маленькому и незначительному подарку, как ребенок. Он будет польщен.</li>
            <li><strong>Подруга</strong> – лучшая подруга мешает твоему счастью, с ней нужно как можно быстрее расстаться. Не сожалей об этом.</li>
            <li><strong>Радио</strong> — учись делать дела молча. Кто много говорит, тот ничего не стоит.</li>
            <li><strong>Ромашка</strong> — пришло время получше узнать своего избранника. Не теряйся, бери ситуацию в свои руки.</li>
            <li><strong>Свеча</strong> – создай в своем доме комфортную и расслабленную обстановку, чтобы его тянуло туда прийти.</li>
            <li><strong>Сердечко</strong> – не можешь сделать правильный выбор, тогда послушай свое сердечко, оно не обманет.</li>
            <li><strong>Скала</strong> – сейчас, как никогда ты должна быть твердой и решительной в любой ситуации.</li>
            <li><strong>Слеза</strong> – наступила время показать свою слабость. Дай ему возможность позаботиться о тебе.</li>
            <li><strong>Снежинка</strong> — не отталкивай его от себя, он боится твоего холодного взгляда и неприступности. Отступи от своих правил.</li>
            <li><strong>Стол на двоих</strong> – накрой стол и пригласи его на романтический ужин на двоих.</li>
            <li><strong>Телевизор</strong> – держи ситуацию под контролем. Ты ничего не должна упустить. Любая информация сейчас для тебя важна, как никогда</li>
            <li><strong>Телефон</strong> – он хочет услышать твой голос и ждет твоего звонка. Позвони первой.</li>
            <li><strong>Торт</strong> – не забывай следить за своей фигурой, иначе рискуешь остаться одна.</li>
            <li><strong>Фен</strong> – пришло время сменить прическу и даже поменять цвет волос. Новая прическа придется тебе к лицу.</li>
            <li><strong>Цыпленок</strong> – притворись маленькой и беззащитной! дай мужчине показать себя сильными заботливым!</li>
            <li><strong>Чайник</strong> – не руби сгоряча. Успокойся и тогда примешь верное решение.</li>
            <li><strong>Часы</strong> – наберись терпения. Все придет в свое время, нужно еще немного подождать.</li>
            <li><strong>Чемодан</strong> – собирайся в дорогу! Тебе предстоит отпуск, командировка, выезд за город.</li>
            <li><strong>Разбитая тарелка</strong> —&nbsp; ситуация вышла из-под контроля, ты не справляешься сама. Любимый не откажет тебе в помощи, попроси его об этом.</li>
            <li><strong>Шампанское</strong> — не теряй рассудок и осторожность. Все нужно делать на трезвую голову.</li>
        </ol>
        <p class="text-center"><b>Удачного Вам расклада!</b></p>
    </div>
</div>


<!--// Вывод элементов-->
<?php //foreach($divination['elements'] as $key=>$element): ?>
<!--    --><?php
//    $thumb = $element['thumb'];
//    $description = $element['description'];
//    if($element['pivot_thumb'] !== ''){$thumb = $element['pivot_thumb'];}
//    if($element['pivot_description'] !== ''){$element['pivot_description'];}
//    ?>
<!--    <div class="hidden-card" id="hidden-card---><?php //echo $key ?><!--" data-name="card---><?php //echo $element['name'] ?><!--" data-img="--><?php //echo $thumb; ?><!--" style="display: none">-->
<!--        <h2>Карта <span class="card-name">--><?php //echo $element['name'] ?><!-- <span class="is-revert"></span></span></h2>-->
<!--        <span>--><?php //echo $description ?><!--</span>-->
<!--    </div>-->
<?php //endforeach; ?>