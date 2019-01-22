let cardsCount = 78; // Кол-во кард в колоде

let totalCardsCount; // Кол-во карт, используемых при гадании
let cardsNumbers; // Массив номеров карт в случайном порядке
let currentCardCounter; // Счетчик порядкого номера текущей (выбранной) карты

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
function showDescription($, number = 0) {
    if(number) {
        $('#show-desk').show(500);
    } else {
        $('#show-desk').hide(500);
    }
    $('.hidden-card').hide(500); // Прячем описание карты
    $('#hidden-card-' + number.toString()).show(500); // Показываем правила гадания
}

// Перезагрузка гадания
function reload($) {
    totalCardsCount = $('.divination').data('card-count'); // Используемое кол-во карт берем из дата атрибута
    currentCardCounter = 0; // Зануляем счетчик текущей карты
    cardsNumbers = [];

    // Массив с номерами карт заполняем 1 .. cardsCount
    for(let i = 1; i <= cardsCount; i++) {
        cardsNumbers.push(i);
    }

    // Перемешиваем массив с номерами карт для создания ощущения "Случайности"
    cardsNumbers = shuffle(cardsNumbers);

    $('#show-desk').hide(500); // Прячем кнопку просмотра расклада
    $('#divination-again').hide(500); // Прячем кнопку повторного гадания
    $('.desk-card a').stop().animate({opacity: 0}, 1000, function () {
        $(this).css({'background': 'url(/wp-content/plugins/brainor-gadanie/assets/imgs/taro/taro_rubashka.png)'})
            .animate({opacity: 1}, {duration: 1000});
    });
    $('.desk-card').removeClass('card-loaded'); // Убирем класс показанных карт
    $("#currentAction").hide(500, function() { // Меняем текст подсказки
        $(this).html("Выберите карту").show(100);
    });

    showDescription($); // Скрываем описание карт и показываем правила гадания

    console.log(totalCardsCount);
    console.log(currentCardCounter);
    console.log(cardsNumbers);
}

(function ($) {
    $(document).ready(function () {
        reload($);

        // Клик по карте из колоды
        $('.divination').on('click', '.hand-card', function () {
            // Если гадание не завершено
            if (currentCardCounter < cardsNumbers.length) {
                let num = cardsNumbers.pop(); // Берем случайный номер карты
                let card = $('#hidden-card-' + num.toString()); // Ищем данные этой карты в скрытых инпутах всех карт
                $('#desk-card-' + (++currentCardCounter).toString() + ' a').stop().animate({opacity: 0}, 1000, function () {
                    $(this).css({'background': 'url(' + card.data('img') + ')'})
                        .animate({opacity: 1}, {duration: 1000});
                }); // Обновляем карту с текущим порядковым номером (меняем картинку)
                $('#desk-card-' + (currentCardCounter).toString()).addClass('card-loaded'); // Помечаем карту с текущим порядковым номером прогруженной
                $('#desk-card-' + (currentCardCounter).toString()).data('card-number', num.toString()); // Запоминаем номер карты в дата атрибут карты с текущим порядковым номером
            }

            // Если гадание завершено
            if (currentCardCounter >= totalCardsCount) {
                $('#divination-again').show(500); // Показываем кнопку повторного голосования
                $("#currentAction").hide(500, function() { // Меняем текст подсказки
                    $(this).html("Нажмите на карту для просмотра").show(100);
                });
            }
        });

        // Клик по загруженной карте для просмотра её описания
        $('.divination').on('click', '.card-loaded', function () {
            showDescription($, $(this).data('card-number'));
        });

        // Клик по кнопки просмотра расклада
        $('.divination').on('click', '#show-desk', function () {
            showDescription($);
        });

        // Клик по кнопке повторного гадания
        $('.divination').on('click', '#divination-again', function () {
            reload($);
        });
    });
})(jQuery);