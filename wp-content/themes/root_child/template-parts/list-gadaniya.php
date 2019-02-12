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

$tags = get_terms( array(
    'taxonomy'      => array( 'post_tag' ), // название таксономии с WP 4.5
    'orderby'       => 'description',
    'order'         => 'ASC',
    'hide_empty'    => true,
    'search'        => 'gadaniya-onlayn',
) );
    foreach ($tags as $tag):
    $related_articles = get_posts(array(
        'numberposts' => '-1',
        'orderby' => 'rand',
        'category_name' => 'gadaniya-onlayn',
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