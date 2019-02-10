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

//КАСТОМНЫЙ ШАБЛОН ДЛЯ ЗАПИСИ
/**
 * Определим константу, которая будет хранить путь к папке single
 */
define( 'SINGLE_PATH', get_stylesheet_directory() . '/single' );

/**
 * Добавим фильтр, который будет запускать функцию подбора шаблонов
 */
add_filter( 'single_template', 'my_single_template' );

/**
 * Функция для подбора шаблона
 */
function my_single_template( $single ) {
    global $wp_query, $post;

    /**
     * Проверяем наличие шаблонов по ID поста.
     * Формат имени файла: single-ID.php
     */
    if ( file_exists( SINGLE_PATH . '/single-' . $post->ID . '.php' ) ) {
        return SINGLE_PATH . '/single-' . $post->ID . '.php';
    }

    /**
     * Проверяем наличие шаблонов для категорий, ищем по ID категории или слагу
     * Формат имени файла: single-cat-SLUG.php или single-cat-ID.php
     */
    foreach ( (array) get_the_category() as $cat ) :

        if ( file_exists( SINGLE_PATH . '/single-cat-' . $cat->slug . '.php' ) ) {

            return SINGLE_PATH . '/single-cat-' . $cat->slug . '.php';
        } elseif ( file_exists( SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php' ) ) {
            return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';
        }

    endforeach;

    /**
     * Проверяем наличие шаблонов для тэгов, ищем по ID тэга или слагу
     * Формат имени файла: single-tag-SLUG.php или single-tag-ID.php
     */
    $wp_query->in_the_loop = true;
    foreach ( (array) get_the_tags() as $tag ) :

        if ( file_exists( SINGLE_PATH . '/single-tag-' . $tag->slug . '.php' ) ) {
            return SINGLE_PATH . '/single-tag-' . $tag->slug . '.php';
        } elseif ( file_exists( SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php' ) ) {
            return SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php';
        }

    endforeach;
    $wp_query->in_the_loop = false;

    /**
     * Если ничего не найдено открываем стандартный single.php
     */
    if ( file_exists( SINGLE_PATH . '/single.php' ) ) {
        return SINGLE_PATH . '/single.php';
    }

    return $single;
}
//КАСТОМНЫЙ ШАБЛОН ДЛЯ ЗАПИСИ == END