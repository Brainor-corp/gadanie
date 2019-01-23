if(typeof cardsCount === 'undefined') {
    console.log('cardsCount');
    var cardsCount = 78; // Кол-во кард в колоде
}

if(typeof totalCardsCount === 'undefined') {
    console.log('totalCardsCount');
    var totalCardsCount = []; // Кол-во карт, используемых при гадании
}

if(typeof cardsNumbers === 'undefined') {
    console.log('cardsNumbers');
    var cardsNumbers = []; // Массив номеров карт в случайном порядке
}

if(typeof currentCardCounter === 'undefined') {
    console.log('currentCardCounter');
    var currentCardCounter = []; // Счетчик порядкого номера текущей (выбранной) карты
}

// Перемешивание значений массива
function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

// Скрывает описание всех карт и показывает описание карты с номером number
// number = 0 -- правила гадания
function showDescription($, divinationIdStr, isRevert = 0, number = 0) {
    let divinationIdPrefix = '#' + divinationIdStr + ' ';
    if(number) {
        $(divinationIdPrefix + '#show-desk').show(500);
    } else {
        $(divinationIdPrefix + '#show-desk').hide(500);
    }
    $(divinationIdPrefix + '.hidden-card').hide(500); // Прячем описание карты

    console.log(divinationIdPrefix + '#hidden-card-' + number.toString() + ' .card-name .is-revert');
    if(isRevert) {
        $(divinationIdPrefix + '#hidden-card-' + number.toString() + ' .card-name .is-revert').text('(Перевернутая)')
    } else {
        $(divinationIdPrefix + '#hidden-card-' + number.toString() + ' .card-name .is-revert').text('')
    }

    $(divinationIdPrefix + '#hidden-card-' + number.toString()).show(500); // Показываем правила гадания
}

// Перезагрузка гадания
function reload($, divinationIdStr) {
    let divinationIdPrefix = '#' + divinationIdStr + ' ';
    totalCardsCount[divinationIdStr] = $(divinationIdPrefix.substring(0, divinationIdPrefix.length - 1) + '.divination').data('card-count'); // Используемое кол-во карт берем из дата атрибута
    currentCardCounter[divinationIdStr] = 0; // Зануляем счетчик текущей карты
    cardsNumbers[divinationIdStr] = [];

    // Массив с номерами карт заполняем 1 .. cardsCount
    for(let i = 1; i <= cardsCount; i++) {
        cardsNumbers[divinationIdStr].push(i);
    }

    // Перемешиваем массив с номерами карт для создания ощущения "Случайности"
    cardsNumbers[divinationIdStr] = shuffle(cardsNumbers[divinationIdStr]);

    $(divinationIdPrefix + '#show-desk').hide(500); // Прячем кнопку просмотра расклада
    $(divinationIdPrefix + '#divination-again').hide(500); // Прячем кнопку повторного гадания
    $(divinationIdPrefix + '.desk-card a').stop().animate({opacity: 0}, 1000, function () {
        $(this).css({
            'background': 'url(/wp-content/plugins/brainor-gadanie/assets/imgs/taro/taro_rubashka.png)',
            'transform': 'rotate(-0deg)',
        })
            .animate({opacity: 1}, {duration: 1000});
    });
    $(divinationIdPrefix + '.desk-card').removeClass('card-loaded'); // Убирем класс показанных карт
    $(divinationIdPrefix + "#currentAction").hide(500, function() { // Меняем текст подсказки
        $(this).html("Выберите " + totalCardsCount[divinationIdStr].toString() + " карт(у)").show(500);
    });

    showDescription($, divinationIdStr); // Скрываем описание карт и показываем правила гадания
}

(function ($) {
    $(document).ready(function () {
        $('.divination').each(function( ) {
            reload($, $(this).attr('id'));
        });

        // Клик по карте из колоды
        $('.divination').on('click', '.hand-card', function () {
            let divinationIdStr = $(this).closest('.divination').attr('id');
            let divinationIdPrefix = '#' + $(this).closest('.divination').attr('id') + ' ';

            console.log(divinationIdStr);

            // Если гадание не завершено
            if (currentCardCounter[divinationIdStr] < cardsNumbers[divinationIdStr].length) {
                let num = cardsNumbers[divinationIdStr].pop(); // Берем случайный номер карты
                let card = $(divinationIdPrefix + '#hidden-card-' + num.toString()); // Ищем данные этой карты в скрытых инпутах всех карт
                let rotate = Math.floor(Math.random() * 2); // Если выпала перевернутая карта, то переворачиваем её
                let cardStyle = {};
                if(rotate) {
                    cardStyle = {
                        'transform': 'rotate(-180deg)',
                        'background': 'url(' + card.data('img') + ')'
                    };
                } else {
                    cardStyle = {
                        'background': 'url(' + card.data('img') + ')'
                    };
                }
                console.log(rotate);
                console.log(cardStyle);
                $(divinationIdPrefix + '#desk-card-' + (++currentCardCounter[divinationIdStr]).toString() + ' a').stop().animate({opacity: 0}, 1000, function () {
                    $(this).css(cardStyle)
                        .animate({opacity: 1}, {duration: 1000});
                }); // Обновляем карту с текущим порядковым номером (меняем картинку)
                $(divinationIdPrefix + '#desk-card-' + (currentCardCounter[divinationIdStr]).toString()).addClass('card-loaded'); // Помечаем карту с текущим порядковым номером прогруженной
                $(divinationIdPrefix + '#desk-card-' + (currentCardCounter[divinationIdStr]).toString()).data('card-number', num.toString()); // Запоминаем номер карты в дата атрибут карты с текущим порядковым номером
                $(divinationIdPrefix + '#desk-card-' + (currentCardCounter[divinationIdStr]).toString()).data('card-rotate', rotate); // Запоминаем номер карты в дата атрибут карты с текущим порядковым номером
            }

            // Если гадание завершено
            if (currentCardCounter[divinationIdStr] >= totalCardsCount[divinationIdStr]) {
                $(divinationIdPrefix + '#divination-again').show(500); // Показываем кнопку повторного голосования
                $(divinationIdPrefix + "#currentAction").hide(500, function() { // Меняем текст подсказки
                    $(this).html("Нажмите на карту для просмотра").show(500);
                });
            }
        });

        // Клик по загруженной карте для просмотра её описания
        $('.divination').on('click', '.card-loaded', function () {
            let divinationIdStr = $(this).closest('.divination').attr('id');
            showDescription($, divinationIdStr, $(this).data('card-rotate'), $(this).data('card-number'));
        });

        // Клик по кнопки просмотра расклада
        $('.divination').on('click', '#show-desk', function () {
            let divinationIdStr = $(this).closest('.divination').attr('id');
            showDescription($, divinationIdStr);
        });

        // Клик по кнопке повторного гадания
        $('.divination').on('click', '#divination-again', function () {
            let divinationIdStr = $(this).closest('.divination').attr('id');
            reload($, divinationIdStr);
        });
    });
})(jQuery);