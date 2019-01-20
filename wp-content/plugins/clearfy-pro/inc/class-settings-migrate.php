<?php

/**
 * Class Settings_Migrate
 *
 * @version     1.0
 * @updated     2018-05-08
 * @package     Wpshop
 *
 * Changelog
 * 1.0 init
 */
class Clearfy_Settings_Migrate {

    protected $options = array();
    protected $plugin_options;


    public function __construct( Clearfy_Plugin_Options $plugin_options, $options = array() ) {   // Clearfy_Pro_Options $options

        $this->plugin_options = $plugin_options;

        if ( ! is_array( $options ) ) return;
        $this->options = $options;

    }


    public function init() {
        add_action( 'wp_ajax_wpshop_plugin_import_settings', array( $this, 'ajax_import_settings' ) );

        if ( isset( $_COOKIE['plugin_import_settings_success'] ) && $_COOKIE['plugin_import_settings_success'] == '1' ) {
            add_action( 'admin_notices', array( $this, 'notice_import_success' ) );
            setcookie( 'plugin_import_settings_success', '', time() - 3600, '/');
        }
    }


    function notice_import_success() {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( 'Import successfully done', $this->plugin_options->text_domain ) ?></p>
        </div>
        <?php
    }


    function ajax_import_settings() {

        check_ajax_referer( 'wpshop_plugin_import_settings' );

        if ( ! empty( $_POST['import_settings'] ) && ! empty( $_POST['import_settings_name'] ) && $_POST['import_settings_name'] == $this->plugin_options->plugin_name ) {

            if ( $this->import( $_POST['import_settings'] ) ) {
                echo 'ok';
                setcookie( 'plugin_import_settings_success', '1', time() + 3600 );
            } else {
                echo 'Import error';
            }

        }

        die();
    }


    public function export() {
        $export = '';
        $export_options = array();

        foreach ( $this->options as $option ) {
            $export_options[ $option ] = get_option( $option );
        }

        if ( ! empty( $export_options ) ) {
            $export = base64_encode( json_encode( $export_options ) );
        }

        return $export;

    }


    public function import( $import = '' ) {

        $base64decode = base64_decode( $import );
        if ( $base64decode ) {
            $import_settings = json_decode( $base64decode, true );

            if ( $import_settings && ! empty( $import_settings ) ) {

                //print_r(get_option('redirect_manager'));

                foreach ( $import_settings as $option_name => $options ) {
                    if ( ! empty( $option_name ) && ! empty( $options ) ) {
                        update_option( $option_name, $options );
                    }
                }

                return true;
            }
        }

        return false;

    }

}