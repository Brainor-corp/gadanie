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

/**
 * Button wpshop.biz
 */
add_shortcode( 'button', 'shortcode_button' );

function shortcode_button( $atts, $content ) {
    extract( shortcode_atts( array(
        'href'              => '',
        'color'             => '',
        'background_color'  => '',
        'size'              => '',
    ), $atts ) );

    $href = esc_attr( $href );
    $color = esc_attr( $color );
    $background_color = esc_attr( $background_color );
    $size = esc_attr( $size );

    $out  = '';
    $out .= '<div class="btn-box">';
    $out .= '<a href="' . $href . '" class="btn btn-size-' . $size .'" style="color:' . $color . '; background-color:' . $background_color . ';">' . $content .'</a>';
    $out .= '</div>';

    return $out;
}


/**
 * Spoiler wpshop.biz
 */
add_shortcode( 'spoiler', 'shortcode_spoiler' );

function shortcode_spoiler( $atts, $content ) {
    extract( shortcode_atts( array(
        'title'         => 'Показать скрытое содержание',
    ), $atts ) );

    $title = esc_attr( $title );

    $out  = '';
    $out .= '<div class="spoiler-box">';
        $out .= '<div class="spoiler-box__title js-spoiler-box-title">' . $title . '</div>';
        $out .= '<div class="spoiler-box__body">' . $content . '</div>';
        $out .= '</div>';

    return $out;
}


/**
 * Columns
 */
add_shortcode( 'root-col-6-start', 'shortcode_wpshop_col_6_start' );
add_shortcode( 'root-col-6-end', 'shortcode_wpshop_col_6_end' );

function shortcode_wpshop_col_6_start( $atts, $content ) {
    return '<div class="root-row"><div class="root-col-6">' . shortcode_helper($content) . '</div>';
}

function shortcode_wpshop_col_6_end( $atts, $content ) {
    return '<div class="root-col-6">' . shortcode_helper($content) . '</div></div><!--.root-row-->';
}



function shortcode_helper( $content ) {
    return do_shortcode( shortcode_unautop( trim( $content ) ) );
}
