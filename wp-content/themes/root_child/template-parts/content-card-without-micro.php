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
 * Template part for displaying posts.
 *
 * @package Root
 */

$is_show_category   = 'yes' == root_get_option( 'structure_posts_category' );
$is_show_excerpt    = 'yes' == root_get_option( 'structure_posts_excerpt' );
$is_show_comments   = 'yes' == root_get_option( 'structure_posts_comments' );
$is_show_views      = 'yes' == root_get_option( 'structure_posts_views' );

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

    <div class="post-card__image">
        <a href="<?php the_permalink() ?>">
            <?php $thumb = get_the_post_thumbnail($post->ID, 'thumb-wide'); if (!empty($thumb)): ?>
                <?php echo $thumb ?>
            <?php endif ?>


            <?php if ( 'post' === get_post_type() && ( $is_show_category || $is_show_comments || $is_show_views ) ) : ?>

                <?php if ( empty($thumb) ) echo '<div class="thumb-wide"></div>'; ?>

                <div class="entry-meta">
                    <?php
                    if ( $is_show_category ) {
                        echo '<span class="entry-category">' . root_category( $post->ID, '', true, false ) . '</span>';
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
        </a>
    </div>


	<header class="entry-header">
		<?php the_title( '<div class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></div>' ) ?>
	</header><!-- .entry-header -->

    <?php if ( $is_show_excerpt ) { ?>
	<div class="post-card__content">
		<?php
            add_filter('get_the_excerpt', 'remove_the_content_add_ad_filter', 9);
			echo do_excerpt( get_the_excerpt(), 14 );
            add_filter('get_the_excerpt', 'add_the_content_add_ad_filter', 11);
		?>
	</div><!-- .entry-content -->
    <?php } ?>

</div><!-- #post-## -->
