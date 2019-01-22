<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro.css">
<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro-personal-card-of-the-year.css">
<script src="/wp-content/plugins/brainor-gadanie/assets/js/divination-taro.js"></script>

<div class="divination" data-card-count="2" id="<?php echo uniqid() ?>">
    <div class="taro_bg">
        <div class="hand">
            <div class="help-block">
                <span class="ca text-white" id="currentAction"></span>
            </div>
            <div class="t_card" id="divination">
                <?php for($i = 0; $i < 20; $i++) { ?>
                    <a href="#" class="hand-card" onclick="return false"></a>
                <?php } ?>
            </div>
        </div>
        <div class="desk">
            <div class="desk-left">
                <!--                Менять эту часть НАЧАЛО -->
                <div class="desk-cards">
                    <div class="desk-card" id="desk-card-1">
                        <small>1</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-2">
                        <small>2</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                </div>
                <!--                Менять эту часть КОНЕЦ-->

                <div class="navigation">
                    <div>
                        <button type="button" id="divination-again" style="display:none;">Гадать ещё раз</button>
                    </div>
                    <div>
                        <button type="button" id="show-desk" style="display:none;">Посмотреть расклад</button>
                    </div>
                </div>
            </div>
            <div class="desk-right">
                <div class="hidden-card card-0" id="hidden-card-0">
                    <span class="text-white">1. Значение</span>
                </div>
                <?php for($i = 1; $i <= 78; $i++) { ?>
                    <div class="hidden-card" id="hidden-card-<?php echo $i ?>" data-name="card-<?php echo $i ?>" data-img="http://www.onlinegadanie.ru/wp-content/themes/onlinegadanie/images/taro/danet/taro00.png" style="display: none">
                        <h2>Описание карты <?php echo $i ?></h2>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, optio!</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>