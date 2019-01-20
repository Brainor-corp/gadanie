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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

            <?php //if ( is_customize_preview() ) { echo '<div class="customizer-add-block">Добавить блок</div>'; } ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

            <?php if ( 'top' == root_get_option( 'structure_home_position' ) ) get_template_part( 'template-parts/home', 'content' ); ?>

			<?php get_template_part( 'template-parts/layout/archive', root_get_option( 'structure_home_posts' ) ); ?>

            <?php the_posts_pagination(); ?>

            <?php if ( 'bottom' == root_get_option( 'structure_home_position' ) ) get_template_part( 'template-parts/home', 'content' ); ?>


        <?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

if ( root_get_option( 'structure_home_sidebar' ) != 'none' ) get_sidebar();

get_footer();
