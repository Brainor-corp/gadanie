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
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Root
 */

global $big_thumbnail_image;

$is_show_thumb          = 'yes' == root_get_option( 'structure_single_thumb' );
$is_show_excerpt        = 'yes' == root_get_option( 'structure_single_excerpt' );
$is_show_date           = 'yes' == root_get_option( 'structure_single_date' );
$is_show_comments_count = 'yes' == root_get_option( 'structure_single_comments_count' );
$is_show_author         = 'yes' == root_get_option( 'structure_single_author' );
$is_show_views          = 'yes' == root_get_option( 'structure_single_views' );
$is_show_tags           = 'yes' == root_get_option( 'structure_single_tags' );
$is_show_social_bottom  = 'yes' == root_get_option( 'structure_single_social_bottom' );

$h1_hide                = 'checked' == get_post_meta( $post->ID, 'h1_hide', true );
$thumb_hide             = 'checked' == get_post_meta( $post->ID, 'thumb_hide', true );
$share_bottom_hide      = 'checked' == get_post_meta( $post->ID, 'share_bottom_hide', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! $big_thumbnail_image ): ?>

        <header class="entry-header">
            <?php if ( ! $h1_hide ) { ?>
                <?php do_action( 'root_single_before_title' ); ?>
                <?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
                <?php do_action( 'root_single_after_title' ); ?>
            <?php } ?>

            <?php
                $excerpt = get_the_excerpt();
                if ( has_excerpt() && $is_show_excerpt ) {
                    do_action( 'root_single_before_excerpt' );
                    echo '<div class="entry-excerpt">' . $excerpt . '</div>';
                    do_action( 'root_single_after_excerpt' );
                }
            ?>

            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php get_template_part( 'template-parts/post', 'meta' ) ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->


        <?php if ( ! $thumb_hide ) { ?>
            <?php $thumb = get_the_post_thumbnail( $post->ID, 'full', array('itemprop'=>'image') ); if ( ! empty($thumb) && $is_show_thumb ): ?>
                <div class="entry-image">
                    <?php echo $thumb ?>
                </div>
            <?php else: ?>
                <div class="page-separator"></div>
            <?php endif; ?>
        <?php } ?>

    <?php else: ?>

        <?php
        $excerpt = get_the_excerpt();
        if ( has_excerpt() && $is_show_excerpt ) {
            do_action( 'root_single_before_excerpt' );
            echo '<div class="entry-excerpt">' . $excerpt . '</div>';
            do_action( 'root_single_after_excerpt' );
        }
        ?>

    <?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php

            do_action( 'root_single_before_the_content' );
			the_content();
            do_action( 'root_single_after_the_content' );

			wp_link_pages( array(
				'before'        => '<div class="page-links">' . esc_html__( 'Pages:', 'root' ),
				'after'         => '</div>',
                'link_before'   => '<span class="page-links__item">',
                'link_after'    => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->


<?php echo root_get_option( 'code_after_content' ) ?>


<div class="entry-footer">
    <?php if ( $is_show_comments_count ) { ?>
        <span class="entry-meta__comments" title="<?php _e( 'Comments', 'root' ) ?>"><span class="fa fa-comment-o"></span> <?php echo get_comments_number() ?></span>
    <?php } ?>

    <?php if ( $is_show_views ) { ?>
        <?php if ( function_exists('the_views') ) { ?><span class="entry-meta__views" title="<?php _e( 'Views', 'root' ) ?>"><span class="fa fa-eye"></span> <?php the_views() ?></span><?php } ?>
    <?php } ?>

    <?php
    if ( $is_show_tags ) {
        $post_tags = get_the_tags();
        if ( $post_tags ) {
            foreach( $post_tags as $tag ) {
                echo '<a href="'. get_tag_link( $tag->term_id ) .'" class="entry-meta__tag">'. $tag->name . '</a> ';
            }
        }
    }
    ?>

    <?php
    $source_link = get_post_meta( $post->ID, 'source_link', true );
    $source_hide = get_post_meta( $post->ID, 'source_hide', true );

    if ( ! empty( $source_link ) ) {
        echo '<span class="entry-meta__source">';

        if ( $source_hide == 'checked' ) {
            echo '<span class="ps-link" data-uri="'. base64_encode( $source_link ) .'">' . __( 'Source', 'root' ) . '</span>';
        } else {
            echo '<a href="'. $source_link .'" target="_blank">' . __( 'Source', 'root' ) . '</a>';
        }

        echo '</span>';
    }
    ?>
</div>

<?php if ( $is_show_social_bottom && ! $share_bottom_hide ) { ?>

    <div class="b-share b-share--post">
        <?php if ( apply_filters( 'root_social_share_title_show', true ) ) : ?>
        <div class="b-share__title"><?php echo apply_filters( 'root_social_share_title', __('Like this post? Please share to your friends:', 'root') ) ?></div>
        <?php endif; ?>

        <?php do_action( 'root_single_before_social' ) ?>
        <?php get_template_part( 'template-parts/social', 'buttons' ) ?>
        <?php do_action( 'root_single_after_social' ) ?>
    </div>

<?php } ?>


<?php
if ( 'checked' != get_post_meta( $post->ID, 'related_posts_hide', true ) ) {
    do_action( 'root_single_before_related' );
    get_template_part( 'template-parts/related', 'posts' );
    do_action( 'root_single_after_related' );
}
?>


<?php if ( ! $is_show_author ) { ?>
    <meta itemprop="author" content="<?php the_author() ?>">
<?php } ?>
<?php if ( ! $is_show_date ) { ?>
    <meta itemprop="datePublished" content="<?php the_time('c') ?>"/>
<?php } ?>
<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>" content="<?php the_title(); ?>">
<meta itemprop="dateModified" content="<?php the_modified_time('Y-m-d')?>">
<meta itemprop="datePublished" content="<?php the_time('c') ?>">
<?php do_action( 'root_content_card_meta' ); ?>