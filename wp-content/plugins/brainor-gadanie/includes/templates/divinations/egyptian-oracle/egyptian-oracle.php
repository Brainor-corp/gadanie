<script>
    if (!document.getElementById('divination-egyptian-oracle-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-egyptian-oracle-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-egyptian-oracle.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-egyptian-oracle-js')) {
        let scriptFlip = document.createElement('script');
        scriptFlip.src = 'https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js';
        scriptFlip.id = 'divination-egyptian-oracle-flip-js';
        scriptFlip.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(scriptFlip);

        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-egyptian-oracle.js';
        script.id = 'divination-egyptian-oracle-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<?php
    $numbers = [];
    for($i = 1; $i <= 21; $i++):
        array_push($numbers, $i);
    endfor;

    shuffle($numbers);
?>

<div class="divination-egyptian-oracle" id="<?php echo uniqid() ?>" data-strength="" data-weakness="" data-outcome="" data-time=0>
    <div class="br-eg-pyramid">
        <?php for($i = 0; $i < 3; $i++): ?>
            <div class="br-eg-row">
                <?php for($k = 0; $k < (9 - (5 + ($i * 2))) / 2; $k++): ?>
                    <div class="br-eg-tile"></div>
                <?php endfor ?>
                <?php for($j = 0; $j < 5 + ($i * 2); $j++): ?>
                    <div class="br-eg-tile">
                        <?php
                            $imgNumber = $j % 2 == 0 ? 1 : 2;
                        ?>
                        <div class="front">
                            <img class="egypt-triangle" src="/wp-content/plugins/brainor-gadanie/assets/imgs/egypt/egipt<?php echo $imgNumber ?>.png" alt="">
                        </div>
                        <div class="back" style="display: none;">
                            <img class="egypt-triangle" src="/wp-content/plugins/brainor-gadanie/assets/imgs/egypt/egipt<?php echo $imgNumber ?>.png" alt="">
                            <?php $num = array_pop($numbers) ?>
                            <div class="br-eg-number" data-num="<?php echo $num ?>"><?php echo $num ?></div>
                        </div>
                    </div>
                <?php endfor ?>
                <?php for($k = 0; $k < (9 - (5 + ($i * 2))) / 2; $k++): ?>
                    <div class="br-eg-tile"></div>
                <?php endfor ?>
            </div>
        <?php endfor ?>
    </div>
    <div class="br-eg-answers">
        <div class="br-eg-control">
            <button class="br-eg-restart">Начать с начала</button>
        </div>
        <div class="br-eg-answer-strength">
            <p align="center">
                <span>За Вас – Ваша сила</span>
            </p>
            <div class="br-eg-answer br-eg-answer-1">
                <p align="justify"><b>Осирис – Бог возрождения, царь загробного мира и судья душ усопших</b><br>Уравновешенный ум, сила духа, чувство ответственности и справедливости. Вы из тех, на кого полагаются, вы обладаете определенным авторитетом.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-2">
                <p align="justify"><b>Изида – Богиня плодородия, ветра, воды и мореплавания</b><br>Сострадание, доброта – ваши козыри. Как мать занимается своими детьми, так и вам надо заботиться о тех, кто вас окружает.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-3">
                <p align="justify"><b>Гор – Бог неба и солнца в облике сокола</b><br>Ваши отвага и сила ума являются козырями, на которые вы определенно можете рассчитывать. Вы полностью управляете своими возможностями.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-4">
                <p align="justify"><b>Баст – Богиня радости, веселья и любви, женской красоты, плодородия и домашнего очага</b><br>Воплощает грацию и красоту. Ваши козыри – это искренняя радость бытия и способность во всем доверять своей интуиции.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-5">
                <p align="justify"><b>Тот – Бог мудрости, знаний, Луны, покровитель мирового порядка</b><br>Ум и умение общаться – ваши основные козыри. Вы непременно придете к успеху через учебу, уважение к законам и размышление.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-6">
                <p align="justify"><b>Хатор – Богиня неба, любви, женственности, красоты, плодородия, веселья и танцев</b><br>Ваше очарование, умение подчеркивать свои достоинства дают вам верные козыри. У вас также есть голова на плечах, вы знаете, чего хотите, а чего – нет.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-7">
                <p align="justify"><b>Нефтида – супруга Сета, госпожа обители, владычица владычица дома и сумерек</b><br>Ваша сила заключена в… невидимом. На правильную дорогу вас выведут знание людей и положений, сдержанность, внутреннее спокойствие, молчаливость.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-8">
                <p align="justify"><b>Птах – Бог города Мемфиса, Бог-творец, покровитель искусств и ремесел</b><br>Изобретательность и сноровка – ваши козыри. Надо создать нечто осязаемое, видимое, материальное. Вы на пути созидания.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-9">
                <p align="justify"><b>Анубис – проводник умерших в загробный мир, судья царства мертвых, хранитель ядов и лекарств</b><br>Вы под охраной таинственных сил, которые ориентируют вас в правильном направлении, вопреки козням и интригам. Или же вы сами играете эту роль провожатого для других людей.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-10">
                <p align="justify"><b>Сет – Бог ярости, разрушения, хаоса, песчаных бурь, войны и смерти, повелитель пустынь</b><br>Вы должны противостоять всякого рода трудностям или неблагоприятным обстоятельствам. Причина многих ваших проблем – не другие люди и не внешние условия, а вы сами.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-11">
                <p align="justify"><b>Сириус – священная звезда Египта, небесный фундамент</b><br>Дает такие козыри, как физическая сила, выносливость, здоровый авантюризм и сознательность в работе. Вы хотите подняться, засиять, и это доброе предзнаменование.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-12">
                <p align="justify"><b>Лотос – символ рождения Солнца, знак рождения Бога солнца Ра</b><br>Этот священный цветок Египта означает приглашение к размышлению, спокойствию духа, безмятежности. Ваша сила в непоколебимом спокойствии, с которым вы должны наблюдать развитие ситуации.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-13">
                <p align="justify"><b>Жезл и Цеп – знаки власти фараона</b><br>Дисциплинированность, умение руководить, данный от природы авторитет – ваши козыри, чтобы изменить свое положение. Но, может быть, вы не отдаете себе в этом отчета.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-14">
                <p align="justify"><b>Урей – знак священной кобры Уаджит, символ сверхъестественных сил</b><br>Вы обладаете завидной чуткостью, ловкостью, проницательностью, это делает вас хозяином положения. Ваши силы значительны, вы должны это осознавать.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-15">
                <p align="justify"><b>Крылатый солнечный диск – образ Солнца в момент затмения, величие, мощь и вечность духа</b><br>Вдохновение, мудрость, идеи, которые предстоит реализовать. Вы стремитесь развиваться, возвышаться или найти новый стиль жизни, полнее соответствующий вашим внутренним чаяниям. Это доброе предзнаменование.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-16">
                <p align="justify"><b>Близнецы – стражи неба и горизонта</b><br>Вы обладаете великолепными козырями для создания сообществ, союзов, для проведения встреч, для вступления в какую-нибудь команду.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-17">
                <p align="justify"><b>Сфинкс – хранитель гробниц и храмовых построек, страж пирамид</b><br>Терпение – ваш основной козырь. Умейте ждать благоприятного момента для действий, научитесь держать при себе свои чувства. Молчание – золото!</p>
            </div>
            <div class="br-eg-answer br-eg-answer-18">
                <p align="justify"><b>Скарабей – священный жук, символ рождения и движения Солнца, дающий энергию и новые возможности</b><br>Дает прекрасные козыри, если вы стремитесь преобразить какую-то ситуацию, возобновить все с нуля. Скарабей — символ обновления, возрождения.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-19">
                <p align="justify"><b>Пирамида – восхождение души к высшим мирам</b><br>Видеть долгосрочную перспективу, держать ситуацию твердой рукой – вот что вы должны делать, чтобы достичь своей цели. Сейчас стоит вопрос не о преобразовании, а о стабилизации и даже об укреплении сложившейся ситуации.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-20">
                <p align="justify"><b>Анкх – символ жизни, ключ к тайному знанию и скрытой мудрости, сила, открывающая врата бессмертия</b><br>Жить и любить – вот к чему вас призывает этот символ. Жить, чтобы любить, любить, чтобы жить…</p>
            </div>
            <div class="br-eg-answer br-eg-answer-21">
                <p align="justify"><b>Пряжка (Узел) Исиды – защитный амулет, оберегающий от колдовских чар, открывающий в человеке магический дар</b><br>Если вы решили присоединиться к какой-то группе, обрести свое «я», свободно развиваться среди других людей, то сейчас вы на правильном пути.</p>
            </div>
        </div>
        <div class="br-eg-answer-weakness">
            <p align="center"><span>Против Вас – Ваша слабость</span></p>
            <div class="br-eg-answer br-eg-answer-1">
                <p align="justify"><b>Осирис – Бог возрождения, царь загробного мира и судья душ усопших</b><br>Нет негативных факторов, нет слабости.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-2">
                <p align="justify"><b>Изида – Богиня плодородия, ветра, воды и мореплавания</b><br>Смысл вашей помощи плохо понятен окружающим, вам не хватает упорства, или вы слишком авторитарны.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-3">
                <p align="justify"><b>Гор – Бог неба и солнца в облике сокола</b><br>Остерегайтесь желания мстить, необузданной страсти или агрессивности – это привело бы вас к разладу, к напряженному или затруднительному положению.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-4">
                <p align="justify"><b>Баст – Богиня радости, веселья и любви, женской красоты, плодородия и домашнего очага</b><br>Остерегайтесь беспечности, легкомыслия, беспокойства, беспричинной грусти. Есть риск самоизоляции от мира или утраты интереса к нему.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-5">
                <p align="justify"><b>Тот – Бог мудрости, знаний, Луны, покровитель мирового порядка</b><br>Вы должны остерегаться тщеславия, гордыни и не говорить больше, чем того требует положение вещей. Или же вас неверно оценили, или вы неверно оценили ближнего.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-6">
                <p align="justify"><b>Хатор – Богиня неба, любви, женственности, красоты, плодородия, веселья и танцев</b><br>Вы напуганы, страдаете от комплекса неполноценности или проявляете нерешительность, что может поставить вас в невыгодное положение. Аналогичная ситуация может сложиться из-за желания жить праздно, беспечно плывя по течению.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-7">
                <p align="justify"><b>Нефтида – супруга Сета, госпожа обители, владычица владычица дома и сумерек</b><br>У вас есть скрытые страхи или опасения, которые вы не можете выразить. Остерегайтесь иллюзии и миражей, потому что в вашем положении вы знаете меньше, чем полагаете.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-8">
                <p align="justify"><b>Птах – Бог города Мемфиса, Бог-творец, покровитель искусств и ремесел</b><br>Быть может, речь идет об отказе брать на себя ответственность, о страхе оказаться не на высоте? Как бы там ни было, ваши мысли направлены не в позитивную сторону.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-9">
                <p align="justify"><b>Анубис – проводник умерших в загробный мир, судья царства мертвых, хранитель ядов и лекарств</b><br>Вам не хватает такта, дипломатичности, чувства юмора, или же вы пошли неверным путем и теперь столкнулись с разочарованием.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-10">
                <p align="justify"><b>Сет – Бог ярости, разрушения, хаоса, песчаных бурь, войны и смерти, повелитель пустынь</b><br>Речь идет о ревнивом, завистливом, злонамеренном в отношении вас человеке, влияние которого пагубно для вас. Но, может быть, это вы сами – ревнивы и завистливы?</p>
            </div>
            <div class="br-eg-answer br-eg-answer-11">
                <p align="justify"><b>Сириус – священная звезда Египта, небесный фундамент</b><br>В метаниях между упрямством и попустительством, между агрессивностью и покорностью вы пытаетесь найти свой путь. Остерегайтесь физического или словесного насилия, а также преследования со стороны.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-12">
                <p align="justify"><b>Лотос – символ рождения Солнца, знак рождения Бога солнца Ра</b><br>Ваше тело, как и ваш ум, подвержено метаниям, беспокойству, нервозности. Вы то и дело замыкаетесь в себе, упорно мешаете своей глубинной природе проявить себя. Остерегайтесь сосредоточенности на самом себе.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-13">
                <p align="justify"><b>Жезл и Цеп – знаки власти фараона</b><br>Вам не хватает терпимости, снисходительности, или вы стремитесь контролировать ситуацию и даже господствовать над ней с помощью силы. Может быть, вы слишком хотите командовать другими людьми? Не пытайтесь все делать в одиночку.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-14">
                <p align="justify"><b>Урей – знак священной кобры Уаджит, символ сверхъестественных сил</b><br>Явное предостережение – вы играете против более сильного игрока, но в упор не видите опасности; поджимает время, или вас переполняет безумная страсть.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-15">
                <p align="justify"><b>Крылатый солнечный диск – образ Солнца в момент затмения, величие, мощь и вечность духа</b><br>Будьте осторожны, вы соглашаетесь с некоторыми идеями, не подумав. Сделайте паузу, объективнее оцените обстановку. Иначе вы себя ослепите и в конечном счете будете разочарованы.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-16">
                <p align="justify"><b>Близнецы – стражи неба и горизонта</b><br>Вам трудно поделиться своими чувствами, идеями или стать частью некоего целого. Остерегайтесь эгоизма, индивидуализма, иначе останетесь в одиночестве.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-17">
                <p align="justify"><b>Сфинкс – хранитель гробниц и храмовых построек, страж пирамид</b><br>Вы совершили бестактный поступок, проявили безразличие к ближнему. От вас требуется разрешить какую-то загадку или разобраться с тем, что творится у вас за спиной.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-18">
                <p align="justify"><b>Скарабей – священный жук, символ рождения и движения Солнца, дающий энергию и новые возможности</b><br>Была осуществлена неразумная перемена, вы были небрежны, расстроили какое-то положение или же были злопамятны. Теперь вы имеете дело сами с собой, со своими ошибками и обидами.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-19">
                <p align="justify"><b>Пирамида – восхождение души к высшим мирам</b><br>Вы были небрежны, беспечны или же пожелали сохранить существующее положение вещей во что бы то ни стало. Главное – не стойте на своих позициях, даже если они вам кажутся удобными.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-20">
                <p align="justify"><b>Анкх – символ жизни, ключ к тайному знанию и скрытой мудрости, сила, открывающая врата бессмертия</b><br>Вы прогнали кого-то или пренебрегли кем-то, отвергли чью-то любовь или пытались получить, ничего не дав взамен. Вы обладаете ключом, но не находите замка! Теперь надо пройти через узкую дверь.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-21">
                <p align="justify"><b>Пряжка (Узел) Исиды – защитный амулет, оберегающий от колдовских чар, открывающий в человеке магический дар</b><br>Может быть, вы проявили нелояльность, непостоянство, эгоизм. Вам придется отложить какую-то идею, проект или чувство, чтобы исправить ситуацию.</p>
            </div>
        </div>
        <div class="br-eg-answer-outcome">
            <p align="center"><span>Исход ситуации</span></p>
            <div class="br-eg-answer br-eg-answer-1">
                <p align="justify"><b>Осирис – Бог возрождения, царь загробного мира и судья душ усопших</b><br>Ваши планы обречены на успех, если вы будете действовать в том же духе и доверять собственному мнению.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-2">
                <p align="justify"><b>Изида – Богиня плодородия, ветра, воды и мореплавания</b><br>Вы, должно быть, думаете о других больше, чем о себе. Все будет хорошо, если речь идет о ваших детях (или их рождении), или вашей роли в качестве партнера.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-3">
                <p align="justify"><b>Гор – Бог неба и солнца в облике сокола</b><br>Доброе предзнаменование. В зависимости от вашего вопроса, речь идет о борьбе, в которой вы победите, о выздоровлении, о новой гармонии в семейных отношениях или о присутствии достойного партнера.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-4">
                <p align="justify"><b>Баст – Богиня радости, веселья и любви, женской красоты, плодородия и домашнего очага</b><br>Нынешние трудности закончатся, наслаждение пребудет с вами, вы извлечете все самое хорошее из этой ситуации.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-5">
                <p align="justify"><b>Тот – Бог мудрости, знаний, Луны, покровитель мирового порядка</b><br>Предсказание Тота благоприятно, если ваш вопрос касается учебы или любого интеллектуального проекта. Если вы сумеете быть терпеливыми, удача вам наверняка улыбнется, а случайность будет играть благотворную роль.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-6">
                <p align="justify"><b>Хатор – Богиня неба, любви, женственности, красоты, плодородия, веселья и танцев</b><br>Расцвет и удовлетворение в любви. Можно получать и разделять наслаждение.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-7">
                <p align="justify"><b>Нефтида – супруга Сета, госпожа обители, владычица владычица дома и сумерек</b><br>Перемена еще не может свершиться на деле. Положение неясно, ваши намерения неопределенны, некоторые ответы остаются скрытыми. Надо ждать, чтобы лучше разобраться…</p>
            </div>
            <div class="br-eg-answer br-eg-answer-8">
                <p align="justify"><b>Птах – Бог города Мемфиса, Бог-творец, покровитель искусств и ремесел</b><br>Ваша ситуация будет развиваться, потому что ваш ум открыт новому. Вы заложите прочные основы и будете двигаться дальше при условии, что не перестанете учиться и запоминать уроки прошлого.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-9">
                <p align="justify"><b>Анубис – проводник умерших в загробный мир, судья царства мертвых, хранитель ядов и лекарств</b><br>Будьте готовы предпринять самые решительные шаги, даже если они вам кажутся сомнительными или трудными. Анубис ведет вас и охраняет.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-10">
                <p align="justify"><b>Сет – Бог ярости, разрушения, хаоса, песчаных бурь, войны и смерти, повелитель пустынь</b><br>План, который вы так старательно вынашиваете, не может осуществиться в его нынешнем виде. Вы должны пересмотреть то, что больше не соответствует реальности. Надо сломать, чтобы опять построить, но уже на более здравых и прочных основаниях.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-11">
                <p align="justify"><b>Сириус – священная звезда Египта, небесный фундамент</b><br>Предвещает внезапную, неожиданную перемену в вашей оценке ситуации. Смотрите достаточно далеко вперед, умейте взглянуть на вещи со стороны, раскройте ум для новшеств. Так вы достигнете удачи.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-12">
                <p align="justify"><b>Лотос – символ рождения Солнца, знак рождения Бога солнца Ра</b><br>Вы достигнете своих целей, сняв внутреннюю напряженность и строго следуя правилам здорового образа жизни. Научитесь не тревожиться, чувствовать себя в безопасности и будьте спокойны – в конце концов все будет хорошо.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-13">
                <p align="justify"><b>Жезл и Цеп – знаки власти фараона</b><br>Чрезвычайно доброе предзнаменование для принятия важного решения или взятия ответственности. Если вы чувствуете в себе такие способности, соглашайтесь на эту роль с энтузиазмом, в противном случае – передайте командование делами другим людям.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-14">
                <p align="justify"><b>Урей – знак священной кобры Уаджит, символ сверхъестественных сил</b><br>Вы получите все или ничего! Если ваши намерения чисты, лишены эгоистичности, вы непременно достигнете большого успеха. Если же вы действуете только ради себя, неудача будет сокрушительной.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-15">
                <p align="justify"><b>Крылатый солнечный диск – образ Солнца в момент затмения, величие, мощь и вечность духа</b><br>Надо не стабилизировать ситуацию, а преображать ее. Великолепное предзнаменование для начала какого-нибудь проекта, путешествия или преодоления трудностей. Ваши планы обязательно увенчаются успехом.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-16">
                <p align="justify"><b>Близнецы – стражи неба и горизонта</b><br>Великолепное предзнаменование для тех, кто хочет создать коллектив единомышленников, внести гармонию в отношения с другими людьми. Вы придете к успеху, если будете считать себя составной частью интересующей вас группы людей.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-17">
                <p align="justify"><b>Сфинкс – хранитель гробниц и храмовых построек, страж пирамид</b><br>Бесполезно излагать свою точку зрения, спорить, аргументировать. Пока не раскрывайте своих намерений, умейте хранить свои секреты, наблюдайте, но не произносите ни слова. Только время даст ответы на ваши вопросы.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-18">
                <p align="justify"><b>Скарабей – священный жук, символ рождения и движения Солнца, дающий энергию и новые возможности</b><br>Речь пойдет о преобразованиях в вашей жизни, о каком-то потрясении, о новом старте. Это хорошие перспективы для тех, кто согласен начать жить иначе, действовать по-другому. А вот стабильность сохранить не удастся.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-19">
                <p align="justify"><b>Пирамида – восхождение души к высшим мирам</b><br>Доброе предзнаменование, если сохранять курс, стремиться строить прочно, создавать длительные связи. О какой бы сфере жизни ни шла речь, все, что касается долгосрочных перспектив, имеет преимущество.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-20">
                <p align="justify"><b>Анкх – символ жизни, ключ к тайному знанию и скрытой мудрости, сила, открывающая врата бессмертия</b><br>Прекрасное предзнаменование! Речь идет о встрече с кем-то, о расцвете привлекательности, о задушевных отношениях, о браке, рождении ребенка. Ваши отношения с друзьями и любимыми укрепятся.</p>
            </div>
            <div class="br-eg-answer br-eg-answer-21">
                <p align="justify"><b>Пряжка (Узел) Исиды – защитный амулет, оберегающий от колдовских чар, открывающий в человеке магический дар</b><br>В данном случае речь идет о зернах, которые сажают в плодородную почву. Символ говорит о плодотворном труде, о творческом таланте, верной любви, о создании проекта или рождении ребенка.</p>
            </div>
        </div>
    </div>
</div>