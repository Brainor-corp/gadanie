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

    $related_articles = get_posts(array(
        'posts_per_page' => $related_count,
        'orderby' => 'rand',
    ));
    if (!empty($related_articles)) {

        ?>

        <div class="b-related">
            <div class="b-related__header"><span><?php echo apply_filters( 'root_related_title', __('Related articles', 'root') ) ?></span></div>
            <div class="b-related__items">

                <?php foreach ($related_articles as $post) {
                    setup_postdata($post); ?>

                    <?php get_template_part('template-parts/posts/content', 'card-without-micro'); ?>

                <?php }
                wp_reset_postdata(); ?>


            </div>
        </div>

        <?php
    }

}
?>