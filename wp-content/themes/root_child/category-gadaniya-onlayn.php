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

get_header(); ?>

    <div id="primary" class="content-area divination-content-area">
        <main id="main" class="site-main">

            <?php get_template_part( 'template-parts/boxes/breadcrumbs' ) ?>

                <header class="page-header">
                    <h1 class="page-title"><?php echo get_the_archive_title(); ?></h1>

                </header><!-- .page-header -->
                <div class="page-separator" wfd-id="419"></div>
                <div><?php echo term_description(); ?></div>
                <?php get_template_part( 'template-parts/list', 'gadaniya' ) ?>
            <?php get_template_part( 'template-parts/related', 'posts-page' ); ?>
        </main><!-- #main -->

    </div><!-- #primary -->

<?php

//if ( root_get_option( 'structure_archive_sidebar' ) != 'none' ) get_sidebar();

get_footer();
