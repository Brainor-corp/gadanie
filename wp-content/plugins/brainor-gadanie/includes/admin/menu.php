<?php
/*
ПОдключение пунктов меню и страниц админки
*/
add_action('admin_menu', function(){
    $mainPage = add_menu_page( 'Гадания', 'Гадания', 'manage_categories', 'br_divination_list', 'br_divination_list_page', '', 30 );
    if ( isset($_GET['page']) ) {
        if ($_GET['page'] == 'br_divination_elements' ) {
            if (!function_exists('add_br_divination_list_page_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
                function add_br_divination_list_page_styles()
                { // добавление стилей
                    wp_enqueue_style('bs2', BR_DIVINATION_URL . 'assets/css/bootstrap.min.css'); // бутстрап;
                }

                add_action('admin_print_styles-' . $mainPage, 'add_br_divination_list_page_styles');
            }
            if (!function_exists('add_br_divination_list_page_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
                function add_br_divination_list_page_scripts()
                {
                    wp_enqueue_script('jquery_custom', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', '', '', false);
                    wp_enqueue_script('admin.divination.edit', BR_DIVINATION_URL.'assets/js/admin.divination.edit.js','','',true);
                }

                add_action('admin_enqueue_scripts', 'add_br_divination_list_page_scripts');
            }
        }
    }
    //Страница Элементов гаданий
    $page = add_submenu_page( 'br_divination_list', 'Элементы гаданий', 'Элементы гаданий', 'manage_categories', 'br_divination_elements', 'br_divination_elements_page' );
    if ( isset($_GET['page']) ) {
        if ($_GET['page'] == 'br_divination_elements' ) {
            if (!function_exists('add_br_divination_elements_page_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
                function add_br_divination_elements_page_styles()
                { // добавление стилей
                    wp_enqueue_style('bs', BR_DIVINATION_URL . 'assets/css/bootstrap.min.css'); // бутстрап
                    wp_enqueue_style('jquery-ui-css', BR_DIVINATION_URL . 'assets/css/jquery-ui.css');
                    wp_enqueue_style('sortable', BR_DIVINATION_URL . 'assets/css/sortable.css');
                }

                add_action('admin_print_styles-' . $page, 'add_br_divination_elements_page_styles');
            }
            if (!function_exists('add_br_divination_elements_page_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
                function add_br_divination_elements_page_scripts()
                { // добавление стилей
                    wp_enqueue_script('jquery_custom', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', '', '', false);
                }

                add_action('admin_enqueue_scripts', 'add_br_divination_elements_page_scripts');
            }
        }
    }
} );

function br_divination_list_page(){require_once(BR_DIVINATION_DIR.'includes/admin/list.php');}
function br_divination_elements_page(){require_once(BR_DIVINATION_DIR.'includes/admin/elements.php');}