<script>
    if(!document.getElementById('divination-taro-css')) {
        let style = document.createElement( 'link' );
        style.setAttribute('id', 'divination-taro-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-taro.css');

        document.getElementsByTagName( 'head' )[ 0 ].appendChild(style);
    }

    if(!document.getElementById('divination-taro-js')) {
        let script = document.createElement( 'script' );
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-taro.js';
        script.id = 'divination-taro-js';
        script.type = 'text/javascript';
        document.getElementsByTagName( 'head' )[ 0 ].appendChild(script);
    }
</script>

<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro-lyubovnyj-treugolnik.css">

<?php
global  $wpdb;

$divinationTable = $wpdb->get_blog_prefix().'br_divinations';
$divinationElementsTable = $wpdb->get_blog_prefix().'br_divination_elements';
$divinationPivotTable = $wpdb->get_blog_prefix().'br_divination_elements_pivot';

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
    from '.$divinationTable.' D
    LEFT JOIN '.$divinationPivotTable.' DP on DP.divination_id = D.id
    LEFT JOIN '.$divinationElementsTable.' DE on DP.divination_element_id = DE.id
    WHERE D.slug = \''.$slug.'\'
    ORDER BY D.id ASC';
$divination = $wpdb->get_row( $sql , ARRAY_A );

$resultArr = [];
$elements = explode('<|>',$divination['elements']);
foreach ($elements as $elKey=>$element){
    if(strlen($element) > 0){
        $rows = explode('<->', $element);
        foreach ($rows as $rowKey=>$row) {
            if (strlen($row) > 0) {
                $keyValues = explode('<:>', $row);
                $resultArr[$elKey][$keyValues[0]]=$keyValues[1];
            }
        }
    }

}
$divination['elements'] = $resultArr;
?>

<div class="divination lyubovnyj-treugolnik" data-card-count="11" id="<?php echo uniqid() ?>">
    <div class="taro_bg">
        <div class="hand">
            <div class="help-block">
                <span class="ca text-white" id="currentAction"></span>
            </div>
            <div class="t_card" id="divination">
                <?php for($i = 0; $i < 78; $i++) { ?>
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
                </div>
                <div class="desk-cards">
                    <div class="desk-card" id="desk-card-2">
                        <small>2</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-3">
                        <small>3</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-4">
                        <small>4</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-5">
                        <small>5</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                </div>
                <div class="desk-cards">
                    <div class="desk-card" id="desk-card-6">
                        <small>6</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-7">
                        <small>7</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-8">
                        <small>8</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                </div>
                <div class="desk-cards">
                    <div class="desk-card" id="desk-card-9">
                        <small>9</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                    <div class="desk-card" id="desk-card-10">
                        <small>10</small>
                        <br>
                        <a href="#" onclick="return false"></a>
                    </div>
                </div>
                <div class="desk-cards">
                    <div class="desk-card" id="desk-card-11">
                        <small>11</small>
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
                    <span class="text-white">
                        1.Описание характера и личных качеств Вашего партнера. <br>
                        2.Все те вещи, которые являются самыми значимыми в личной жизни загаданного человека.<br>
                        3.Настоящее отношение Вашего партнера к Вам.<br>
                        4.Настоящее отношение Вашего партнера к Вашей сопернице/сопернику.<br>
                        5.Причина неопределенности Вашей второй половины.<br>
                        6.Значение и важность Ваших отношений в жизни Вашего партнера.<br>
                        7.Значение и важность Вашей соперницы в жизни Вашего любимого человека.<br>
                        8.Планы загаданного человека на счет Вас.<br>
                        9.Планы загаданного человека по отношению к Вашей сопернице/сопернику.<br>
                        10.Перспективы развития Ваших отношений с любимым человеком в будущем.<br>
                        11.Отношения Вашего партнера с Вашей соперницей/соперником в будущем.<br>
                    </span>
                </div>

                <?php foreach($divination['elements'] as $key=>$element): ?>
                    <?php
                    $thumb = $element['thumb'];
                    $description = $element['description'];
                    if($element['pivot_thumb'] !== ''){$thumb = $element['pivot_thumb'];}
                    if($element['pivot_description'] !== ''){$element['pivot_description'];}
                    ?>
                    <div class="hidden-card" id="hidden-card-<?php echo $key ?>" data-name="card-<?php echo $element['name'] ?>" data-img="<?php echo $thumb; ?>" style="display: none">
                        <h2>Карта <span class="card-name"><?php echo $element['name'] ?> <span class="is-revert"></span></span></h2>
                        <span><?php echo $description ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>