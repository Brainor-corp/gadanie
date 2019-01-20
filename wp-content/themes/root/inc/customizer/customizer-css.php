<?php


function root_customizer_css() {

    $root_skin          = root_get_option( 'skin' );
    $bg_pattern         = root_get_option( 'bg_pattern' );

    echo '<style>';

    // Фиксированное меню
    $root_navigation_main_fixed = root_get_option( 'navigation_main_fixed' );
    if ( $root_navigation_main_fixed == 'yes' ) {
        echo '.site-navigation-fixed { width: 100%; position: fixed; left: 0; top: 0; z-index: 9999; } .admin-bar .site-navigation-fixed { top: 32px; }';
    }
    else {
        echo '.site-navigation-fixed { display: none!important; }';
    }


    /********************************************************************
     * Шапка
     *******************************************************************/

    // Поиск на мобильном
    $root_header_search_mob = root_get_option( 'header_search_mob' );
    if ( $root_header_search_mob == 'yes' ) {
        echo '@media (max-width: 991px) { .mob-search {display: block; margin-bottom: 25px;} }';
    }


    /********************************************************************
     * Структура
     *******************************************************************/

    // Нижнее меню на мобильном
    $root_navigation_footer_mob = root_get_option( 'navigation_footer_mob' );
    if ( $root_navigation_footer_mob == 'yes' ) {
        echo '@media (max-width: 991px) { .footer-navigation {display: block;} }';
    }


    /********************************************************************
     * Фон
     *******************************************************************/
    // Цвет фона
    $background_color = get_theme_mod( 'background_color', '' );
    if ( ! empty( $background_color ) && ( $background_color == 'fff' || $background_color == 'ffffff') ) {
        echo 'body { background-color: #fff;}';
    }

    // Паттерн
    if ( ! empty( $bg_pattern ) && $bg_pattern != 'no' ) {
        $pattern_url = root_get_pattern_url( $bg_pattern );
        if ( ! empty( $pattern_url ) ) echo 'body { background-image: url(' . get_bloginfo('template_url') . '/images/backgrounds/' . $pattern_url . ') }';
    }

    // фон шапки
    $header_bg = root_get_option( 'header_bg' );
    if ( ! empty( $header_bg ) ) {
        echo '@media (min-width: 768px) {';
        echo '.site-header { background-image: url("'. $header_bg .'"); }';
        echo '.site-header-inner {background: none;}';
        echo '}';
    }

    // повторение фона у шапки
    $header_bg_repeat = root_get_option( 'header_bg_repeat' );
    if ( ! empty( $header_bg_repeat ) ) {
        echo '@media (min-width: 768px) {';
        echo '.site-header { background-repeat: '. $header_bg_repeat .'; }';
        echo '}';
    }

    // расположение фона у шапки
    $header_bg_position = root_get_option( 'header_bg_position' );
    if ( ! empty( $header_bg_position ) ) {
        echo '@media (min-width: 768px) {';
        echo '.site-header { background-position: '. $header_bg_position .'; }';
        echo '}';
    }





    // отступы у шапки
    $header_padding_top = root_get_option( 'header_padding_top' );
    if ( ! empty( $header_padding_top ) && $header_padding_top > 0 ) {
        echo '@media (min-width: 768px) {';
        echo '.site-header { padding-top: '. $header_padding_top .'px; }';
        echo '}';
    }

    $header_padding_bottom = root_get_option( 'header_padding_bottom' );
    if ( ! empty( $header_padding_bottom ) && $header_padding_bottom > 0 ) {
        echo '@media (min-width: 768px) {';
        echo '.site-header { padding-bottom: '. $header_padding_bottom .'px; }';
        echo '}';
    }


    /********************************************************************
     * Цвета
     *******************************************************************/

    // Основной цвет сайта
    $root_color_main = root_get_option( 'color_main' );
    if ( ! empty( $root_color_main ) ) {
        echo '.page-separator, .pagination .current, .pagination a.page-numbers:hover, .entry-content ul > li:before, .btn, .comment-respond .form-submit input, .mob-hamburger span, .page-links__item';
        echo ' { background-color: ' . $root_color_main . ';}';
        echo '.spoiler-box, .entry-content ol li:before, .mob-hamburger, .inp:focus, .search-form__text:focus, .entry-content blockquote { border-color: ' . $root_color_main . ';}';
        echo '.entry-content blockquote:before, .spoiler-box__title:after, .sidebar-navigation .menu-item-has-children:after { color: ' . $root_color_main . ';}';

        if ( $root_skin == 'skin-1' ) {
            echo '.widget-header, .entry-footer__more { background-color: ' . $root_color_main . ';}';
        }
    }

    // Основной цвет ссылок
    $color_link = root_get_option( 'color_link' );
    if ( ! empty( $color_link ) ) {
        echo 'a, .spanlink, .comment-reply-link, .pseudo-link, .root-pseudo-link { color: ' . $color_link . ';}';
    }

    // Основной цвет ссылок при наведении
    $color_link_hover = root_get_option( 'color_link_hover' );
    if ( ! empty( $color_link_hover ) ) {
        echo 'a:hover, a:focus, a:active, .spanlink:hover, .comment-reply-link:hover, .pseudo-link:hover { color: ' . $color_link_hover . ';}';
    }

    // Основной цвет текста
    $color_text = root_get_option( 'color_text' );
    if ( ! empty( $color_text ) ) {
        echo 'body { color: ' . $color_text . ';}';
    }

    // Цвет названия сайта
    $color_logo = root_get_option( 'color_logo' );
    if ( ! empty( $color_logo ) ) {
        echo '.site-title, .site-title a { color: ' . $color_logo . ';}';
    }

    // Цвет описания сайта
    $color_description = root_get_option( 'color_description' );
    if ( ! empty( $color_description ) ) {
        echo '.site-description, .site-description a { color: ' . $color_description . ';}';
    }

    // Фоновый цвет меню
    $color_menu_bg = root_get_option( 'color_menu_bg' );
    if ( ! empty( $color_menu_bg ) ) {
        echo '.main-navigation, .footer-navigation, .main-navigation ul li .sub-menu, .footer-navigation ul li .sub-menu { background-color: ' . $color_menu_bg . ';}';
    }

    // Цвет ссылок в меню
    $color_menu = root_get_option( 'color_menu' );
    if ( ! empty( $color_menu ) ) {
        echo '.main-navigation ul li a, .main-navigation ul li .removed-link, .footer-navigation ul li a, .footer-navigation ul li .removed-link { color: ' . $color_menu . ';}';
    }


    /********************************************************************
     * Типографика
     *******************************************************************/
    $root_main_fonts            = root_get_option( 'typography_family' );
    $root_main_fonts_headers    = root_get_option( 'typography_headers_family' );

    global $fonts;
    $fonts_css = array();
    foreach ( $fonts as $key => $val ) {
        $fonts_css[$key] = $val['family'];
    }

    if ( isset( $fonts_css[$root_main_fonts] )  ) {
        echo 'body { font-family: '. $fonts_css[$root_main_fonts] .'; }';
    }

    if ( isset( $fonts_css[$root_main_fonts_headers] )  ) {
        echo '.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, ';
        echo '.entry-image__title h1, .entry-title ';
        echo '{ font-family: '. $fonts_css[$root_main_fonts_headers] .'; }';
    }

    // Размер шрифта
    $root_typography_font_size = root_get_option( 'typography_font_size' );
    if ( ! empty( $root_typography_font_size ) ) {
        echo '@media (min-width: 576px) { body { font-size: ' . $root_typography_font_size . 'px;} }';
    }

    // Межстрочный интервал
    $root_typography_line_height = root_get_option( 'typography_line_height');
    if ( ! empty( $root_typography_line_height ) ) {
        echo '@media (min-width: 576px) { body { line-height: ' . $root_typography_line_height . ';} }';
    }


    /********************************************************************
     * Сайдбар
     *******************************************************************/

    // Сайдбар на мобильном
    $root_structure_sidebar_mob = root_get_option( 'structure_sidebar_mob' );
    if ( $root_structure_sidebar_mob == 'yes' ) {
        echo '@media (max-width: 991px) { .widget-area {display: block; float: none !important; padding: 15px 20px;} }';
    }

    /********************************************************************
     * Стрелка вверх
     *******************************************************************/

    // Фоновый цвет стрелки вверх
    $root_color_arrow_bg = root_get_option( 'structure_arrow_bg' );
    if ( ! empty( $root_color_arrow_bg ) ) {
        echo '.scrolltop { background-color: ' . $root_color_arrow_bg . ';}';
    }

    // Цвет иконки стрелки вверх
    $root_color_arrow = root_get_option( 'structure_arrow_color' );
    if ( ! empty( $root_color_arrow ) ) {
        echo '.scrolltop:after { color: ' . $root_color_arrow . ';}';
    }

    // Ширина стрелки вверх
    $root_arrow_width = root_get_option( 'structure_arrow_width' );
    if ( ! empty( $root_arrow_width ) ) {
        echo '.scrolltop { width: ' . $root_arrow_width . 'px;}';
    }

    // Высота стрелки вверх
    $root_arrow_height = root_get_option( 'structure_arrow_height' );
    if ( ! empty( $root_arrow_height ) ) {
        echo '.scrolltop { height: ' . $root_arrow_height . 'px;}';
    }

    // Выбор иконки стрелки вверх
    $root_icon = root_get_option( 'structure_arrow_icon' );
    if ( ! empty( $root_icon ) ) {
        echo '.scrolltop:after { content: "'. $root_icon .'"; }';
    }

    // Стрелка вверх на мобильном
    $root_structure_arrow_mob = root_get_option( 'structure_arrow_mob' );
    if ( $root_structure_arrow_mob == 'no' ) {
        echo '@media (max-width: 767px) { .scrolltop { display: none !important;} }';
    }



    echo '</style>';
}
$customizer_styles_position = apply_filters( 'root_customizer_styles_position', 'wp_head' );
$customizer_styles_priority = apply_filters( 'root_customizer_styles_priority', 10 );
add_action( $customizer_styles_position, 'root_customizer_css', $customizer_styles_priority );