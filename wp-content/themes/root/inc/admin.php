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

$theme_name       = 'root';
$api_url          = 'https://wpshop.ru/api.php';
$ver              = $theme_version;

// fix old version with check_license() in header.php
$root_check_license_function = apply_filters( 'root_check_license_function', true );
if ( ! function_exists( 'check_license' ) && $root_check_license_function ):
    function check_license() {
        root_check_license();
    }
endif;

function root_check_license() {

    $license_verify = get_option('license_root_verify');
    $license_error  = get_option('license_root_error');

    if (!empty($license_verify) && empty($license_error)) {
        //TODO: проверка на истечение лицензии
    } else {
        exit('<p style="text-align: center;font-size:20px;">Необходимо активировать лицензию в разделе Настройки - Root</p>');
    }
}


/**
 * Создаем страницу настроек темы
 */
add_action('admin_menu', 'revelation_admin_menu');
function revelation_admin_menu(){
    add_options_page( 'Root', 'Root', 'manage_options', 'revelation', 'revelation_settings_display' );
}

function revelation_settings_display(){
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>

        <form action="options.php" method="POST">
            <?php
            settings_fields( 'option_group' );     // скрытые защитные поля
            do_settings_sections( 'revelation_page' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
            submit_button();
            ?>
        </form>
    </div>
    <?php
}



/**
 * Регистрируем настройки.
 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
 */
add_action('admin_init', 'plugin_settings');
function plugin_settings(){
    // параметры: $option_group, $option_name, $sanitize_callback
    register_setting( 'option_group', 'revelation_options', 'sanitize_callback' );

    // параметры: $id, $title, $callback, $page
    add_settings_section( 'section_id', 'Основные настройки', '', 'revelation_page' );

    // параметры: $id, $title, $callback, $page, $section, $args
    add_settings_field('field_license', 'Лицензия', 'field_license_display', 'revelation_page', 'section_id' );
}



function field_license_display(){
    $val = get_option('revelation_options');
    if ( isset($val['license']) ) {
        $val = $val['license'];
    } else {
        $val = '';
    }

    $license_hide = get_option('revelation_options');
    if ( isset($license_hide['license_hide']) ) {
        $license_hide = $license_hide['license_hide'];
    } else {
        $license_hide = '';
    }

    $license_root_error = get_option('license_root_error');
    if ( ! $license_root_error ) $license_root_error = '';
    ?>
    <?php if ( ! empty( $license_root_error ) ) echo '<p><strong>' . $license_root_error . '</strong></p>'; ?>

    <?php if ( $license_hide != 'yes' ): ?>
        <input type="text" name="revelation_options[license]" class="regular-text" value="<?php echo esc_attr( $val ) ?>" />
        <p class="description">Чтобы активировать тему, необходимо указать лицензионный ключ, который пришел на почту после покупки <a href="https://wpshop.ru/themes/root?utm_source=admin&utm_medium=license&utm_campaign=root" target="_blank">темы</a>.</p>
        <br>

        <?php if ( empty( $license_root_error ) && ! empty( $val ) ) : ?>
        <label><input type="checkbox" name="revelation_options[license_hide]" value="yes"<?php if ($license_hide == 'yes') echo ' checked' ?> /> Спрятать лицензионный ключ</label>
        <?php endif; ?>

    <?php else: ?>

        <p class="description">Лицензионный ключ можно узнать в личном кабинете на сайте <a href="https://wpshop.ru" target="_blank">https://wpshop.ru</a></p>
        <br>

    <?php endif; ?>

    <h3>&rarr; <a href="https://docs.wpshop.ru/themes/root/?utm_source=admin" target="_blank">Документация по теме, вопросы и ответы</a></h3>
    <?php
}


## Очистка данных
function sanitize_callback( $options ){

    global $api_url;
    global $ver;

    if ( empty( $options['license'] ) ) {

        $revelation_options = get_option('revelation_options');
        if ( ! empty($revelation_options['license']) && $revelation_options['license_hide'] == 'yes' ) {
            $options['license'] = $revelation_options['license'];
            $options['license_hide'] = $revelation_options['license_hide'];
        }

    }

    foreach( $options as $name => & $val ){

        if ( $name == 'license' ) {
            $license = $val;

            $api_params = array(
                'action'    => 'activate_license',
                'license'   => $license,
                'item_name' => urlencode( 'root' ),
                'version'   => $ver,
                'type'      => 'theme',
                'url'       => home_url(),
            );

            // Call the custom API.
            $response = wp_remote_post( $api_url, array(
                'timeout'   => 15,
                'sslverify' => false,
                'body'      => $api_params
            ) );

            if ( is_wp_error( $response ) ) {
                $api_url = str_replace( "https", "http", $api_url );

                $response = wp_remote_post( $api_url, array(
                    'timeout'   => 15,
                    'sslverify' => false,
                    'body'      => $api_params
                ) );
            }

            // make sure the response came back okay
            if ( is_wp_error( $response ) )
                return false;

            // decode the license data
            $license_data = wp_remote_retrieve_body( $response );

            if (mb_substr($license_data, 0, 2) == 'ok') {
                update_option( 'license_root_verify', time() + (WEEK_IN_SECONDS * 4) );
                delete_option( 'license_root_error' );
            } else {
                update_option( 'license_root_error', $license_data );
            }

            // $license_data->license will be either "active" or "inactive"
            //update_option( 'license_verify', $license_data->license );
        }
    }


    return $options;
}
