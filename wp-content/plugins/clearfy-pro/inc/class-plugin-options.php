<?php

/**
 * Class Plugin_Options
 *
 * @version     1.1
 * @updated     2018-05-23
 * @package     Clearfy_Plugin_Options
 */
class Clearfy_Plugin_Options {

    public $plugin_slug = 'clearfy_pro';

    public $plugin_name = 'clearfy-pro';

    public $text_domain = 'clearfy-pro';

    public $version = '1.0.0';

    public $api_url = '';

    public $plugin_path = '';

    public $options;

    public $default_options;



    /**
     * Set default options
     *
     * @param array $default_options
     */
    public function set_default_options( $default_options = array() ) {
        $this->default_options = $default_options;
    }


    public function get_option( $name = '', $default = false ) {
        if ( isset( $this->options[$name] ) ) {
            if ( $default && empty( $this->options[$name] ) ) {
                return $default;
            } else {
                return $this->options[ $name ];
            }
        } else {
            if ( ! empty( $this->default_options[$name] ) ) {
                return $this->default_options[$name];
            } else {
                if ( $default ) {
                    return $default;
                } else {
                    return false;
                }
            }
        }
    }

}