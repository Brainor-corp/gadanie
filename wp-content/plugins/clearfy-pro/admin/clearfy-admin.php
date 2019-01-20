<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      0.9.0
 * @package    Clearfy
 * @author     WPShop.biz <support@wpshop.biz>
 * @build      11387
 */
class Clearfy_Plugin_Admin {
    /**
     * Option name
     *
     * @var string
     */
    protected $option_name = 'clearfy_option';

    /**
     * All options
     *
     * @var mixed|void
     */
    protected $options;

    /**
     * Api url
     *
     * @var string
     */
    protected $api_url;

    /**
     * Plugin path
     *
     * @var string
     */
    protected $plugin_path;

    /**
     * Link to settings page
     *
     * @var string
     */
    protected $settings_link;

    /**
     * Settings migrate
     *
     * @var
     */
    protected $settings_migrate;

    /**
     * Plugin Options
     *
     * @var Clearfy_Plugin_Options
     */
    protected $plugin_options;


    /**
     * Clearfy_Plugin_Admin constructor.
     *
     * @param Clearfy_Plugin_Options $plugin_options
     */
    public function __construct( Clearfy_Plugin_Options $plugin_options ) {

        $this->plugin_options = $plugin_options;

        $this->settings_link    = admin_url( 'options-general.php?page=clearfy' );

        $this->options = get_option($this->option_name);

        /**
         * Admin menu and settings
         */
        add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_clearfy_settings' ) );

        /**
         * Add css and js files
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );


        // plugin settings link
        add_filter( 'plugin_action_links_' . $this->plugin_options->plugin_path, array( $this, 'plugin_add_settings_link' ) );

        /**
         * License activate
         */
        add_action( 'admin_init', array( $this, 'activate_license' ) );
        //add_action( 'admin_init', array( $this, 'license_verify' ) );

        /**
         * Settings Migrate
         */
        require_once dirname(__FILE__) . '/../inc/class-settings-migrate.php';
        $this->settings_migrate = new Clearfy_Settings_Migrate( $this->plugin_options, array( $this->option_name, 'redirect_manager' ) );
        $this->settings_migrate->init();
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    0.9.5
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style( $this->plugin_options->plugin_name, plugin_dir_url(__FILE__) . 'css/clearfy-admin.css', array(), $this->plugin_options->version, 'all' );
        wp_enqueue_style( 'wp-color-picker' );
    }
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    0.9.5
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $enqueue_script_deps = apply_filters( 'clearfy_enqueue_script_deps', array( 'jquery', 'wp-color-picker' ) );
        wp_enqueue_script( $this->plugin_options->plugin_name, plugin_dir_url(__FILE__) . 'js/clearfy-admin.js', $enqueue_script_deps, $this->plugin_options->version, false );
    }


    /**
     * Add settings link in plugins list
     *
     * @param $links
     * @return mixed
     */
    public function plugin_add_settings_link( $links ) {
        $settings_link = '<a href="' . $this->settings_link . '">' . __( 'Settings' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }


    /**
     * Add plugin settings menu link
     */
    public function create_admin_menu() {
        add_menu_page( 'Clearfy Settings', 'Clearfy Pro', 'manage_options', 'clearfy', array( $this, 'admin_page_display' ), $this->get_menu_svg(), "99.42" );

        /**
         * Change name
         */
        global $submenu;
        if ( isset( $submenu['clearfy'] ) && current_user_can( 'manage_options' ) ) {
            $submenu['clearfy'][0][0] = 'Основные';
        }
    }

    /**
     * Returns a base64 URL for the svg for use in the menu
     *
     * @return string
     */
    private function get_menu_svg() {
        $icon_svg = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCIgd2lkdGg9IjM3NiIgaGVpZ2h0PSIzMDIiIHZpZXdCb3g9IjAgMCAzNzYgMzAyIj4KICA8ZGVmcz4KICAgIDxzdHlsZT4KCiAgICAgIC5jbHMtMiB7CiAgICAgICAgZmlsbDogIzAwMDAwMDsKICAgICAgfQogICAgPC9zdHlsZT4KICA8L2RlZnM+CiAgPHBhdGggZD0iTTM3Ni4yNDIsODguOTMyIEMzNzYuMjQyLDg4LjkzMiAzNzEuOTIwLDkyLjE4MSAzNzEuOTIwLDkyLjE4MSBDMzcxLjkyMCw5Mi4xODEgMzcyLjA2OSw5Mi4zMTMgMzcyLjA2OSw5Mi4zMTMgQzM3Mi4wNjksOTIuMzEzIDE4Ny4zODUsMzAwLjgyOSAxODcuMzg1LDMwMC44MjkgQzE4Ny4zODUsMzAwLjgyOSAxODYuNjk3LDMwMS45NjEgMTg2LjY5NywzMDEuOTYxIEMxODYuNjk3LDMwMS45NjEgMTg2LjU0MCwzMDEuNzgzIDE4Ni41NDAsMzAxLjc4MyBDMTg2LjU0MCwzMDEuNzgzIDE4Ni4zODIsMzAxLjk2MSAxODYuMzgyLDMwMS45NjEgQzE4Ni4zODIsMzAxLjk2MSAxODUuNjk2LDMwMC44MzEgMTg1LjY5NiwzMDAuODMxIEMxODUuNjk2LDMwMC44MzEgMC4wMTEsOTEuMzEzIDAuMDExLDkxLjMxMyBDMC4wMTEsOTEuMzEzIDEuMDcyLDkwLjQ5NiAxLjA3Miw5MC40OTYgQzEuMDcyLDkwLjQ5NiAwLjI1Nyw4OS45MzIgMC4yNTcsODkuOTMyIEMwLjI1Nyw4OS45MzIgNjEuODIwLDEuMDAwIDYxLjgyMCwxLjAwMCBDNjEuODIwLDEuMDAwIDYyLjQ4NywxLjQ2MiA2Mi40ODcsMS40NjIgQzYyLjQ4NywxLjQ2MiA2Mi40MTUsLTAuMDAwIDYyLjQxNSwtMC4wMDAgQzYyLjQxNSwtMC4wMDAgMzE0LjA4NCwtMC4wMDAgMzE0LjA4NCwtMC4wMDAgQzMxNC4wODQsLTAuMDAwIDMxNC4wMTMsMS40NjIgMzE0LjAxMywxLjQ2MiBDMzE0LjAxMywxLjQ2MiAzMTQuNjgwLDEuMDAwIDMxNC42ODAsMS4wMDAgQzMxNC42ODAsMS4wMDAgMzc2LjI0Miw4OC45MzIgMzc2LjI0Miw4OC45MzIgWk0zMDcuMDM0LDI2LjAxMCBDMzA3LjAzNCwyNi4wMTAgMjcyLjY5NCw3OC42NzAgMjcyLjY5NCw3OC42NzAgQzI3Mi42OTQsNzguNjcwIDM0My40ODgsNzguNjcwIDM0My40ODgsNzguNjcwIEMzNDMuNDg4LDc4LjY3MCAzMDcuMDM0LDI2LjAxMCAzMDcuMDM0LDI2LjAxMCBaTTMzOC42MTIsOTkuMTkzIEMzMzguNjEyLDk5LjE5MyAyNjIuMjE2LDk5LjE5MyAyNjIuMjE2LDk5LjE5MyBDMjYyLjIxNiw5OS4xOTMgMjExLjg3MiwyNDIuNjg1IDIxMS44NzIsMjQyLjY4NSBDMjExLjg3MiwyNDIuNjg1IDMzOC42MTIsOTkuMTkzIDMzOC42MTIsOTkuMTkzIFpNMTg2LjU0MCwyNTIuOTA1IEMxODYuNTQwLDI1Mi45MDUgMjQwLjQ2OCw5OS4xOTMgMjQwLjQ2OCw5OS4xOTMgQzI0MC40NjgsOTkuMTkzIDEzMi42MTEsOTkuMTkzIDEzMi42MTEsOTkuMTkzIEMxMzIuNjExLDk5LjE5MyAxODYuNTQwLDI1Mi45MDUgMTg2LjU0MCwyNTIuOTA1IFpNMTYxLjIwNywyNDIuNjg2IEMxNjEuMjA3LDI0Mi42ODYgMTEwLjg2NCw5OS4xOTMgMTEwLjg2NCw5OS4xOTMgQzExMC44NjQsOTkuMTkzIDM0LjQ2OCw5OS4xOTMgMzQuNDY4LDk5LjE5MyBDMzQuNDY4LDk5LjE5MyAxNjEuMjA3LDI0Mi42ODYgMTYxLjIwNywyNDIuNjg2IFpNMzMuMDExLDc4LjY3MCBDMzMuMDExLDc4LjY3MCAxMDAuMzg2LDc4LjY3MCAxMDAuMzg2LDc4LjY3MCBDMTAwLjM4Niw3OC42NzAgNjcuNzA0LDI4LjU1NCA2Ny43MDQsMjguNTU0IEM2Ny43MDQsMjguNTU0IDMzLjAxMSw3OC42NzAgMzMuMDExLDc4LjY3MCBaTTg2Ljk2NiwyMC41MjMgQzg2Ljk2NiwyMC41MjMgMTIwLjE2Miw3MS40MjggMTIwLjE2Miw3MS40MjggQzEyMC4xNjIsNzEuNDI4IDE2NC4xMjEsMjAuNTIzIDE2NC4xMjEsMjAuNTIzIEMxNjQuMTIxLDIwLjUyMyA4Ni45NjYsMjAuNTIzIDg2Ljk2NiwyMC41MjMgWk0xNDEuMDIyLDc4LjY3MCBDMTQxLjAyMiw3OC42NzAgMjMyLjA1Nyw3OC42NzAgMjMyLjA1Nyw3OC42NzAgQzIzMi4wNTcsNzguNjcwIDE4Ni41NDAsMjUuOTYwIDE4Ni41NDAsMjUuOTYwIEMxODYuNTQwLDI1Ljk2MCAxNDEuMDIyLDc4LjY3MCAxNDEuMDIyLDc4LjY3MCBaTTIwOC45NTgsMjAuNTIzIEMyMDguOTU4LDIwLjUyMyAyNTIuOTE4LDcxLjQyOCAyNTIuOTE4LDcxLjQyOCBDMjUyLjkxOCw3MS40MjggMjg2LjExMywyMC41MjMgMjg2LjExMywyMC41MjMgQzI4Ni4xMTMsMjAuNTIzIDIwOC45NTgsMjAuNTIzIDIwOC45NTgsMjAuNTIzIFoiIGlkPSJwYXRoLTEiIGNsYXNzPSJjbHMtMiIgZmlsbC1ydWxlPSJldmVub2RkIi8+Cjwvc3ZnPgo=';

        return $icon_svg;
    }


    /**
     * Register settings
     */
    public function register_clearfy_settings() {
        register_setting( 'clearfy_settings', $this->option_name, array( $this, 'sanitize_clearfy_options' ) );
        register_setting( 'clearfy_license', 'clearfy_license_key' );
    }

    public function sanitize_clearfy_options( $options ) {

        $old_options = get_option($this->option_name);

        if ( ! empty( $options['sanitize_title'] ) && $options['sanitize_title'] == 'on' && empty( $old_options['sanitize_title'] ) ) {

            /**
             * Sanitize existing slugs
             */
            require_once dirname(__FILE__) . '/../inc/sanitize-title.php';
            $clearfy_sanitize = new Clearfy_Sanitize;
            $clearfy_sanitize->sanitize_existing_slugs();

        }

        return $options;
    }


    public function license_verify() {

        $license_verify = get_option('clearfy_license_verify');
        $license_key = get_option('clearfy_license_key');

        if ( ! empty( $license_key ) && ( time() > $license_verify || empty( $license_verify ) ) ) {

            $api_params = array(
                'action'    => 'verify_license',
                'license' 	=> $license_key,
                'item_name' => urlencode( $this->plugin_options->plugin_name ),
                'version'   => $this->plugin_options->version,
                'ip'        => $this->get_ip(),
                'url'       => home_url(),
            );

            $response = wp_remote_post( $this->plugin_options->api_url, array(
                'timeout'   => 15,
                'sslverify' => false,
                'body'      => $api_params
            ) );

            if ( is_wp_error( $response ) ) {
                $api_url = str_replace("https", "http", $this->plugin_options->api_url);

                $response = wp_remote_post( $api_url, array(
                    'timeout'   => 15,
                    'sslverify' => false,
                    'body'      => $api_params
                ) );
            }

            if ( is_wp_error( $response ) ) return false;

            $license_data = wp_remote_retrieve_body( $response );
            if ( mb_substr($license_data, 0, 2) == 'ok' ) {
                update_option( 'clearfy_license_verify', time() + (WEEK_IN_SECONDS * 4) );
                //delete_option( 'license_error' );
            }

        }


    }


    public function activate_license() {
        if( isset( $_POST['clearfy_license_key'] ) && ! empty( $_POST['clearfy_license_key'] ) ) {
            /**
             * Remove updater cache in DB
             */
            delete_option(Clearfy_Plugin::CHECK_UPDATE_OPTION);

            // retrieve the license from the database
            $license = trim( $_POST[ 'clearfy_license_key'] );

            // data to send in our API request
            $api_params = array(
                'action'    => 'activate_license',
                'license' 	=> $license,
                'item_name' => urlencode( $this->plugin_options->plugin_name ), // the name of our product in EDD,
                'version'   => $this->plugin_options->version,
                'type'      => 'plugin',
                'ip'        => $this->get_ip(),
			    'url'       => home_url(),
		    );

            // Call the custom API.
            $response = wp_remote_post( $this->plugin_options->api_url, array(
                'timeout'   => 15,
                'sslverify' => false,
                'body'      => $api_params
            ) );
            // make sure the response came back okay
			if ( is_wp_error( $response ) ) {
                $api_url = str_replace("https", "http", $this->plugin_options->api_url);
    
				$response = wp_remote_post( $api_url, array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params
				) );
			}
			if ( is_wp_error( $response ) ) return false;

            // decode the license data
            $license_data = wp_remote_retrieve_body( $response );
            if (mb_substr($license_data, 0, 2) == 'ok') {
                update_option( 'license_verify', time() + (WEEK_IN_SECONDS * 4) );
                delete_option( 'license_error' );
            } else {
                update_option( 'license_error', $license_data );
            }

	    }
    }




    /**
     * Display admin plugin page
     */
    public function admin_page_display() {
        $options = get_option($this->option_name);
        $license_key = get_option('clearfy_license_key');
        $license_verify = get_option('license_verify');
        $license_error = get_option('license_error');

        //$check_version = $this->check_version();
        ?>

        <div class="wrap wpshop clearfy js-clearfy">

            <h1>Clearfy Pro</h1>

            <div class="wpshopbiz-plugin-info">
                <img src="https://cdn.wpshop.ru/plugins/clearfy/logo-mini.png" alt="">
            </div>

            <?php settings_errors(); ?>


            <?php if ( empty($license_key) || empty($license_verify) || !empty($license_error) ): ?>

            <form method="post" action="options.php">
                <?php settings_fields( 'clearfy_license' ); ?>
                <table class="form-table">

                    <tr>
                        <th scope="row"><label for="clearfy_license_key">Лицензионный ключ</label></th>
                        <td>
                            <input name="clearfy_license_key" id="clearfy_license_key" type="text" class="regular-text" value="<?php echo $license_key ?>">
                            <?php if (!empty($license_error)): ?>
                                <p class="description danger"><?php echo $license_error ?></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>
            </form>

            <?php else: ?>




            <h3><?php _e( 'Settings', $this->plugin_options->text_domain ) ?></h3>


            <div class="wpshop-cols">

                <div class="pseudo-button js-clearfy-enable"><?php _e( 'Enable all', $this->plugin_options->text_domain ) ?></div>
                <div class="pseudo-button pseudo-button__green js-clearfy-recommend"><?php _e( 'Enable recommended', $this->plugin_options->text_domain ) ?></div>
                <div class="pseudo-button pseudo-button__gray js-clearfy-disable"><?php _e( 'Disable all', $this->plugin_options->text_domain ) ?></div>

                <p><?php _e( 'For default we recommend enable only recommended settings.<br>If you are expert - you can configure manually.', $this->plugin_options->text_domain ) ?></p>
                <p><strong><?php _e( 'Don\'t forget to save settings', $this->plugin_options->text_domain ) ?></strong></p>


                <div class="wpshop-col-left">

                    <form method="post" action="options.php" class="js-clearfy-form">

                        <?php settings_fields( 'clearfy_settings' ); ?>

                        <h2 class="wpshop-tab-wrapper js-wpshop-tab-wrapper">
                          <a class="wpshop-tab wpshop-tab-active" id="tab-clearfy_general" href="#clearfy_general"><?php _e( 'General', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_clear" href="#clearfy_clear"><?php _e( 'Code', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_seo" href="#clearfy_seo"><?php _e( 'SEO', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_double" href="#clearfy_double"><?php _e( 'Duplicate', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_security" href="#clearfy_security"><?php _e( 'Defence', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_more" href="#clearfy_more"><?php _e( 'Additionally', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_redirect" href="#clearfy_redirect"><?php _e( 'Redirect', $this->plugin_options->text_domain ) ?></a>
                          <a class="wpshop-tab" id="tab-clearfy_404" href="#clearfy_404"><?php _e( '404', $this->plugin_options->text_domain ) ?></a>
                        </h2>

                        <div id="clearfy_general" class="wpshop-tab-in js-wpshop-tab-item active">

                            <div class="option-field-header"><?php _e( 'What to do?', $this->plugin_options->text_domain ) ?></div>

                            <p><?php _e( 'For quick start just enable Recommended settings and click Save. But we recommend watch all possible Clearfy Pro features.', $this->plugin_options->text_domain ) ?></p>
                            <p><?php _e( 'Bloggers need attention to RSS feeds. If you use them, do not disable it.', $this->plugin_options->text_domain ) ?></p>
                            <p><?php _e( 'Just enable needed settings and click save. All done.', $this->plugin_options->text_domain ) ?></p>
                            <p><?php _e( 'Any questions? Send message to our technical support.', $this->plugin_options->text_domain ) ?></p>

                            <hr>

                            <div class="option-field-header"><?php _e( 'Questions, changelog', $this->plugin_options->text_domain ) ?></div>
                            <p><?php printf( __( 'FAQ and changelog you can find in <a href="%s">our knowledge base</a>.', $this->plugin_options->text_domain ), 'https://docs.wpshop.ru/plugins/clearfy/' ) ?></p>

                            <hr>

                            <div class="option-field-header"><?php _e( 'Export / Import settings', 'clearfy' ) ?></div>

                            <div class="wpshop-export-settings">
                                <label for="export_settings">Export:</label>
                                <textarea id="export_settings" class="large-text code" rows="3" onmouseover="this.select()"><?php echo $this->settings_migrate->export() ?></textarea>
                                <p class="description">Скопируйте этот код в любой текстовый файл, чтобы сохранить все настройки сайта</p>
                            </div>

                            <div class="wpshop-import-settings">
                                <label for="import_settings">Import:</label>
                                <textarea id="import_settings" name="import_settings" class="large-text code" rows="3"></textarea>
                                <input type="hidden" name="import_settings_name" value="<?php echo $this->plugin_options->plugin_name ?>">
                                <p class="description">Внимание! Старые настройки будут удалены перед импортом!</p>
                                <span class="button js-import-settings-clearfy" data-nonce="<?php echo wp_create_nonce( 'wpshop_plugin_import_settings' ) ?>">Импортировать</span>
                            </div>

                            <hr>

                            <div class="option-field-header"><?php _e( 'Team WPShop.biz', 'clearfy' ) ?></div>

                            <p>Мы благодарим Вас за приобретение Clearfy Pro!<br>Наша цель - сделать мощный плагин, который войдет в число первых обязательных плагинов для WP.</p>
                            <a href="https://wpshop.ru/?utm_source=wp-admin&utm_medium=plugin&utm_campaign=clearfy" target="_blank"><img src="https://cdn.wpshop.ru/logotype.png" alt="WPShop"></a>

                        </div>
                        <div id="clearfy_clear" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header"><?php _e( 'Clear code', $this->plugin_options->text_domain ) ?></div>

                            <div class="option-field">
                                <label class="option-field-label" for="disable_json_rest_api">
                                    <?php _e( 'Disable JSON REST API', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_json_rest_api') ?>
                                    <p class="description"><?php _e( 'WP 4.4 and up create technical pages /wp-json/, which successfully indexing search engines like Google and reduce rank and positions of site.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Remove REST API links from %s and create redirect on front.', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>' ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_emoji">
                                    <?php _e( 'Disable Emoji', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_emoji') ?>
                                    <p class="description"><?php _e( 'WP 4.2 and up add support Emoji smiles in source code for old browsers. It use external JavaScript library which slowly page and create request to external resources.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Removes Emoji from %s', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>' ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_dns_prefetch">
                                    <?php _e( 'Delete dns-prefetch', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_dns_prefetch') ?>
                                    <p class="description"><?php printf( __( 'Since version 4.6.1 WordPress add new links in section %s like this: %s', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>', '&lt;link rel=\'dns-prefetch\' href=\'//s.w.org\'&gt;' ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Removes dns-prefetch links from %s section', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>' ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_jquery_migrate">
                                    <?php _e( 'Remove jquery-migrate.min.js', $this->plugin_options->text_domain ) ?>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_jquery_migrate') ?>
                                    <p class="description"><?php _e( 'File jquery-migrate.min.js require for old version of jQuery before 1.9.х. In most cases it unnecessary file to load.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Delete including jquery-migrate.min.js from %s', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>' ) ?></p>
                                    <p class="description"><span class="dashicons dashicons-warning wpshop-warning-color"></span> <?php _e( 'Check your site after enable this setting', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_rsd_link">
                                    <?php _e( 'Delete RSD link', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_rsd_link') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_wlw_link">
                                    <?php _e( 'Delete WLW Manifest link', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_wlw_link') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_shortlink_link">
                                    <?php printf( __( 'Delete shortlink %s', $this->plugin_options->text_domain ), '<code>/?p=</code>' ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_shortlink_link') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_adjacent_posts_link">
                                    <?php _e( 'Remove previous and next post links', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_adjacent_posts_link') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_recent_comments_style">
                                    <?php _e( 'Remove .recentcomments styles', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_recent_comments_style') ?>
                                    <p class="description"><?php _e( 'By default for widget "recent comments" WordPress add styles to source code that you can\'t change, because to them apply !important.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Removes .recentcomments styles from %s', $this->plugin_options->text_domain ), '<code>&lt;head&gt;</code>' ) ?></p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header"><?php _e( 'Minify', $this->plugin_options->text_domain ) ?></div>

                            <div class="option-field auto-enable-false">
                                <label class="option-field-label" for="html_minify">
                                    <?php _e( 'Enable HTML minify', $this->plugin_options->text_domain ) ?>
                                    <br><small class="wpshop-red-text">beta</small>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('html_minify') ?>
                                    <p class="description"><?php _e( 'Reduces page weight about 20-30&#37 by removing line breaks, tabs, spaces, etc. Improve Google PageSpeed scores.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><?php _e( 'After turn on this settings - clear cache if you have.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><?php _e( 'JS scripts are not minified in code, because in 90&#37 of cases minifier braking them.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><?php _e( 'HTML comments are not deleted, because it can brake ad or analytics.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Minify pages', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><span class="dashicons dashicons-warning wpshop-warning-color"></span> <?php _e( 'Check your site after enable this setting', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description wpshop-red-color"><small>* <?php _e( 'In some cases minifier can\'t work correct - please send report to our technical support.', $this->plugin_options->text_domain ) ?></small></p>
                                </div>
                            </div><!--.option-field-->

                        </div>
                        <div id="clearfy_seo" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header">SEO</div>

                            <div class="option-field">
                                <label class="option-field-label" for="set_last_modified_headers">
                                    Автоматически проставить заголовок Last Modified
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('set_last_modified_headers') ?>
                                    <div class="last-modified-text">
                                        Исключить страницы:
                                        <?php $this->display_textarea_last_modified('last_modified_exclude') ?>
                                        <p class="description">Вы можете задать маску страниц, например: /s= или /cabinet/. Будут исключены все страницы, в которые входит строка.<br>Если задать <code>cart/</code> - будут исключены все страницы, содержащие cart/, в т.ч. <code>cart/process</code>, <code>order-cart/</code>, <code>check-cart/?get=action</code> и т.д.</p>
                                    </div>
                                    <p class="description">WordPress не умеет отдавать в ответах сервера заголовок Last Modified (дату последнего изменения документа) и давать правильный ответ 304 Not Modified. А этот заголовок очень важен для поисковых систем. Его наличие ускоряет индексацию, снижает нагрузку и позволяет загружать поисковикам за раз больше страниц в индекс. <a href="https://wpshop.ru/blog/last-modified-i-wordpress?utm_source=wp-admin&utm_medium=plugin&utm_campaign=clearfy" target="_blank">Подробнее в нашем блоге</a>.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Проставляет для всех записей, страниц, архивов (категорий, тегов и пр.) заголовок <code>Last Modified</code> и возвращает правильный ответ, если страница не была изменена.</p>
                                    <p class="description danger"><small>* Срабатывает не на всех хостингах, если у Вас не отдается этот заголовок - напишите в поддержку</small></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="if_modified_since_headers">
                                    Отдавать ответ If-Modified-Since
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('if_modified_since_headers') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="content_image_auto_alt">
                                    <?php _e( 'Automatically set the alt attribute', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('content_image_auto_alt') ?>
                                    <p class="description"><?php _e( 'The most of SEO specialists advise to fill alt attribute. If you missed or did not fill it, it will be automatically assigned and equal the title of article.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php printf( __( 'Add attribute %s to image without it.', $this->plugin_options->text_domain ), '<code>alt</code>' ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="comment_text_convert_links_pseudo">
                                    <?php _e( 'Hide external links in comments by JS', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('comment_text_convert_links_pseudo') ?>
                                    <p class="description"><?php _e( 'A lot of external links in comments reduce page rank and positions in search engines like Google.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Replaces only external links in comments by JS and it looks like a regular link.', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="pseudo_comment_author_link">
                                    <?php _e( 'Hide authors external links in comments by JS', $this->plugin_options->text_domain ) ?> *
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('pseudo_comment_author_link') ?>
                                    <p class="description"><?php _e( 'Up to 90&#37 comments may be left on your site for external link. Even nofollow can\'t stop reduce page rank.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Replaces authors external links in comments by JS, and it looks like a regular link.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description danger"><small>* <?php _e( 'Perhaps it will not work with your theme', $this->plugin_options->text_domain ) ?></small></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="noindex_pagination">
                                    <?php _e( 'Noindex для пагинации', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('noindex_pagination') ?>
                                    <p class="description"><?php _e( 'В результаты поиска включаются страницы пагинации /page/2/, /page/3/ и т.д.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Закрывает от индексации страницы пагинации /page/2/, /page/3/ и т.д. с помощью тега noindex.', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="right_robots_txt">
                                    Создать правильный robots.txt
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('right_robots_txt') ?>
                                    <?php if ( file_exists(ABSPATH . 'robots.txt') ) { ?>
                                        <p class="description danger"><strong>Внимание! Обнаружен файл robots.txt.</strong><br>Сделайте бекап текущего файла robots.txt и удалите его, чтобы данная функция могла работать</p>
                                    <?php } ?>
                                    <p class="description">После установки WP не содержит файла robots.txt и его приходится создавать вручную. Мы перечитали около 30 различных статей, инструкции от Яндекса и Google, чтобы создать идеальный robots.txt</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Автоматически создает идеальный <code>robots.txt</code></p>
                                    <p class="description">Вы можете изменить Ваш robots.txt в поле ниже:</p>
                                    <p class="robots-text">
                                        <?php $this->display_textarea_robots('robots_txt_text') ?>
                                    </p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field auto-enable-false">
                                <label class="option-field-label" for="redirect_from_http_to_https">
                                    Редирект с http на https
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('redirect_from_http_to_https') ?>
                                    <p class="description"><span class="dashicons dashicons-warning wpshop-warning-color"></span> Внимание! Перед активацией обязательно убедитесь, что Ваш сайт открывается по https</p>
                                    <p class="description">Если Ваш сайт использует SSL-сертификат, отметьте данный пункт, чтобы включить редирект с http на https</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Ставит редирект с http на https.</p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Для плагина Yoast SEO</div>


                            <div class="option-field">
                                <label class="option-field-label" for="remove_last_item_breadcrumb_yoast">
                                    <?php _e( 'Remove last duplicate title in breadcrumbs WP SEO by Yoast', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_last_item_breadcrumb_yoast') ?>
                                    <p class="description"><?php _e( 'Last element in breadcrubms in Yoast SEO plugin duplicate article title. Some SEO specialists thinks that it\'s worse for optimization.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy:</strong> <?php _e( 'Removes duplicate title in breadcrumbs WP SEO by Yoast', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="replace_last_item_breadcrumb_yoast_on_title">
                                    <?php _e( 'Заменить название записи на title в хлебных крошках WP SEO Yoast', $this->plugin_options->text_domain ) ?>
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('replace_last_item_breadcrumb_yoast_on_title') ?>
                                    <p class="description"><?php _e( 'В последнем элементе хлебных крошек плагина Yoast SEO выводится название записи. Чтобы оно не дублировалось можно заменить его на title записи.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Заменяет название записи на title записи в хлебных крошках плагина WP SEO Yoast', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="yoast_remove_image_from_xml_sitemap">
                                    Удалить тег &lt;image:image&gt; из XML карты сайта
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('yoast_remove_image_from_xml_sitemap') ?>
                                    <p class="description">Яндекс.Вебмастер ругается на стандартную XML карту от плагина Yoast, т.к. в ней есть специфичный тег &lt;image:image&gt;. Подробнее у нас в блоге.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет тег &lt;image:image&gt; из XML карты плагина Yoast SEO.</p>
                                    <p class="description danger"><strong>Внимание!</strong> После активации выключите карту сайта и влючите обратно, чтобы перегенерировать её.</p>
                                    <p class="description danger"><small>* На старых версиях Yoast SEO может не сработать - обновите плагин Yoast</small></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="yoast_remove_head_comment">
                                    Удалить комментарий из секции &lt;head&gt;
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('yoast_remove_head_comment') ?>
                                    <p class="description">Плагин Yoast SEO выводит комментарий вида &lt;!-- This site is optimized with the Yoast SEO plugin v3.1.1 - https://yoast.com/wordpress/plugins/seo/ --&gt; в секции &lt;head&gt;</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет комментарий плагина Yoast SEO их секции &lt;head&gt;.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="yoast_canonical_pagination">
                                    <?php _e( 'Canonical на страницах пагинации', $this->plugin_options->text_domain ) ?>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox( 'yoast_canonical_pagination' ) ?>
                                    <p class="description"><?php _e( 'Плагин Yoast SEO на страницах пагинации выводит canonical ссылки /page/2/, /page/3/ и т.д.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Меняет canonical ссылку на главную или саму рубрику', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="yoast_application_ld_json">
                                    <?php _e( 'Удалить application/ld+json', $this->plugin_options->text_domain ) ?>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox( 'yoast_application_ld_json' ) ?>
                                    <p class="description"><?php _e( 'JSON-LD - формат микроразметки. Yoast выводит в шапке информацию о сайте и ссылку на поиск с помощью этого формата.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Отключает вывод кода application/ld+json в шапке сайта.', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->


                        </div>
                        <div id="clearfy_double" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header">Дубли страниц</div>


                            <div class="option-field">
                                <label class="option-field-label" for="redirect_archives_date">
                                    Удалить архивы дат
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('redirect_archives_date') ?>
                                    <p class="description">Огромное количество дублей в архивах дат. Представьте, кроме того, что Ваша статья будет выводиться на главной и в категории, Вы еще получите как минимум 3 дубля: в архивах по году, месяцу и дате, например /2016/ /2016/02/ /2016/02/15.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет полностью архивы дат и ставит редирект.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="redirect_archives_author">
                                    Удалить архивы пользователей
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('redirect_archives_author') ?>
                                    <p class="description">Если сайт наполняете только Вы - обязательный пункт. Позволит избавиться от дублей на архивах пользователей, например /author/admin/.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет полностью архивы пользователей и ставит редирект.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="redirect_archives_tag">
                                    Удалить архивы тегов
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('redirect_archives_tag') ?>
                                    <p class="description">Если Вы используете теги только для блока Похожие записи, либо не использете их совсем - правильнее будет их закрыть, чтобы избежать дублей.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Ставит редирект со страниц тегов на главную.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="attachment_pages_redirect">
                                    Удалить страницы вложений
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('attachment_pages_redirect') ?>
                                    <p class="description">Каждая загруженная картинка имеет свою страничку на сайте, состоящую только из одной картинки. Такие страницы успешно индексируются и создают дубли. На сайте могут быть тысячи однотипных страниц вложений.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет страницы вложений и ставит редирект на запись.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_single_pagination_duplicate">
                                    Удалить дубли пагинации постов
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_single_pagination_duplicate') ?>
                                    <p class="description">В WordPress любую запись можно разделить на части (страницы), у каждой части будет свой адрес. Но этот функционал крайне редко используется, зато может создать Вам неприятности. Например, к адресу любой записи Вашего блога можно добавить номер, /privet-mir/1/ - откроется сама запись, что будет дублем. Номер можно подставить любой.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Ставит редирект на саму запись.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_replytocom">
                                    Удалить ?replytocom
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_replytocom') ?>
                                    <p class="description">WordPress добавляет ?replytocom= к ссылке Ответить в комментариях, если включены древовидные комментарии</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> удаляет ?relpytocom и ставит редирект на запись</p>
                                </div>
                            </div><!--.option-field-->


                        </div>
                        <div id="clearfy_security" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header">Защита</div>


                            <div class="option-field">
                                <label class="option-field-label" for="protect_author_get">
                                    Убрать возможность узнать логин администратора
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('protect_author_get') ?>
                                    <p class="description">Сменили имя пользователя с admin на другое, чтобы злоумышленники не узнали Ваш логин? Не спешите радоваться, наберите в адресной строке <code>вашсайт.ru/?author=1</code> и Вас в 90% случаев сразу перекинет на страницу автора <code>/author/alexey</code>, тем самым выдавая Ваш логин.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет полностью архивы дат и ставит редирект.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="change_login_errors">
                                    Спрятать ошибки при входе на сайт
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('change_login_errors') ?>
                                    <p class="description">WP по умолчанию показывает, ввели ли Вы неправильный логин или неправильный пароль, что дает злоумышленникам понять, существует ли определенный пользователь на сайте, а после начать перебор паролей.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Меняет текст ошибки так, чтобы злоумышленники не смогли подобрать логин.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_x_pingback">
                                    Убрать ссылку на X-Pingback и возможность спамить pingback'ами
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_x_pingback') ?>
                                    <p class="description">Одной из причин, по которым Ваш сайт на WP стал тормозить, является атака на сайт, при которой идет большое количество запросов к файлу xmlrpc.php, который отвечает за pingback'и, удаленный доступ к WP. Через файл xmlrpc.php может идти DDoS или Брутфорс-атака.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет в ответах сервера ссылку на xmlrpc.php, закрывает возможность спамить сайт pingback'ами.</p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Версии</div>

                            <div class="option-field">
                                <label class="option-field-label" for="remove_meta_generator">
                                    Удалить meta generator
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_meta_generator') ?>
                                    <p class="description">Позволяет злоумышленникам узнать версию WP, установленную на сайте. Этот meta тег никакой полезной функции не несет.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет meta тег из секции <code>&lt;head&gt;</code></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_versions_styles">
                                    Удалить версию у стилей
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_versions_styles') ?>
                                    <p class="description">WP, темы и плагины часто подключают стили с указанием версии файла, плагина или движка, выглядит это так: <code>?ver=4.7.5</code>. Во-первых, это позволяет злоумышленникам узнать версию плагина, движка, во-вторых, отключает кеширование для этих файлов, что уменьшает время загрузки страницы.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет версии у стилей</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_versions_scripts">
                                    Удалить версию у скриптов
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_versions_scripts') ?>
                                    <p class="description">Как и со стилями, скрипты подключаются с указанием версии файла, плагина или движка, выглядит это так: <code>?ver=4.7.5</code>. Во-первых, это позволяет злоумышленникам узнать версию плагина, движка, во-вторых, отключает кеширование для этих файлов, что уменьшает время загрузки страницы.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет версии у скриптов</p>
                                </div>
                            </div><!--.option-field-->

                        </div>
                        <div id="clearfy_more" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header">Дополнительно</div>

                            <div class="option-field">
                                <label class="option-field-label" for="sanitize_title">
                                    Транслитерация заголовков и файлов
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('sanitize_title') ?>
                                    <p class="description">Аналог плагинов Rus To Lat, Cyr2Lat и др. Транслитерация постоянных ссылок и названий файлов. Например, пост "привет мир!" станет "privet-mir", а файл "картинка.jpg" станет "kartinka.jpg".</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Выполняет транслитерацию постоянных ссылок и загружаемых файлов.</p>
                                </div>
                            </div><!--.option-field-->


                            <div class="option-field">
                                <label class="option-field-label" for="disable_feed">
                                    Отключить ленты RSS
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_feed') ?>
                                    <p class="description">Основная дыра, откуда будут парсить Ваш контент, - RSS-ленты. Для статейных сайтов, сайтов-визиток, корпоративных сайтов - отключать обязательно.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Удаляет ссылку на RSS-ленту из секции &lt;head&gt;, закрывает и ставит редирект со всех RSS-лент.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_url_from_comment_form">
                                    Убирает в форме комментирования поле «Сайт»
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_url_from_comment_form') ?>
                                    <p class="description">Надоел спам в комментариях? Посетители оставляют «пустые» комментарии ради ссылки на свой сайт?</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Убирает поле «Сайт» из формы комментирования.</p>
                                    <p class="description danger"><small>* Работает со стандартной формой комментирования, если в Вашей теме форма прописана вручную - скорей всего не сработает!</small></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_unnecessary_link_admin_bar">
                                    Убирает ссылки на сайт wordpress.org из админ бара
                                    <span class="clearfy-recommend"><?php _e( 'Recommended', $this->plugin_options->text_domain ) ?></span>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_unnecessary_link_admin_bar') ?>
                                    <p class="description">Первым пунктом в панели инструментов идет логотип wordpress'а и внешние ссылки на сайты wordpress.org, документацию и форумы WP.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Убирает все ссылки на wordpress.org из панели инструментов.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_gravatar">
                                    <?php _e( 'Отключить граватары', $this->plugin_options->text_domain ) ?>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_gravatar') ?>
                                    <p class="description"><?php _e( 'В качестве аватаров в WP автоматически выводятся граватары от gravatar.com, лишний внешний ресурс для загрузки.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Отключает граватары и в качестве аватаров выводит картинку по-умолчанию.', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_admin_bar">
                                    <?php _e( 'Отключить админ бар', $this->plugin_options->text_domain ) ?>
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_admin_bar') ?>
                                    <p class="description"><?php _e( 'По умолчанию для авторизованных пользователей показывается верхняя панель администратора.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Disable admin bar', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_email_notification">
                                    Уведомления об обновлениях
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_email_notification') ?>
                                    <p class="description">С версии 3.7 WordPress научилась автоматически обновляться и отправлять каждый раз e-mail об обновлении.</p>
                                    <p class="description"><strong>Clearfy:</strong> Отключает уведомления на e-mail об автоматических обновлениях.</p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Контент</div>

                            <div class="option-field">
                                <label class="option-field-label" for="copy_source_link">
                                    Ссылка на источник при копировании
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('copy_source_link') ?>
                                    <div><?php $this->display_input_text('copy_source_link_text', array( 'default' => __( '<br>Source: %link%', $this->plugin_options->text_domain ) )) ?></div>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Добавляет ссылку на источник статьи при копировании текста. Обязательно добавьте слово: %link% оно будет заменено на ссылку. &lt;br&gt; - это перенос строки.', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description">Например:</p>
                                    <p class="description">&lt;br&gt;<?php _e( 'Source: %link%', $this->plugin_options->text_domain ) ?></p>
                                    <p class="description">- Читайте подробнее на: %link%</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_right_click">
                                    Отключить правую кнопку мыши
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_right_click') ?>
                                    <p class="description">Один из способов борьбы с копированием текста.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Отключает правую кнопку мышки', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_selection_text">
                                    Отключить выделение текста
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_selection_text') ?>
                                    <p class="description">Один из способов борьбы с копированием текста.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Отключает выделение текста на странице', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="disable_keystrokes">
                                    Отключить работу клавиш Ctrl+C и&nbsp;т.д.
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('disable_keystrokes') ?>
                                    <p class="description">Один из способов борьбы с копированием текста.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> <?php _e( 'Отключает работу клавиш Ctrl+C, Ctrl+A, Ctrl+U, Ctrl+S, Ctrl+X, Ctrl+Shift+C', $this->plugin_options->text_domain ) ?></p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Cookie</div>

                            <div class="option-field">
                                <label class="option-field-label" for="message_cookie">
                                    Уведомление о cookie
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('message_cookie') ?>
                                    <div class="last-modified-text">
                                        <?php $this->display_textarea( 'cookie_message_text', array( 'default' => $this->plugin_options->default_options['cookie_message_text'] ) ) ?>
                                        <p class="description">Можете задать текст для уведомления о куки, например:</p>
                                        <p class="description"><?php echo $this->plugin_options->default_options['cookie_message_text'] ?></p>
                                    </div>
                                    <p class="description"><strong>Clearfy:</strong> Выводит в нижней части уведомление о использовании куки на сайте.</p>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="cookie_message_position">
                                    Позиция
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_select( 'cookie_message_position', array(
                                        'bottom'    => 'Внизу',
                                        'left'      => 'Слева',
                                        'right'     => 'Справа',
                                    ), array(
                                        'default' => $this->plugin_options->default_options['cookie_message_position']
                                    ) ) ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="cookie_message_color">
                                    Цвет текста
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_color( 'cookie_message_color', array( 'default' => $this->plugin_options->default_options['cookie_message_color'] ) ) ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="cookie_message_background">
                                    Цвет фона
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_color( 'cookie_message_background', array( 'default' => $this->plugin_options->default_options['cookie_message_background'] ) ) ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="cookie_message_button_text">
                                    Текст кнопки
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_input_text( 'cookie_message_button_text', array( 'default' => $this->plugin_options->default_options['cookie_message_button_text'] ) ) ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="cookie_message_background">
                                    Цвет кнопки
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_color( 'cookie_message_button_background', array( 'default' => $this->plugin_options->default_options['cookie_message_button_background'] ) ) ?>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Виджеты</div>


                            <div class="option-field">
                                <label class="option-field-label" for="remove_unneeded_widget_page">
                                    Убрать виджет "Страницы"
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_unneeded_widget_page') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_unneeded_widget_calendar">
                                    Убрать виджет "Календарь"
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_unneeded_widget_calendar') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="remove_unneeded_widget_tag_cloud">
                                    Убрать виджет "Облако меток"
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('remove_unneeded_widget_tag_cloud') ?>
                                    <p class="description">Виджеты "Страницы", "Календарь", "Облако меток" создают по лишнему запросу к базе данных, а используются сейчас крайне редко, т.к. "Страницы" легко заменяются виджетом "Меню", а два других только создают дубли страниц.</p>
                                    <p class="description"><strong>Clearfy Pro:</strong> Отключает эти виджеты, уменьшая количество запросов к базе данных.</p>
                                </div>
                            </div><!--.option-field-->



                            <div class="option-field-header">Ревизии</div>


                            <div class="option-field">
                                <label class="option-field-label" for="revisions_disable">
                                    Отключить ревизии полностью
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_checkbox('revisions_disable') ?>
                                </div>
                            </div><!--.option-field-->

                            <div class="option-field">
                                <label class="option-field-label" for="revision_limit">
                                    Ограничить количество ревизий
                                </label>
                                <div class="option-field-body">
                                    <?php $this->display_input_number('revision_limit', 1, 0) ?>

                                    <?php
                                    $check_config_revisions = file_get_contents( get_home_path() . 'wp-config.php' );
                                    if ( preg_match('/define(.+?)WP_POST_REVISIONS/', $check_config_revisions) ) {
                                        echo '<p class="description danger">Внимание! В файле wp-config.php найдена константа WP_POST_REVISIONS, она определяет количество ревизий. Удалите её, чтобы Вы могли менять это значение через админку.</p>';
                                    }
                                    ?>
                                    <p class="description">При сохранении и обновлении любой записи или страницы создается её копия (ревизия), которую в будущем можно посмотреть или восстановить. Но со временем большое количество таких ревизий (а их может быть десятки для каждой страницы) забивают базу данных, расходуя место и замедляя работу. Обычно достаточно хранить до 3-5 последних ревизий.</p>
                                </div>
                            </div><!--.option-field-->



                        </div>
                        <div id="clearfy_redirect" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header"><?php _e( 'Redirect Manager', 'clearfy' ) ?></div>

                            <div class="option-field">
                                <label class="option-field-label" for="protect_author_get">
                                    Редирект
                                </label>
                                <div class="option-field-body">

                                    <?php
                                        $redirect_manager = new Clearfy_Redirect_Manager();
                                        echo $redirect_manager->show_fields();
                                    ?>

                                    <p class="description">301 редирект с одного адреса на другой. Например, если статья не доступна по старому адресу.</p>
                                    <p class="description">Вы можете указать как внутренние ссылки, так и внешние.</p>
                                    <p class="description">Поставьте * для замены любого количества символов. Например: /?product=*</p>
                                </div>
                            </div><!--.option-field-->
                        </div>

                        <div id="clearfy_404" class="wpshop-tab-in js-wpshop-tab-item">
                            <div class="option-field-header"><?php _e( '404', 'clearfy' ) ?></div>

                            <?php
                            require_once dirname(__FILE__) . '/../inc/class-logging.php';
                            $class_log = new Clearfy_Logging( $this->plugin_options, '404' );
                            ?>

                            <p>На этой странице Вы видите журнал последних запросов, по которым была возвращена 404 ошибка.</p>
                            <p>Эта информация поможет Вам правильно настроить редиректы со статей, у которых Вы сменили адрес, найти картинки, стили и скрипты, которые не открываются на сайте, следить за безопасностью сайта, вовремя увидеть проблемные места.</p>
                            <p>Максимум храняться последние <?php echo $class_log->get_limit() ?> записей.</p>

                            <p><span class="button js-clearfy-clear-log" data-nonce="<?php echo wp_create_nonce( 'clearfy_clear_log_nonce' ) ?>">Очистить лог</span></p>

                            <?php
                            $logs = $class_log->read();
                            ?>

                            <?php if ( ! empty( $logs ) ): ?>
                                <table class="wpshop-table clearfy-table-404">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>url</th>
                                            <th>referer</th>
                                            <th>ip</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $logs as $log ): ?>
                                            <?php
                                            $referer = '';
                                            $referer_short = '';
                                            if ( ! empty( $log['referer'] ) ) {
                                                $referer = $log['referer'];
                                                $referer_short = parse_url( $log['referer'], PHP_URL_HOST );
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo date( 'd.m.Y H:i', $log['date'] ) ?></td>
                                                <td><?php echo $log['message'] ?></td>
                                                <td><?php echo ( ! empty( $referer_short ) ) ? '<a href="' . esc_attr( $referer ) . '" target="_blank" rel="noopener noreferrer">' . $referer_short . '</span>' : '' ?></td>
                                                <td><?php echo $log['ip'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                        </div>

                        <?php submit_button(); ?>

                    </form>

                </div><!--.wpshop-col-left-->


                <div class="wpshop-col-right">

                    <?php $this->display_widgets(); ?>

                </div>

            </div>


            <?php endif; //license key ?>

        </div>

        <?php
    }



    public function display_widgets() {
        ?>

        <div class="wpshop-widget">
            Версия плагина: <?php echo $this->plugin_options->version; ?>
        </div>

        <?php
            $wpshop_widget_info = get_transient( 'wpshop_widget_info' );
            if ( false === $wpshop_widget_info ) {
                $wpshop_widget_info = @file_get_contents('https://wpshop.ru/api.php');
                set_transient('wpshop_widget_info', $wpshop_widget_info, 60 * 60 * 3);
            }
        ?>

        <div class="wpshop-widget wpshop-widget-news">
            <?php echo $wpshop_widget_info ?>
        </div>

        <?php
    }


    public function get_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    /**
     * Display option checkbox
     *
     * @param string $name
     */
    public function display_checkbox( $name ) {
        $checked = '';
        if (isset($this->options[$name]) && $this->options[$name] == 'on') $checked = ' checked';
        $string = '<span class="pseudo-checkbox'. $checked .'"></span> <input class="pseudo-checkbox-hidden" name="' . $this->option_name . '[' . $name . ']" type="checkbox" id="' . $name . '" value="on"'. $checked .'>';
        echo $string;
    }

    /**
     * Display input text field
     *
     * @param string $name
     * @param array $args
     */
    public function display_input_text( $name, $args = array() ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        if ( empty( $value ) && ! empty( $args['default'] ) ) $value = $args['default'];
        $string = '<input name="' . $this->option_name . '[' . $name . ']" type="text" id="' . $name . '" value="'. esc_attr($value) .'"" class="regular-text">';
        echo $string;
    }

    /**
     * Display textarea field
     *
     * @param string $name
     */
    public function display_textarea_robots( $name ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        if ( empty( $value ) ) {
            $plugin = new Clearfy_Plugin();
            $value = $plugin->right_robots_txt( '' );
            //$value = Clearfy_Plugin::right_robots_txt( '' );
        }
        $string = '<textarea name="' . $this->option_name . '[' . $name . ']" id="' . $name . '" class="regular-text">'. $value .'</textarea>';
        echo $string;
    }
	
	public function display_textarea_last_modified( $name ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string = '<textarea name="' . $this->option_name . '[' . $name . ']" id="' . $name . '" class="regular-text" rows="4">'. $value .'</textarea>';
        echo $string;
    }

    public function display_textarea( $name, $args = array() ) {
        if ( isset( $this->options[$name] ) && ! empty( $this->options[$name] ) ) $value = $this->options[$name];
        if ( empty( $value ) && ! empty( $args['default'] ) ) $value = $args['default'];
        $rows = ( ! empty( $args['rows'] ) ) ? $args['rows'] : 4 ;
        $string = '<textarea name="' . $this->option_name . '[' . $name . ']" id="' . $name . '" class="regular-text" rows="' . $rows . '">'. $value .'</textarea>';
        echo $string;
    }

    public function display_color( $name, $args = array() ) {
        if ( isset( $this->options[$name] ) && ! empty( $this->options[$name] ) ) $value = $this->options[$name];
        if ( empty( $value ) && ! empty( $args['default'] ) ) $value = $args['default'];

        $string = '<input class="color-input" type="text" name="' . $this->option_name . '[' . $name . ']" value="'. $value .'">';
        echo $string;

    }

    public function display_cookie_text_color( $name ) {
        $value = '#fff';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];

        $string = '<input class="color-input" type="text" name="' . $this->option_name . '[' . $name . ']" value="'. $value .'" />';
        echo $string;

    }

    public function display_cookie_background_color( $name ) {
        $value = '#000';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];

        $string = '<input class="color-input" type="text" name="' . $this->option_name . '[' . $name . ']" value="'. $value .'" />';
        echo $string;

    }

    /**
     * Display input number field
     *
     * @param $name
     * @param $step
     * @param $min
     * @param $max
     */
    public function display_input_number( $name , $step = '', $min = '', $max = '' ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string  = '<input name="' . $this->option_name . '[' . $name . ']" type="number" ';
        if (!empty($step)) $string .= 'step="'. $step .'" ';
        if (!empty($min) || $min === 0)  $string .= 'min="'. $min .'"  ';
        if (!empty($max))  $string .= 'max="'. $max .'" ';
        $string .= 'id="' . $name . '" value="'. $value .'"" class="small-text">';
        echo $string;
    }

    /**
     * Display select
     *
     * @param string $name
     * @param array $values
     */
    public function display_select( $name , $values, $args = array() ) {
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string  = '<select name="' . $this->option_name . '[' . $name . ']" id="' . $name . '">';

        if (is_array( $values )) {
            foreach ($values as $key => $value) {
                $selected = '';
                if (isset($this->options[$name]) && $this->options[$name] == $key) $selected = ' selected';

                $string .= '<option value="' . $key . '"'. $selected .'>' . $value . '</option>';
            }
        }

        $string .= '</select>';
        echo $string;
    }
}
