<?php
/**
 * Child theme of Root
 * https://docs.wpshop.ru/root-child/
 *
 * @package Root
 */

/**
 * Enqueue child styles
 *
 * НЕ УДАЛЯЙТЕ ДАННЫЙ КОД
 */
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 100);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'root-style-child', get_stylesheet_uri(), array( 'root-style' )  );
}

/**
 * НИЖЕ ВЫ МОЖЕТЕ ДОБАВИТЬ ЛЮБОЙ СВОЙ КОД
 */

//ДОБАВЛЕМ МЕТКИ СТРАНИЦАМ
function true_apply_tags_for_pages(){
    add_meta_box( 'tagsdiv-post_tag', 'Теги', 'post_tags_meta_box', 'page', 'side', 'normal' ); // сначала добавляем метабокс меток
    register_taxonomy_for_object_type('post_tag', 'page'); // затем включаем их поддержку страницами wp
}

add_action('admin_init','true_apply_tags_for_pages');

function true_expanded_request_post_tags($q) {
    if (isset($q['tag'])) // если в запросе присутствует параметр метки
        $q['post_type'] = array('post', 'page');
    return $q;
}

add_filter('request', 'true_expanded_request_post_tags');
//КОНЕЦ ДОБАВЛЕМ МЕТКИ СТРАНИЦАМ