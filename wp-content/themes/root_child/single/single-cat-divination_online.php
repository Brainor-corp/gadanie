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

get_header();

$is_show_thumb = ( 'yes' == root_get_option( 'structure_single_thumb' ) ? true : false );

$thumb_hide       = 'checked' == get_post_meta( $post->ID, 'thumb_hide', true );
$breadcrumbs_hide = 'checked' == get_post_meta( $post->ID, 'breadcrumbs_hide', true );
$h1_hide          = 'checked' == get_post_meta( $post->ID, 'h1_hide', true );
$comments_hide    = 'checked' == get_post_meta( $post->ID, 'comments_hide', true );
?>

<?php while ( have_posts() ) : the_post(); ?>

<div itemscope itemtype="http://schema.org/Article">

    <?php
        $big_thumbnail_image = false;

        if ( 'checked' == get_post_meta( $post->ID, 'big_thumbnail_image', true ) ) {
            $big_thumbnail_image = true;
        }
    ?>

    <?php if ( $big_thumbnail_image ): ?>

        <?php $thumb = get_the_post_thumbnail( $post->ID, 'full', array('itemprop'=>'image') ); if (!empty($thumb) && $is_show_thumb && ! $thumb_hide ): ?>

            <div class="entry-image entry-image--big">
                <?php echo $thumb ?>

                <div class="entry-image__title">
                    <?php if ( ! $breadcrumbs_hide ) get_template_part( 'template-parts/boxes/breadcrumbs' ); ?>

                    <?php if ( ! $h1_hide ) { ?>
                        <?php do_action( 'root_single_before_title' ); ?>
                        <h1 itemprop="headline"><?php the_title() ?></h1>
                        <?php do_action( 'root_single_after_title' ); ?>
                    <?php } ?>

                    <?php if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php get_template_part( 'template-parts/post', 'meta' ) ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="entry-image entry-image--big entry-image--no-thumb">

                <div class="entry-image__title">
                    <?php if ( ! $breadcrumbs_hide ) get_template_part( 'template-parts/boxes/breadcrumbs' ); ?>

                    <?php if ( ! $h1_hide ) { ?>
                        <?php do_action( 'root_single_before_title' ); ?>
                        <h1 itemprop="headline"><?php the_title() ?></h1>
                        <?php do_action( 'root_single_after_title' ); ?>
                    <?php } ?>

                    <?php if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php get_template_part( 'template-parts/post', 'meta' ) ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </div>
            </div>
        <?php endif;?>

    <?php endif;?>

	<div id="primary" class="content-area divination-content-area">

		<main id="main" class="site-main">

            <?php
                if ( ! $big_thumbnail_image && ! $breadcrumbs_hide ) get_template_part( 'template-parts/boxes/breadcrumbs' );
            ?>

            <?php
                $imageClass = 'divination-single-thumb'
            ?>

			<?php

				get_template_part( 'template-parts/content', 'single-divination' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( root_get_option( 'structure_single_comments' ) == 'yes' && ! $comments_hide ) {
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				}


			?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- micro -->

<?php endwhile; ?>

<?php
//if ( root_get_option( 'structure_single_sidebar' ) != 'none' && 'checked' != get_post_meta( $post->ID, 'sidebar_hide', true ) ) {
//    get_sidebar();
//}
get_footer();
