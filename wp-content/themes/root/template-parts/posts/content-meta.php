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

$is_show_date       = 'yes' == root_get_option( 'structure_posts_date' );
$is_show_category   = 'yes' == root_get_option( 'structure_posts_category' );
$is_show_author     = 'yes' == root_get_option( 'structure_posts_author' );
$is_show_comments   = 'yes' == root_get_option( 'structure_posts_comments' );
$is_show_views      = 'yes' == root_get_option( 'structure_posts_views' );

?>

<?php if ( 'post' === get_post_type() && ( $is_show_date || $is_show_category || $is_show_author || $is_show_comments || $is_show_views ) ) : ?>
<div class="entry-meta">
    <?php

    if ( $is_show_date ) {
        echo '<span class="entry-date"><time itemprop="datePublished" datetime="' . get_the_time('Y-m-d') . '">' . get_the_date() . '</time></span>';
    }
    if ( $is_show_category ) {
        echo '<span class="entry-category"><span class="hidden-xs">'. __( 'Category', 'root' ) .':</span> ' . root_category() . '</span>';
    }
    if ( $is_show_author ) {
        echo '<span class="entry-author"><span class="hidden-xs">'. __( 'Author', 'root' ) .':</span> <span itemprop="author">' . get_the_author() . '</span></span>';
    }

    ?>

    <span class="entry-meta__info">
        <?php if ( $is_show_comments ) { ?>
            <span class="entry-meta__comments" title="<?php _e( 'Comments', 'root' ) ?>"><span class="fa fa-comment-o"></span> <?php echo get_comments_number() ?></span>
        <?php } ?>

        <?php if ( $is_show_views ) { ?>
            <?php if ( function_exists('the_views') ) { ?><span class="entry-meta__views" title="<?php _e( 'Views', 'root' ) ?>"><span class="fa fa-eye"></span> <?php the_views() ?></span><?php } ?>
        <?php } ?>
    </span>
</div><!-- .entry-meta -->
<?php endif; ?>
