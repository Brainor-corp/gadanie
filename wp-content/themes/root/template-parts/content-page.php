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
 * Template part for displaying page content in page.php.
 *
 * @package Root
 */

$is_show_social         = 'yes' == root_get_option( 'structure_page_social' );
$is_show_thumb          = 'yes' == root_get_option( 'structure_page_thumb' );
$is_show_social_bottom  = 'yes' == root_get_option( 'structure_page_social_bottom' );

$h1_hide                = 'checked' == get_post_meta( $post->ID, 'h1_hide', true );
$thumb_hide             = 'checked' == get_post_meta( $post->ID, 'thumb_hide', true );
$share_top_hide         = 'checked' == get_post_meta( $post->ID, 'share_top_hide', true );
$share_bottom_hide      = 'checked' == get_post_meta( $post->ID, 'share_bottom_hide', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! $h1_hide ) { ?>
    <header class="entry-header">
        <?php do_action( 'root_page_before_title' ); ?>
        <?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
        <?php do_action( 'root_page_after_title' ); ?>
    </header><!-- .entry-header -->
    <?php } ?>

    <?php
        if ( $is_show_social && ! $share_top_hide ) {
            echo '<div class="entry-meta"><span class="b-share b-share--small">';
            get_template_part( 'template-parts/social', 'buttons' );
            echo '</span></div>';
        }
    ?>

    <?php if ( ! $thumb_hide ) { ?>
        <?php $thumb = get_the_post_thumbnail( $post->ID, 'full', array('itemprop'=>'image') ); if ( ! empty($thumb) && $is_show_thumb ): ?>
            <div class="entry-image">
                <?php echo $thumb ?>
            </div>
        <?php else: ?>
            <div class="page-separator"></div>
        <?php endif; ?>
    <?php } ?>


    <div class="entry-content" itemprop="articleBody">
        <?php
            do_action( 'root_page_before_the_content' );
            the_content();
            do_action( 'root_page_after_the_content' );

            wp_link_pages( array(
                'before'        => '<div class="page-links">' . esc_html__( 'Pages:', 'root' ),
                'after'         => '</div>',
                'link_before'   => '<span class="page-links__item">',
                'link_after'    => '</span>',
            ) );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->


<?php if ( $is_show_social_bottom && ! $share_bottom_hide ) { ?>

    <div class="b-share b-share--post">
        <?php if ( apply_filters( 'root_social_share_title_show', true ) ) : ?>
            <div class="b-share__title"><?php echo apply_filters( 'root_social_share_title', __('Please share to your friends:', 'root') ) ?></div>
        <?php endif; ?>

        <?php get_template_part( 'template-parts/social', 'buttons' ) ?>
    </div>

<?php } ?>

<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>" content="<?php the_title(); ?>">
<meta itemprop="dateModified" content="<?php the_modified_time('Y-m-d')?>">
<meta itemprop="datePublished" content="<?php the_time('c') ?>">
<meta itemprop="author" content="<?php the_author() ?>">
<?php do_action( 'root_content_card_meta' ); ?>


<?php
    if ( 'checked' != get_post_meta( $post->ID, 'related_posts_hide', true ) ) {
        do_action( 'root_page_before_related' );
        get_template_part( 'template-parts/related', 'posts-page' );
        do_action( 'root_page_after_related' );
    }
?>
