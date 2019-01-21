<?php
/*
Plugin Name: Brainor Divination
Description: Плагин для гадания
Version: 1.0
Author: Brainor
Author URI: http://brainor.ru/
Plugin URI: http://brainor.ru/
*/
define('BR_DIVINATION_DIR', plugin_dir_path(__FILE__));
define('BR_DIVINATION_URL', plugin_dir_url(__FILE__));
function br_divination_load(){
 
    if(is_admin()) // подключаем файлы администратора, только если он авторизован
        require_once(BR_DIVINATION_DIR.'includes/admin/menu.php');
    add_action('admin_enqueue_scripts', 'add_br_divination_scripts'); // приклеем ф-ю на добавление скриптов в футер
    if (!function_exists('add_br_divination_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
        function add_br_divination_scripts() { // добавление скриптов
            wp_enqueue_script('bootstrap', BR_DIVINATION_URL.'assets/js/bootstrap.min.js','','',true); // бутстрап
        }
    }
    add_action('admin_print_styles', 'add_br_divination_styles'); // приклеем ф-ю на добавление скриптов в футер
    if (!function_exists('add_br_divination_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
        function add_br_divination_styles() { // добавление скриптов

        }
    }
}
br_divination_load();

register_activation_hook(__FILE__, 'br_divination_activation');
register_deactivation_hook(__FILE__, 'br_divination_deactivation');
 
function br_divination_activation() {
 
    // действие при активации
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для работы с БД
    $table_name = $wpdb->get_blog_prefix() . 'br_divinations';
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
    if($wpdb->get_var("SHOW TABLES LIKE ".$table_name."") != $table_name) { # если таблица настроек плагина еще не создана - создаём

        $sql = "CREATE TABLE {$table_name} (
            `id` BIGINT (20) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR (512) NOT NULL,
            `slug` VARCHAR (512) NOT NULL,
            `description` TEXT,
            `thumb` VARCHAR (1024),
            UNIQUE KEY id (id)
        ){$charset_collate}";


        dbDelta($sql); # . создаём новую таблицу
    }

    //Добавляем гадания в базу
    $values = array();
    $place_holders = array( '%s', '%s');

    $values[] = ['name'=>'Персональная карта года', 'slug'=>'personal-card-of-the-year'];

    foreach ($values as $value){
        $wpdb->insert(
            $table_name,
            array(
                'name' => $value['name'],
                'slug' => $value['slug']
            ),
            $place_holders
        );
    }
    //КОНЕЦ Добавляем гадания в базу

    $table_name = $wpdb->get_blog_prefix() . 'br_divination_elements';
    if($wpdb->get_var("SHOW TABLES LIKE ".$table_name."") != $table_name) { # если таблица настроек плагина еще не создана - создаём

        $sql = "CREATE TABLE {$table_name} (
            `id` BIGINT (20) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR (512) NOT NULL,
            `class` VARCHAR (32),
            `divination_id` BIGINT (20),
            `description` TEXT,
            `thumb` VARCHAR (1024),
            UNIQUE KEY id (id)
        ){$charset_collate}";


        dbDelta($sql); # . создаём новую таблицу
    }

    $table_name = $wpdb->get_blog_prefix() . 'br_divination_elements_pivot';
    if($wpdb->get_var("SHOW TABLES LIKE ".$table_name."") != $table_name) { # если таблица настроек плагина еще не создана - создаём

        $sql = "CREATE TABLE {$table_name} (
            `id` BIGINT (20) NOT NULL AUTO_INCREMENT,
            `divination_id` BIGINT (20),
            `divination_element_id` BIGINT (20),
            `description` TEXT,
            `thumb` VARCHAR (1024),
            UNIQUE KEY id (id)
        ){$charset_collate}";


        dbDelta($sql); # . создаём новую таблицу
    }

	// регистрируем действие при удалении
	register_uninstall_hook(__FILE__, 'br_divination_uninstall');
}
 
function br_divination_deactivation() {
    // при деактивации
}

function br_divination_uninstall(){
 
    //действие при удалении
}
require_once(BR_DIVINATION_DIR.'includes/functions.php');