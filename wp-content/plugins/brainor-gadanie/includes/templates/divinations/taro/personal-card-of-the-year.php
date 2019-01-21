<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro.css">
<script src="/wp-content/plugins/brainor-gadanie/assets/js/divination-taro.js"></script>

<div class="divination" data-card-count="1">
    <div class="taro_bg">
        <div class="hand">
            <span class="ca">Выберите карту:</span>
            <div class="t_card" id="divination">
                <?php for($i = 0; $i < 20; $i++) { ?>
                    <a href="#" class="card" onclick="return false"></a>
                <?php } ?>
            </div>
        </div>
        <div class="desk">
            <div class="desk-left">
                <div class="desk-card t_card" data-number="1">
                    <a href="#" onclick="return false"></a>
                </div>
            </div>
            <div class="desk-right">
                <div class="card-0">
                    1. Значение
                </div>
                <?php for($i = 0; $i < 78; $i++) { ?>
                    <div class="card-<?php $i ?>" data-name="card-<?php $i ?>" data-img="http://www.onlinegadanie.ru/wp-content/themes/onlinegadanie/images/taro/danet/taro00.png" style="display: none">
                        <h2>Описание карты <?php $i ?></h2>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, optio!</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>