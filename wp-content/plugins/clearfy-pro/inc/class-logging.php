<?php

/**
 * Class Clearfy_Logging
 *
 * @version     1.0
 * @updated     2018-05-28
 * @package     Wpshop
 *
 * Changelog
 * 1.0 init
 */
class Clearfy_Logging {

    protected $log;
    protected $option_name;
    protected $plugin_options;
    protected $limit = 50;


    public function __construct( Clearfy_Plugin_Options $plugin_options, $option_name = '' ) {   // Clearfy_Pro_Options $options

        $this->plugin_options = $plugin_options;
        $this->option_name = $this->plugin_options->plugin_slug . '_log';

        if ( ! empty( $option_name ) ) $this->option_name .= '_' . $option_name;

    }


    public function add( $type = 'log', $message = '', $array = array() ) {

        $log = get_option( $this->option_name );
        if ( empty( $log ) ) $log = array();
        $line = array(
            'date'      => time(),
            'type'      => $type,
            'message'   => $message,
        );
        if ( ! empty( $array ) && is_array( $array ) ) {
            foreach ( $array as $k => $v ) {
                $line[$k] = $v;
            }
        }

        $log[] = $line;

        // limit
        $count = count( $log );
        if ( $count > $this->limit ) {
            $log = array_slice( $log, ( $count - $this->limit ) );
        }

        update_option( $this->option_name, $log );

    }


    public function read() {
        $log = get_option( $this->option_name );
        if ( empty( $log ) ) return array();

        $log = array_reverse($log);

        return $log;
    }


    public function clear() {
        delete_option( $this->option_name );
    }


    public function get_limit() {
        return $this->limit;
    }

}