<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro.css">
<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-taro-personal-card-of-the-year.css">
<script src="/wp-content/plugins/brainor-gadanie/assets/js/divination-taro.js"></script>

<?php
global  $wpdb;

$divinationTable = $wpdb->get_blog_prefix().'br_divinations';
$divinationElementsTable = $wpdb->get_blog_prefix().'br_divination_elements';
$divinationPivotTable = $wpdb->get_blog_prefix().'br_divination_elements_pivot';

$sql = '
    SELECT 
        D.id,
        D.name,
        D.slug,
        D.description,
        D.thumb,
        D.created_at,
        group_concat("{\"id\":\"",IFNULL(DE.id, "NULL"),"\",\"name\":\"",IFNULL(DE.name, "NULL"),"\",\"slug\":\"",IFNULL(DE.slug, "NULL"),"\",\"class\":\"",IFNULL(DE.class, "NULL"),"\",\"description\":\"",IFNULL(DE.description, "NULL"),"\",\"thumb\":\"",IFNULL(DE.thumb, "NULL"),"\",\"created_at\":\"",IFNULL(DE.created_at, "NULL"),"\",\"pivot_thumb\":\"",IFNULL(DP.thumb, "NULL"),"\",\"pivot_description\":\"",IFNULL(DP.description, "NULL"),"\"}") as elements 
    from '.$divinationTable.' D
    LEFT JOIN '.$divinationPivotTable.' DP on DP.divination_id = D.id
    LEFT JOIN '.$divinationElementsTable.' DE on DP.divination_element_id = DE.id
    ORDER BY D.id ASC';
$divination = $wpdb->get_row( $sql , ARRAY_A );

$str3 = str_replace("\n","", str_replace("\r","", $divination['elements']));
$divination['elements'] = json_decode('['.$str3.']',true);
?>

<div class="divination" data-card-count="1" id="<?php echo uniqid() ?>">
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

                <?php for($i = 1; $i <= 78; $i++): ?>
                    <?php
                    $thumb = $divination['elements'][0]['thumb'];
                    $description = $divination['elements'][0]['description'];
                    if($divination['elements'][0]['pivot_thumb'] !== ''){$thumb = $divination['elements'][0]['pivot_thumb'];}
                    if($divination['elements'][0]['pivot_description'] !== ''){$description = $divination['elements'][0]['pivot_description'];}
                    ?>
                    <div class="hidden-card" id="hidden-card-<?php echo $i ?>" data-name="card-<?php echo $i ?>" data-img="<?php echo $thumb; ?>" style="display: none">
                        <h2>Описание карты <?php echo $divination['elements'][0]['name'] ?></h2>
                        <span><?php echo $description ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>