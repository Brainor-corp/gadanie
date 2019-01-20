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

function root_add_featured_image_display_settings( $content, $post_id ) {
    $field_id    = 'big_thumbnail_image';
    $field_value = esc_attr( get_post_meta( $post_id, $field_id, true ) );
    $field_text  = esc_html__( 'Большая миниатюра', 'root' );
    $field_text_description  = esc_html__( 'На странице записи будет отображаться миниатюра на всю ширину сайта. Рекомендуемый размер 1170x500', 'root' );
    $field_text_before  = esc_html__( 'Рекомендуемый размер 770x330', 'root' );
    $field_state = checked( $field_value, 'checked', false);

    $field_label = sprintf(
        '<p><label for="%1$s"><input type="checkbox" name="%1$s" id="%1$s" value="%2$s" %3$s> %4$s</label></p><p class="howto">%5$s</p>',
        $field_id, $field_value, $field_state, $field_text, $field_text_description
    );

    $content = '<p class="howto">'. $field_text_before . '</p>' . $content . $field_label;

    return $content;
}
add_filter( 'admin_post_thumbnail_html', 'root_add_featured_image_display_settings', 10, 2 );


function root_save_featured_image_display_settings( $post_ID, $post, $update ) {
    $field_id    = 'big_thumbnail_image';
    $field_value = isset( $_REQUEST[ $field_id ] ) ? 'checked' : 0;

    update_post_meta( $post_ID, $field_id, $field_value );
}
add_action( 'save_post', 'root_save_featured_image_display_settings', 10, 3 );