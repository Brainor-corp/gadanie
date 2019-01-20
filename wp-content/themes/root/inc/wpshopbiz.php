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
 * WPShop.biz functions
 *
 * @version 1.0.0
 * @package wpshopbiz
 * @url https://wpshop.ru/
 */

// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}




/**
 * Add widget to dashboard
 */
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
function example_dashboard_widget_function() {
    echo '<img src="' . get_template_directory_uri() . '/images/wpshopbiz.png" style="max-width:100%;height:auto;margin:40px auto;display:block;">';
    echo 'Если у Вас появились вопросы или предложения по использованию тем от <a href="https://wpshop.ru/?utm_source=admin&utm_medium=dashboard&utm_campaign=root" target="_blank">WPShop</a> - свяжитесь с нами любым доступным способом, <a href="https://wpshop.ru/support?utm_source=admin&utm_medium=dashboard&utm_campaign=" target="_blank">указанным на сайте</a>.';
}
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('example_dashboard_widget', 'Возникли вопросы по теме от WPShop?', 'example_dashboard_widget_function');
}


/**
 * Add information to footer
 */
function change_admin_footer () {
    $footer_text = array(
        'Спасибо вам за творчество с <a href="http://wordpress.org">WordPress</a>',
        'Сайт разработан <a href="https://wpshop.ru/?utm_source=admin&utm_medium=footer&utm_campaign=root" target="_blank">WPShop</a>'
    );
    return implode( ' &bull; ', $footer_text);
}

add_filter('admin_footer_text', 'change_admin_footer');



function wp_admin_bar_support() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'wp-admin-bar-support',
        'title' => '&rarr; Техническая поддержка',
        'href' => 'https://wpshop.ru/support?utm_source=admin&utm_medium=admin_bar&utm_campaign=root',
        'meta'   => array(
            'target'    => '_blank',
            'title'     => 'Техническая поддежка сайтов на WordPress',
        )
    ));
}
add_action('wp_before_admin_bar_render', 'wp_admin_bar_support');



/**
 * Beautiful price
 */
function wpshopbiz_only_mumbers($val) {
    $val = preg_replace('/[^0-9]/', '', $val);
    return $val;
}

function wpshopbiz_beauty_price($price) {
    $price = wpshopbiz_only_mumbers($price);
    if (!empty($price)) $price = number_format($price, 0, '', ' ');
    return $price;
}





/**
 * Возвращает форму слова в зависимости от колличества $number.
 *
 * @param int $number <p>число элементов</p>
 * @param array $forms <p>Формы слова для количества 1, 2 и 5, пример {носок,носка,носков}</p>
 * @return mixed
 */
function GetWordForms($number,$forms)
{
    $cases = array (2, 0, 1, 1, 1, 2);
    return $forms[ ($number%100 >4 && $number%100< 20)? 2 : $cases[min($number%10, 5)] ];
};





if ( ! function_exists( 'do_excerpt' ) ) {
    /**
     * Short excerpt
     */
    function do_excerpt($string, $word_limit)
    {
        $string = strip_tags($string);
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit)
            array_pop($words);
        $end = trim(implode(' ', $words));

        $ret = $end;
        if (count($words) > $word_limit) $ret = $ret . '...';
        return $ret;
    }
}





/**
 * Widget Classes
 *
 * Based on C.M. Kendrick Widget CSS Classes plugin
 */
class Vetteo_Widget_Classes {

    public function __construct() {
        add_action( 'init', array( $this, 'widget_css_classes_loader' ) );
        add_action( 'wp_loaded', array( $this, 'widget_css_classes_frontend_hook' ) );
    }

    function widget_css_classes_loader() {

        if ( is_admin() ) {

            add_action( 'in_widget_form', array( $this, 'extend_widget_form' ), 10, 3 );
            add_filter( 'widget_update_callback', array( $this, 'update_widget' ), 10, 2 );

        }
    }

    function widget_css_classes_frontend_hook() {
        if ( !is_admin() ) {
            add_filter( 'dynamic_sidebar_params', array( $this, 'add_widget_classes' ) );
        }
    }




    function add_widget_classes( $params ) {

        global $wp_registered_widgets, $widget_number;

        $arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
        $this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
        $widget_id              = $params[0]['widget_id'];
        $widget_obj             = $wp_registered_widgets[$widget_id];
        $widget_num             = $widget_obj['params'][0]['number'];
        $widget_css_classes     = ( get_option( 'WCSSC_options' ) ? get_option( 'WCSSC_options' ) : array() );
        $widget_opt             = null;

        // If Widget Logic plugin is enabled, use it's callback
        if ( in_array( 'widget-logic/widget_logic.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            $widget_logic_options = get_option( 'widget_logic' );
            if ( isset( $widget_logic_options['widget_logic-options-filter'] ) && 'checked' == $widget_logic_options['widget_logic-options-filter'] ) {
                $widget_opt = get_option( $widget_obj['callback_wl_redirect'][0]->option_name );
            } else {
                $widget_opt = get_option( $widget_obj['callback'][0]->option_name );
            }

            // If Widget Context plugin is enabled, use it's callback
        } elseif ( in_array( 'widget-context/widget-context.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            $callback = isset($widget_obj['callback_original_wc']) ? $widget_obj['callback_original_wc'] : null;
            $callback = !$callback && isset($widget_obj['callback']) ? $widget_obj['callback'] : null;

            if ($callback && is_array($widget_obj['callback'])) {
                $widget_opt = get_option( $callback[0]->option_name );
            }
        }

        // Default callback
        else {
            // Check if WP Page Widget is in use
            global $post;
            $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
            if ( isset( $id ) && get_post_meta( $id, '_customize_sidebars' ) ) {
                $custom_sidebarcheck = get_post_meta( $id, '_customize_sidebars' );
            }
            $_option_name = null;
            if (is_array($widget_obj['callback'])) {
                $_option_name = isset($widget_obj['callback'][0]->option_name) ? $widget_obj['callback'][0]->option_name : null;
            }

            if ($_option_name) {
                $widget_opt = get_option(
                    isset($custom_sidebarcheck[0]) && ($custom_sidebarcheck[0] == 'yes')
                        ? 'widget_' . $id . '_' . substr($_option_name, 7)
                        : $_option_name
                );
            }
        }


        // Add classes
        if ( isset( $widget_opt[$widget_num]['classes'] ) && !empty( $widget_opt[$widget_num]['classes'] ) ) {
            $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
        }

        do_action( 'widget_css_classes_add_classes', $params, $widget_id, $widget_number, $widget_opt, $widget_obj );

        return $params;
    }

    function update_widget( $instance, $new_instance ) {
        $instance['classes'] = $new_instance['classes'];
        $instance['classes-defined'] = $new_instance['classes-defined'];
        if ( is_array( $instance['classes-defined'] ) ) {
            // Merge predefined classes with input classes
            $text_classes = explode( ' ', $instance['classes'] );
            foreach ( $instance['classes-defined'] as $key => $value ) {
                if ( ! in_array( $value, $text_classes ) ) {
                    $text_classes[] = $value;
                }
            }
            $instance['classes'] = implode( ' ', $text_classes );
        }
        // Do not store predefined array in widget, no need
        unset( $instance['classes-defined'] );

        do_action( 'widget_css_classes_update', $instance, $new_instance );
        return $instance;
    }


    function extend_widget_form( $widget, $return, $instance ) {
        if ( !isset( $instance['classes'] ) ) $instance['classes'] = null;
        if ( !isset( $instance['classes-defined'] ) ) $instance['classes-defined'] = array();

        $fields = '';
        $fields .= "\t<p><label for='widget-{$widget->id_base}-{$widget->number}-classes'>".apply_filters( 'widget_css_classes_class', esc_html__( 'CSS Classes', 'widget-css-classes' ) ).":</label>
                <input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' value='{$instance['classes']}' class='widefat' /></p>\n";

        do_action( 'widget_css_classes_form', $fields, $instance );

        echo $fields;
        return $instance;
    }

}
new Vetteo_Widget_Classes;




/**
 * Single Paged class
 */
function single_paged_body_classes( $classes ) {
    global $wp_query;
    if ( is_single() && isset( $wp_query->query['page'] ) && $wp_query->query['page'] > 1 ) {
        $classes[] = 'single-paged';
    }

    return $classes;
}
add_filter( 'body_class', 'single_paged_body_classes' );


/**
 * Remove all symbols except numbers and minus
 *
 * @param $string
 *
 * @return mixed
 */
if ( ! function_exists( 'wpshop_sanitize_ids_string' ) ) {
    function wpshop_sanitize_ids_string( $string ) {

        $string = preg_replace( '/[^0-9-,]/', '', $string ); // оставляем цифры, минус, запятую
        $string = preg_replace( '/,{2,}/', ',', $string ); // удаляем две запятые и больше
        $string = preg_replace( '/-{2,}/', '-', $string ); // удаляем два и больше минуса

        return $string;
    }
}



/**
 * Substring string by length
 *
 * @param $string
 * @param int $length
 *
 * @return string
 */
if ( ! function_exists( 'wpshop_substring_by_word' ) ) {
    function wpshop_substring_by_word( $string, $length = 200, $del = ' ' ) {
        if ( mb_strlen( $string ) > $length ) {
            $search = mb_strpos( $string, $del, $length );
            if ( $search ) {
                return mb_substr( $string, 0, $search );
            }
        }
        return $string;
    }
}