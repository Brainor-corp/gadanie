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

$root_structure_home_h1 = root_get_option( 'structure_home_h1' );
$root_structure_home_text = root_get_option( 'structure_home_text' );

if ( ! empty($root_structure_home_h1 ) || ! empty($root_structure_home_text) || is_customize_preview() ) {

    echo '<div class="home-content">';

    if ( ! empty($root_structure_home_h1) || is_customize_preview() ) {
        echo '<h1 class="home-header">' . $root_structure_home_h1 . '</h1>';
    }
    if ( ( ! empty($root_structure_home_text) || is_customize_preview()) && ! is_paged() ) {
        echo '<div class="home-text">' . do_shortcode( $root_structure_home_text ) . '</div>';
    }

    echo '</div>';

}
