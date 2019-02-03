<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *
 *   ВНИМАНИЕ!!!!!!!
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   ПРИ ОБНОВЛЕНИИ ТЕМЫ - ВЫ ПОТЕРЯЕТЕ ВСЕ ВАШИ ИЗМЕНЕНИЯ
 *   ИСПОЛЬЗУЙТЕ ДОЧЕРНЮЮ ТЕМУ ИЛИ НАСТРОЙКИ ТЕМЫ В АДМИНКЕ
 *
 *   ПОДБРОБНЕЕ:
 *   https://docs.wpshop.ru/child-themes/
 *
 * *****************************************************************************
 *
 * @package Root
 */

$related_count_mod = root_get_option( 'structure_page_related' );

if ( ! empty( $related_count_mod  ) ) {

    $related_count = 6;
    if (is_numeric($related_count_mod) && $related_count_mod > -1) {
        if ( $related_count_mod > 50 ) $related_count_mod = 50;
        $related_count = $related_count_mod;
    }
    $args = array(
        'orderby'      => 'description',
        'order'        => 'ASC',
    );
    $tags = get_tags($args);
    foreach ($tags as $tag):
    $related_articles = get_posts(array(
        'numberposts' => '-1',
        'orderby' => 'rand',
        'category_name' => 'divination_online',
        'post_type' => 'post',
        'tag__in' => $tag->term_id
    ));
    if (!empty($related_articles)):?>

        <div class="b-related clear-none">
            <div class="b-related__header"><span><?php echo $tag->name; ?></span></div>
            <div class="b-related__items posts-container--four-columns">

                <?php
                $postOutputCount = 1;
                foreach ($related_articles as $post) {
                    setup_postdata($post); ?>

                    <?php get_template_part('template-parts/posts/content', 'card-without-micro'); ?>

                <?php
                if($postOutputCount % 4 == 0): ?>
                <div style="clear: both"></div>
                <?php endif; ?>
                <?php
                    $postOutputCount++;
                }
                wp_reset_postdata(); ?>


            </div>
        </div>

        <?php endif; ?>
    <?php endforeach; ?>
    <?php
}
?>