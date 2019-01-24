<script>
    if(!document.getElementById('divination-solitaire-css')) {
        let style = document.createElement( 'link' );
        style.setAttribute('id', 'divination-solitaire-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-solitaire.css');

        document.getElementsByTagName( 'head' )[ 0 ].appendChild(style);
    }

    if(!document.getElementById('divination-solitaire-js')) {
        let script = document.createElement( 'script' );
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-solitaire.js';
        script.id = 'divination-solitaire-js';
        script.type = 'text/javascript';
        document.getElementsByTagName( 'head' )[ 0 ].appendChild(script);
    }
</script>

<!--<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-solitaire-indian-solitaire.css">-->

<?php
global  $wpdb;

$width = 5; /////////////////////////////// Ширина поля
$height = 4; ////////////////////////////// Высота поля

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

<div class="divination-solitaire indian-solitaire" id="<?php echo uniqid() ?>">
    <button class="reload">Разложить карты</button>
    <div class="sol-table">
        <?php for($i = 0; $i < $height; $i++): ?>
            <div class="sol-row">
                <?php for($j = 0; $j < $width; $j++): ?>
                    <div class="sol-col">
                        <img src="http://gadalkindom.ru/wp-content/themes/gadalkindom2/skripts2/pasians-indiiskiy/img/bg.jpg" class="card-img" data-rotate="0" alt="">
                        <a href="#" class="rotate-left"><-</a>
                        <a href="#" class="rotate-right">-></a>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="elements">
        <?php for($i = 0; $i < $width * $height; $i++): ?>
            <div class="element" data-img="http://gadalkindom.ru/wp-content/themes/gadalkindom2/skripts3/pasians-na-budushee/img/1.jpg"></div>
        <?php endfor; ?>
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