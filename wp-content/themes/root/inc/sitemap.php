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

/* ==========================================================================
   HTML Sitemap without plugins
   by  https://wpshop.ru/
   ========================================================================== */
function wpshop_sitemap_child( $category_ID = 0 ) {
    $out = '';

    $next = get_categories('orderby=name&order=ASC&parent=' . $category_ID);

    if ( $next ) {
        foreach ( $next as $cat ) {

            $out .= '<li class="sitemap-list__header"><h3><a href="' . get_category_link($cat->cat_ID) . '" target="_blank">' . $cat->name . '</a></h3></li>' . PHP_EOL;

            $out .= '<li class="sitemap-list__block"><ul>' . PHP_EOL;

            $posts = get_posts( array(
                'numberposts'     => -1,
                'category__in'    => array($cat->cat_ID),
                'orderby'         => 'post_date',
                'order'           => 'DESC',
                'exclude'         => ''
            ) );
            if (!empty($posts)) {
                foreach($posts as $post){

                    $out .= '  <li><a href="' . get_the_permalink($post->ID) . '" target="_blank">'. get_the_title($post->ID) . '</a></li>' . PHP_EOL;

                }
            }

            $out .= wpshop_sitemap_child($cat->cat_ID);

            $out .= '</ul></li>' . PHP_EOL;

        }
    }

    return $out;

}


function wpshop_pages_sitemap( $page_id = 0 ) {
    global $post;
    $out = '';

    $pages = get_pages(array(
        'exclude'   => array( $post->ID ),
        'parent'    => $page_id,
    ));
    if ( ! empty( $pages ) ) {
        $out .= '<ul>' . PHP_EOL;
        foreach ( $pages as $page ) {
            $out .= '<li><a href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';

                $subpages = wpshop_pages_sitemap( $page->ID );
                if ( ! empty( $subpages ) ) $out .= $subpages;

            $out .= '</li>';
        }
        $out .= '</ul>' . PHP_EOL;
    }

    return $out;
}

function wpshopbiz_sitemap( $atts ) {

    global $post;

    $out = '<div class="sitemap-list">' . PHP_EOL;

    $out .= '<ul>' . PHP_EOL;
    $out .= wpshop_sitemap_child();
    $out .= '</ul>' . PHP_EOL;

    if ( apply_filters( 'root_sitemap_page_show', true ) ) :
        $out .= '<h3>Страницы</h3>' . PHP_EOL;
        $out .= wpshop_pages_sitemap();
    endif;

    $out .= '</div>';

    return $out;
}

add_shortcode( 'htmlsitemap', 'wpshopbiz_sitemap' );
