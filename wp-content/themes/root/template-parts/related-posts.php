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

$related_count_mod = root_get_option( 'structure_single_related' );
$related_yarpp_enabled = apply_filters( 'root_yarpp_enabled', false );

if ( ! empty( $related_count_mod  ) && ! $related_yarpp_enabled ) {

    $related_count = 6;
    if ( is_numeric($related_count_mod) && $related_count_mod > -1 ) {
        if ( $related_count_mod > 50 ) $related_count_mod = 50;
        $related_count = $related_count_mod;
    }

    // подготавливаем категории
    $category_ids = array();
    $categories = get_the_category($post->ID);
    if ( $categories ) {
        foreach( $categories as $_category ) {
            $category_ids[] = $_category->term_taxonomy_id;
        }
    }

    // делаем первый запрос
    $related_articles = get_posts(array(
        'category__in'      => $category_ids,
        'posts_per_page'    => $related_count,
        //'orderby'           => 'rand',
        'post__not_in'      => array($post->ID),
    ));

    // если не хватило, добираем рандом
    if ( count($related_articles) < $related_count ) {

        // сколько осталось постов
        $delta = $related_count - count($related_articles);

        // убираем текущий пост + уже выведенные
        $post__not_in = array( $post->ID );
        foreach ( $related_articles as $article ) {
            $post__not_in[] = $article->ID;
        }

        $related_articles_second = get_posts(array(
            'posts_per_page'    => $delta,
            'orderby'           => 'rand',
            'post__not_in'      => $post__not_in,
        ));

        // если все ок, объединяем
        if ( ! empty( $related_articles_second ) ) $related_articles = array_merge( $related_articles, $related_articles_second );
    }

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

} else {

    /**
     * If yarpp enabled
     */
    if ( function_exists( 'related_posts' ) && $related_yarpp_enabled ) {
        related_posts();
    }

}