<?php
/**
 * Plugin Name: Clearfy Pro
 * Plugin URI: https://wpshop.ru/plugins/clearfy
 * Description: Очищает код WP от лишнего мусора, улучшает SEO, убирает дубли, усиливает защиту и не только! Смотрите полное описание на странице настроек
 * Version: 3.2.4
 * Author: WPShop.ru
 * Author URI: https://wpshop.ru/
 * Text Domain: clearfy-pro
 * Domain Path: /languages/
 * Build 11387
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


if( ! class_exists( 'Clearfy_Plugin' ) ):

    /**
     * The core plugin class.
     *
     * This is used to define internationalization, admin-specific hooks, and
     * public-facing site hooks.
     *
     * Also maintains the unique identifier of this plugin as well as the current
     * version of the plugin.
     *
     * @since      0.9.0
     * @package    Clearfy
     * @author     WPShop.biz <support@wpshop.biz>
     */
    class Clearfy_Plugin
    {
        /**
         * Cache of update checker
         * Need to delete when license key updated
         */
        const CHECK_UPDATE_OPTION = 'clearfy_update_checker_option';

        /**
         * The unique identifier of this plugin.
         *
         * @since    0.9.0
         * @access   protected
         * @var      string    $plugin_name    The string used to uniquely identify this plugin.
         */
        protected $plugin_name;
        /**
         * The current version of the plugin.
         *
         * @since    0.9.0
         * @access   protected
         * @var      string    $version    The current version of the plugin.
         */
        protected $version;

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
         * Api automatic update url
         *
         * @var string
         */
        protected $api_update_url;

        /**
         * Plugin path
         *
         * @var string
         */
        protected $plugin_path;

        /**
         * Check license if it works
         *
         * @var bool
         */
        protected $check_license;

        /**
         * Build
         *
         * @var string
         */
        protected $build;

        /**
         * Plugin Options
         *
         * @var Clearfy_Plugin_Options
         */
        protected $plugin_options;


        protected $default_options;


        /**
         * Define the core functionality of the plugin.
         *
         * Set the plugin name and the plugin version that can be used throughout the plugin.
         * Load the dependencies, define the locale, and set the hooks for the admin area and
         * the public-facing side of the site.
         *
         * @since    0.9.0
         */
        public function __construct() {

            // set variables
            $this->plugin_name      = 'clearfy-pro';
            $this->version          = '3.2.4';
            $this->build            = '11387';
            $this->api_url          = 'https://wpshop.ru/api.php';
            $this->api_update_url   = 'https://api.wpgenerator.ru/wp-update-server/?action=get_metadata&slug=' . $this->plugin_name;
            $this->check_license    = $this->check_license();
            $this->plugin_path      = plugin_basename( __FILE__ );

            // set options
            $this->options = get_option($this->option_name);

            /**
             * Plugin Options
             */
            require_once dirname(__FILE__) . '/inc/class-plugin-options.php';
            $plugin_options = new Clearfy_Plugin_Options();
            $plugin_options->plugin_name    = $this->plugin_name;
            $plugin_options->plugin_slug    = 'clearfy_pro';
            $plugin_options->text_domain    = 'clearfy-pro';
            $plugin_options->version        = $this->version;
            $plugin_options->api_url        = $this->api_url;
            $plugin_options->plugin_path    = $this->plugin_path;
            $plugin_options->options        = $this->options;
            $this->plugin_options = $plugin_options;


            $default_options = apply_filters( 'clearfy_options_defaults', array(
                'cookie_message_text'               => __( 'Этот сайт использует cookie для хранения данных. Продолжая использовать сайт, Вы даете свое согласие на работу с этими файлами.', $this->plugin_options->text_domain ),
                'cookie_message_position'           => 'bottom',
                'cookie_message_button_text'        => 'OK',
                'cookie_message_color'              => '#555555',
                'cookie_message_background'         => '#ffffff',
                'cookie_message_button_background'  => '#4b81e8',
            ) );
            $this->plugin_options->set_default_options( $default_options );


            // add localization
            add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain_localization' ) );

            /**
             * Automatic plugin update checker
             */
            require 'plugin-update-checker/plugin-update-checker.php';
            $clearfy_update_checker = PucFactory::buildUpdateChecker(
                $this->api_update_url,     //Metadata URL.
                __FILE__,           //Full path to the main plugin file.
                $this->plugin_name,  //Plugin slug. Usually it's the same as the name of the directory.
                12,
                self::CHECK_UPDATE_OPTION
            );

            //Add the license key to query arguments.
            $clearfy_update_checker->addQueryArgFilter( array( $this, 'wsh_filter_update_checks' ) );

            /**
             * The class responsible for defining all actions that occur in the admin area.
             */
            if ( is_admin() ) {
                require_once dirname(__FILE__) . '/admin/clearfy-admin.php';
                new Clearfy_Plugin_Admin( $plugin_options );
            }

            /**
             * Redirect Manager
             */
            require_once dirname(__FILE__) . '/inc/class-redirect-manager.php';
            $redirect_manager = new Clearfy_Redirect_Manager();
            $redirect_manager->init();

            /**
             * Hide admin
             */
            require_once dirname(__FILE__) . '/inc/class-hide-admin.php';
            $hide_admin = new Clearfy_Hide_Admin( $plugin_options ) ;
            $hide_admin->init();

            /**
             * 404 logging
             */
            add_action( 'template_redirect', array( $this, 'catch_404' ), 9999 );
            add_action( 'wp_ajax_clearfy_clear_log', array( $this, 'ajax_clearfy_clear_log' ) );

            /**
             * HTML minify
             */
            if ( $this->check_option( 'html_minify' ) ) {
                require_once dirname(__FILE__) . '/inc/html-minify.php';
            }

            /**
             * Sanitize title and files
             */
            if ( $this->check_option( 'sanitize_title' ) ) {
                require_once dirname(__FILE__) . '/inc/sanitize-title.php';
                new Clearfy_Sanitize;
            }


            /**
             * If license is ok
             */
            if ($this->check_license) {

                // include pseudo links styles and script
                if (
                    $this->check_option('comment_text_convert_links_pseudo') ||
                    $this->check_option('remove_url_from_comment_form')
                ) {
                    add_action('wp_head', array($this, 'add_pseudo_link_style'));
                    add_action('wp_footer', array($this, 'add_pseudo_link_scripts'));
                }



                if ($this->check_option('disable_emoji')) {
                    add_action( 'init', array($this, 'disable_emojis') );
                }

                if ($this->check_option('disable_json_rest_api')) {
                    add_action( 'init', array($this, 'remove_rest_api') );
                }

                if ($this->check_option('remove_jquery_migrate')) {
                    add_filter( 'wp_default_scripts', array($this, 'remove_jquery_migrate') );
                }

                if ($this->check_option('remove_recent_comments_style')) {
                    add_action( 'widgets_init', array($this, 'remove_recent_comments_style') );
                }

                if ($this->check_option('content_image_auto_alt')) {
                    add_filter( 'the_content', array($this, 'content_image_auto_alt') );
                }

                if ($this->check_option('comment_text_convert_links_pseudo')) {
                    add_filter( 'comment_text', array($this, 'comment_text_convert_links_pseudo') );
                }

                if ($this->check_option('pseudo_comment_author_link')) {
                    add_filter( 'get_comment_author_link', array( $this, 'pseudo_comment_author_link' ), 100, 3 );
                }

                if ($this->check_option('noindex_pagination')) {

                    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                    if ( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) {
                        add_filter( 'aioseop_robots_meta', array( $this, 'noindex_pagination_filter' ) );
                    }

                    else if ( is_plugin_active('wordpress-seo/wp-seo.php') ) {
                        add_filter( 'wpseo_robots', array( $this, 'noindex_pagination_filter' ) );
                    }

                    else {
                        add_action( 'wp_head', array( $this, 'noindex_pagination' ), 1 );
                    }

                }

                if ($this->check_option('right_robots_txt')) {
                    add_filter( 'robots_txt', array($this, 'right_robots_txt') );
                }

                if ($this->check_option('redirect_from_http_to_https')) {
                    add_action('init', array($this, 'redirect_from_http_to_https'));
                }

                if ($this->check_option('remove_last_item_breadcrumb_yoast')) {
                    add_filter( 'wpseo_breadcrumb_single_link', array($this, 'remove_last_item_breadcrumb_yoast') );
                }

                if ($this->check_option('replace_last_item_breadcrumb_yoast_on_title')) {
                    add_filter( 'wpseo_breadcrumb_single_link', array($this, 'replace_last_item_breadcrumb_yoast_on_title') );
                }

                if ($this->check_option('attachment_pages_redirect')) {
                    add_action( 'template_redirect', array($this, 'attachment_pages_redirect') );
                }

                if ($this->check_option('remove_single_pagination_duplicate')) {
                    add_action( 'template_redirect', array($this, 'remove_single_pagination_duplicate') );
                }

                if ($this->check_option('change_login_errors')) {
                    add_filter( 'login_errors', array($this, 'change_login_errors') );
                }

                if ($this->check_option('remove_versions_styles')) {
                    add_filter( 'style_loader_src', array( $this, 'remove_versions_styles_scripts' ), 9999, 2 );
                }

                if ($this->check_option('remove_versions_scripts')) {
                    add_filter( 'script_loader_src', array( $this, 'remove_versions_styles_scripts' ), 9999, 2 );
                }

                if ($this->check_option('remove_x_pingback')) {
                    add_filter('template_redirect', array($this, 'remove_x_pingback_headers'));
                    add_filter('wp_headers', array($this, 'remove_x_pingback'));
                }

                if ($this->check_option('disable_feed')) {
                    Clearfy_Plugin::disable_feed();
                }

                if ($this->check_option('remove_url_from_comment_form')) {
                    add_filter( 'comment_form_default_fields', array($this, 'remove_url_from_comment_form') );
                    add_filter( 'comment_form_fields', array($this, 'remove_url_from_comment_form') );
                }

                if ($this->check_option('remove_unnecessary_link_admin_bar')) {
                    add_action( 'wp_before_admin_bar_render', array($this, 'remove_unnecessary_link_admin_bar') );
                }

                if ($this->check_option('message_cookie')) {
                    if ( empty( $_COOKIE['clearfy_cookie_hide'] ) || $_COOKIE['clearfy_cookie_hide'] != 'yes' ) {
                        add_action( 'wp_footer', array( $this, 'add_message_cookie' ), 1000 );
                    }
                }
              
                if ($this->check_option('disable_email_notification')) {
                    add_filter( 'auto_core_update_send_email', '__return_false' );
                }
              
                if ($this->check_option('disable_keystrokes')) {
                    add_action( 'wp_footer', array($this, 'disable_keystrokes') );
                }

                if ($this->check_option('disable_selection_text')) {
                    add_action('wp_footer', array($this, 'add_disable_selection_text_scripts'));
                }

                if ($this->check_option('disable_right_click')) {
                    add_action( 'wp_footer', array($this, 'disable_right_click') );
                }

                if ($this->check_option('copy_source_link')) {
                    add_action( 'wp_footer', array( $this, 'add_copy_source_link_scripts' ) );
                }

                if ( $this->check_option('disable_gravatar') ) {
                    add_filter( 'get_avatar', array( $this, 'replace_gravatar' ), 10, 6 );
                }

                if ( $this->check_option( 'disable_admin_bar' ) ) {
                    add_action( 'init', array( $this, 'disable_admin_bar' ) );
                }

                if ( (isset($this->options['revision_limit']) && is_numeric($this->options['revision_limit'])) ||
                    $this->check_option('revisions_disable') ) {
                    add_filter( 'wp_revisions_to_keep', array( $this, 'clearfy_revisions_to_keep' ), 10, 2 );
                }

                if ($this->check_option('set_last_modified_headers')) {
                    add_action( 'template_redirect', array($this, 'set_last_modified_headers'), 999 );
                }

                if ($this->check_option('protect_author_get')) {
                    add_action( 'wp', array($this, 'protect_author_get') );
                }

                if ($this->check_option('yoast_remove_image_from_xml_sitemap')) {
                    $this->yoast_remove_image_from_xml_sitemap();
                }

                if ($this->check_option('yoast_remove_head_comment')) {
                    add_action( 'init', array($this, 'yoast_remove_head_comment') );
                }

                if ($this->check_option('yoast_canonical_pagination')) {
                    add_filter( 'wpseo_canonical', array($this, 'yoast_canonical_pagination') );
                }

                if ( $this->check_option( 'yoast_application_ld_json' ) ) {
                    add_filter( 'wpseo_json_ld_output', array($this, 'yoast_remove_json_ld') );
                }

                if ($this->check_option('remove_replytocom')) {
                    add_action( 'template_redirect', array( $this, 'remove_replytocom_redirect' ), 1 );
                    add_filter( 'comment_reply_link', array( $this, 'remove_replytocom_link' ) );
                }


                $this->remove_tags_from_head();
                add_action('widgets_init', array($this, 'remove_unneeded_widgets'));
                add_action('wp', array($this, 'redirect_archives'));

            }

        }




        /**
         * Add localization
         */
        public function load_plugin_textdomain_localization() {

            load_plugin_textdomain(
                $this->plugin_name,
                false,
                basename( dirname(__FILE__) ) . '/languages/'
            );

        }


        /**
         * Retrieve the version number of the plugin.
         *
         * @since     0.9.0
         * @return    string    The version number of the plugin.
         */
        public function get_version() {
            return $this->version;
        }


        /**
         * Add license key to request update
         *
         * @param $queryArgs
         * @return mixed
         */
        public function wsh_filter_update_checks($queryArgs) {
            $license_key = get_option('clearfy_license_key');
            if ( !empty($license_key) ) {
                $queryArgs['license_key'] = $license_key;
            }
            return $queryArgs;
        }



        public function check_license() {
            $license_key    = get_option('clearfy_license_key');
            $license_verify = get_option('license_verify');
            $license_error  = get_option('license_error');

            if (!empty($license_key) && !empty($license_verify) && empty($license_error)) {
                // TODO: проверка на срок истечения $license_verify
                return true;
            }

            return false;
        }



        /**
         * Check option exist and active
         *
         * @param $name string
         * @return bool
         */
        public function check_option($name) {
            if (isset($this->options[$name]) && $this->options[$name] == 'on')
                return true;

            return false;
        }


        public function catch_404() {

            if ( ! is_404() ) return;

            require_once dirname(__FILE__) . '/inc/class-logging.php';
            $log = new Clearfy_Logging( $this->plugin_options, '404' );

            $url = esc_url($_SERVER['REQUEST_URI']);
            $referer = ( ! empty( $_SERVER['HTTP_REFERER'] ) ) ? $_SERVER['HTTP_REFERER'] : '';
            $info = array(
                'referer'   => $referer,
                'ip'        => $this->get_ip(),
            );

            $log->add( '404', $url, $info );
        }


        public function ajax_clearfy_clear_log() {

            check_ajax_referer( 'clearfy_clear_log_nonce' );

            require_once dirname(__FILE__) . '/inc/class-logging.php';
            $log = new Clearfy_Logging( $this->plugin_options, '404' );
            $log->clear();

            echo 'ok';
            die();

        }




        public function disable_admin_bar() {
            if ( ! current_user_can( 'administrator' ) ) {
                add_filter( 'show_admin_bar', '__return_false' );
            }
        }


        /**
         * Remove <image:image> from sitemap
         *
         * @since 1.0.8
         */
        public function yoast_remove_image_from_xml_sitemap() {
            add_filter( 'wpseo_xml_sitemap_img', '__return_false' );
            add_filter( 'wpseo_sitemap_url', array( $this, 'yoast_remove_image_from_xml_clean' ), 10, 2 );
        }

        public function yoast_remove_image_from_xml_clean( $output, $url ) {
            $output = preg_replace('/<image:image[^>]*?>.*?<\/image:image>/si', '', $output);
            return $output;
        }


        /**
         * Remove yoast json ld output
         *
         * @since 3.2.0
         * @return array
         */
        public function yoast_remove_json_ld() {
            return array();
        }


        /**
         * Remove replytocom
         *
         * @since    1.0.7
         */
        public function remove_replytocom_redirect() {
            if ( isset( $_GET['replytocom'] ) && is_singular() ) {
                $post_url = get_permalink( $GLOBALS['post']->ID );
                $comment_id = sanitize_text_field( $_GET['replytocom'] );
                $query_string = remove_query_arg( 'replytocom', sanitize_text_field( $_SERVER['QUERY_STRING'] ) );

                if ( ! empty( $query_string ) ) {
                    $post_url .= '?' . $query_string;
                }
                $post_url .= '#comment-' . $comment_id;

                wp_redirect( $post_url, 301 );
                die();
            }

            return false;
        }

        public function remove_replytocom_link( $link ) {
            return preg_replace( '`href=(["\'])(?:.*(?:\?|&|&#038;)replytocom=(\d+)#respond)`', 'href=$1#comment-$2', $link );
        }


        /**
         * Protect author get
         */
        public function protect_author_get() {
            if ( isset( $_GET['author'] ) && ! is_admin() ) {
                wp_redirect( home_url(), 301 );
                die();
            }
        }


        /**
         * Remove yoast comment
         */
        public function yoast_remove_head_comment() {
            if ( defined('WPSEO_VERSION') && ! is_admin() ) {

                $debug_marker = ( version_compare( WPSEO_VERSION, '4.4', '>=' ) ) ? 'debug_mark' : 'debug_marker';

                if ( class_exists( 'WPSEO_Frontend' ) && method_exists( 'WPSEO_Frontend', $debug_marker ) ) {
                    remove_action( 'wpseo_head', array( WPSEO_Frontend::get_instance(), $debug_marker ) , 2);
                }

                add_action( 'get_header', array($this, 'yoast_remove_head_comment_start') );
                add_action( 'wp_head', array($this, 'yoast_remove_head_comment_end'), 999 );
            }
        }

        public function yoast_remove_head_comment_start() {
            ob_start( array( $this, 'yoast_remove_head_comment_remove' ) );
        }

        public function yoast_remove_head_comment_end() {
            ob_end_flush();
        }

        public function yoast_remove_head_comment_remove ( $buffer ) {
            return preg_replace( '/\n?<.*?yoast.*?>/mi', '', $buffer );
        }


        /**
         * Canonical link in pagination Yoast
         *
         * @param $canonical
         *
         * @return string
         */
        public function yoast_canonical_pagination( $canonical ) {
            if ( is_category() && is_paged() ) {
                $cat = get_category( get_query_var( 'cat' ) );
                $cat_id = $cat->cat_ID;
                return get_category_link( $cat_id );
            }
            if ( is_author() && is_paged() ) {
                $canonical = get_author_posts_url( get_query_var( 'author' ), get_query_var( 'author_name' ) );
                return $canonical;
            }
            if ( is_home() && is_paged() ) {
                return home_url('/');
            }
            return $canonical;
        }


        /**
         * Set last modified to all posts and archives
         *
         * @since    0.9.7
         */
        public function set_last_modified_headers() {
			
			$last_modified_exclude = $this->options['last_modified_exclude'];

            $last_modified_exclude_exp = explode(PHP_EOL, $last_modified_exclude);
		
			$current_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
			foreach ($last_modified_exclude_exp as $expr) {
				if( ! empty($expr) && @preg_match( "~$expr~", $current_url ) ) {
					return;
				}
			}

            if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX )
              || ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST )
              || ( defined( 'REST_REQUEST' ) && REST_REQUEST )
              || ( is_admin() ) ) {
                return;
            }

            /**
             * if WooCommerce cart, checkout, account - just return
             */
            if ( class_exists( 'woocommerce' ) && function_exists('is_cart') && function_exists('is_checkout') && function_exists('is_account_page')
                 && ( is_cart() || is_checkout() || is_account_page() ) ) return;

            /**
             * if Search - just return
             */
            if ( is_search() ) return;


            $last_modified = '';


            /**
             * If posts, pages, custom post types
             */
            if ( is_singular() ) {
                global $post;

                if ( ! isset($post->post_modified_gmt) ) {
                    return;
                }

                $post_time = strtotime( $post->post_modified_gmt );
                $modified_time = $post_time;

                /**
                 * If we have comment set new modified date
                 */
                if ( (int) $post->comment_count > 0 ) {
                    $comments = get_comments( array(
                        'post_id' => $post->ID,
                        'number' => '1',
                        'status' => 'approve',
                        'orderby' => 'comment_date_gmt',
                    ) );
                    if ( ! empty($comments) && isset($comments[0]) ) {
                        $comment_time = strtotime( $comments[0]->comment_date_gmt );
                        if ( $comment_time > $post_time ) {
                            $modified_time = $comment_time;
                        }
                    }
                }

                $last_modified = str_replace('+0000', 'GMT', gmdate('r', $modified_time));

            }

            /**
             * If any archives: categories, tags, taxonomy terms, post type archives
             */
            if ( is_archive() || is_home() ) {
                global $posts;

                if ( empty($posts) ) {
                    return;
                }

                $post = $posts[0];

                if ( ! isset($post->post_modified_gmt) ) {
                    return;
                }

                $post_time = strtotime( $post->post_modified_gmt );
                $modified_time = $post_time;

                $last_modified = str_replace('+0000', 'GMT', gmdate('r', $modified_time));
            }


            /**
             * If headers already sent - do nothing
             */
            if ( headers_sent() ) {
                return;
            }


            if ( ! empty($last_modified) ) {
                header( 'Last-Modified: ' . $last_modified );

                if ( $this->check_option('if_modified_since_headers') && ! is_user_logged_in() ) {
                    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified_time) {
                        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
                        header($protocol . ' 304 Not Modified');
                    }
                }
            }
        }




        /**
         * Revisions limit
         *
         * @since     0.9.5
         */
        public function clearfy_revisions_to_keep( $num, $post ) {
            if (isset($this->options['revision_limit']) && is_numeric($this->options['revision_limit'])) {
                $num = $this->options['revision_limit'];
            }
            if ($this->check_option('revisions_disable')) {
                $num = 0;
            }
            return $num;
        }



        /**
         * Remove jquery migrate
         */
        public function remove_jquery_migrate( &$scripts ) {
            if( ! is_admin() ) {
                $scripts->remove( 'jquery' );
                $scripts->add( 'jquery', false, array('jquery-core') );
            }
        }




        /**
         * HTTP to HTTPS redirect
         *
         * @since 1.0.8
         */
        public function redirect_from_http_to_https() {
            if ( false === apply_filters( 'clearfy_redirect_from_http_to_https', true ) ) return;
            if ( is_ssl() ) return;
            if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
                wp_redirect(set_url_scheme($_SERVER['REQUEST_URI'], 'https'), 301);
            }
            else {
                wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301);
            }
            die();
        }


        /**
         * Remove url field from comment form
         *
         * @param $fields
         * @return mixed
         */
        public function remove_url_from_comment_form($fields) {
            if ( isset( $fields['url'] ) ) unset( $fields['url'] );
            return $fields;
        }


        /**
         * Convert links in comment text into span pseudo links
         *
         * @param $comment_text
         * @return mixed
         */
        public function comment_text_convert_links_pseudo($comment_text) {
            return $this->convert_links_pseudo($comment_text);
        }


        /**
         * Convert links into span pseudo links
         *
         * @param $text
         * @return mixed
         */
        public function convert_links_pseudo($text) {
            preg_match_all('/(<a.*>)(.*)(<\/a>)/ismU', $text, $text_links, PREG_SET_ORDER);
            if ( ! empty($text_links) ) {
                foreach ( $text_links as $key => $comment_link ) {
                    preg_match('/href\s*=\s*[\'|\"]\s*(.*)\s*[\'|\"]/i', $comment_link[1], $href);

                    if (
                        substr_count( $href[1], get_home_url() ) === 0 &&
                        ( substr($href[1], 0, 7) == 'http://' || substr($href[1], 0, 8) == 'https://' )
                    ) {
                        $prepared_link = $text_links[$key][0];
                        $prepared_link = str_replace('<a', '<span class="pseudo-clearfy-link"', $prepared_link);
                        $prepared_link = str_replace('</a>', '</span>', $prepared_link);
                        $prepared_link = str_replace('href=', 'data-uri=', $prepared_link);

                        $text = str_replace($text_links[$key][0], $prepared_link, $text);
                    }
                }
            }

            return $text;
        }


        /**
         * Convert author link to pseudo link
         *
         * @return string
         */
        public function pseudo_comment_author_link( $return, $author, $comment_ID ){

            $url    = get_comment_author_url( $comment_ID );
            $author = get_comment_author( $comment_ID );

            if ( empty( $url ) || 'http://' == $url )
                $return = $author;
            else
                $return = '<span class="pseudo-clearfy-link" data-uri="'. $url .'">'. $author .'</span>';
            return $return;
        }


        /**
         * Noindex pagination
         */
        public function noindex_pagination() {
            if ( is_paged() ) {
                echo '<meta name="robots" content="noindex,follow">' . PHP_EOL;
            }
        }

        public function noindex_pagination_filter( $value ) {
            if ( is_paged() ) {
                return 'noindex,follow';
            }
            return $value;
        }



        public function add_pseudo_link_style() {

            $styles = '';

            echo '<style>';

            $styles .= '.pseudo-clearfy-link {';
            $styles .= ' color: #008acf;';
            $styles .= ' cursor: pointer;';
            $styles .= '}';
            $styles .= '.pseudo-clearfy-link:hover {';
            $styles .= ' text-decoration: none;';
            $styles .= '}';

            echo apply_filters( 'clearfy_pseudo_links_style', $styles );

            echo '</style>';
        }



        public function add_pseudo_link_scripts() {
            echo '<script type="text/javascript">';
            echo 'var pseudo_links = document.querySelectorAll(".pseudo-clearfy-link");';
            echo 'for (var i=0;i<pseudo_links.length;i++ ) { ';
            echo 'pseudo_links[i].addEventListener("click", function(e){ ';
            echo '  window.open( e.target.getAttribute("data-uri") ); ';
            echo '}); ';
            echo '}';
            echo '</script>';
        }



        /**
         * Change login error message
         *
         * @return string
         */
        public function change_login_errors(){
            if ( get_bloginfo('language') == 'ru-RU' ) {
                return '<strong>ОШИБКА</strong>: Неверный логин или пароль';
            } else {
                return '<strong>ERROR</strong>: Invalid Username or Password';
            }
        }


        /**
         * Add post title in image alt attribute
         *
         * @param $content
         * @return mixed
         */
        public function content_image_auto_alt($content) {
            global $post;
            $pattern = array( ' alt=""', ' alt=\'\'' );
            $replacement = array( ' alt="' . esc_attr($post->post_title) . '"', ' alt=\'' . esc_attr($post->post_title) . '\'' );
            $content = str_replace($pattern, $replacement, $content);
            return $content;
        }





        /**
         * Attachment pages redirect
         */
        public function attachment_pages_redirect() {
            global $post;
            if ( is_attachment() ) {
                if ( isset($post->post_parent) && ($post->post_parent != 0) ) {
                    wp_redirect( get_permalink($post->post_parent), 301 );
                } else {
                    wp_redirect( home_url(), 301 );
                }
                exit;
            }
        }








        /**
         * Remove single pagination duplicate
         */
        public function remove_single_pagination_duplicate() {
            if( is_singular() && ! is_front_page() ) {
                global $post, $page;

                // if woocommerce just return
                if ( class_exists( 'woocommerce' )
                     && function_exists('is_cart') && function_exists('is_checkout') && function_exists('is_woocommerce') && function_exists('is_account_page')
                     && ( is_cart() || is_checkout() || is_woocommerce() || is_account_page() ) ) return;

                $num_pages = substr_count( $post->post_content, '<!--nextpage-->' ) + 1;
                if ( $page > $num_pages ){
                    if ( apply_filters( 'remove_single_pagination_duplicate_before_redirect', true ) ) :
                        wp_redirect(get_permalink( $post->ID ));
                        exit;
                    endif;
                }
            }
        }




        /**
         * Remove last item from breadcrumbs SEO by YOAST
         * http://www.wpdiv.com/remove-post-title-yoast-seo-plugin-breadcrumb/
         */
        public function remove_last_item_breadcrumb_yoast( $link_output ) {
            if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
                $link_output = '';
            }
            return $link_output;
        }




        /**
         * Replace last item from breadcrumbs on title SEO by YOAST
         */
        public function replace_last_item_breadcrumb_yoast_on_title( $link_output ) {
            $title_yoast = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true );

            if ( ! empty( $title_yoast ) && strpos( $link_output, 'breadcrumb_last' ) !== false ) {
                $link_output = $title_yoast;
            }

            return $link_output;
        }




        /**
         * Deleted unnecessary link in admin bar
         */
        public function remove_unnecessary_link_admin_bar() {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('wp-logo');
            $wp_admin_bar->remove_menu('about');
            $wp_admin_bar->remove_menu('wporg');
            $wp_admin_bar->remove_menu('documentation');
            $wp_admin_bar->remove_menu('support-forums');
            $wp_admin_bar->remove_menu('feedback');
            $wp_admin_bar->remove_menu('view-site');
        }




        /**
         * Message cookie
         */
        public function add_message_cookie() {

            $cookie_message_text = $this->plugin_options->get_option( 'cookie_message_text' );
            $cookie_message_position = $this->plugin_options->get_option( 'cookie_message_position', $this->plugin_options->default_options['cookie_message_position'] );
            $cookie_message_button_text = $this->plugin_options->get_option( 'cookie_message_button_text', $this->plugin_options->default_options['cookie_message_button_text'] );
            $cookie_message_color = $this->plugin_options->get_option( 'cookie_message_color', $this->plugin_options->default_options['cookie_message_color'] );
            $cookie_message_background = $this->plugin_options->get_option( 'cookie_message_background', $this->plugin_options->default_options['cookie_message_background'] );
            $cookie_message_button_background = $this->plugin_options->get_option( 'cookie_message_button_background', $this->plugin_options->default_options['cookie_message_button_background'] );

            $out = '';
            $out .= '<style>';
            $out .= '.clearfy-cookie { position:fixed; left:0; right:0; bottom:0; padding:12px; color:' . $cookie_message_color . '; background:' . $cookie_message_background . '; -webkit-box-shadow:0 0 15px rgba(0,0,0,.2); -moz-box-shadow:0 0 15px rgba(0,0,0,.2); box-shadow:0 0 15px rgba(0,0,0,.2); z-index:9999; font-size: 13px; transition: .3s; }';
            $out .= '.clearfy-cookie--left { left: 20px; bottom: 20px; right: auto; max-width: 400px; }';
            $out .= '.clearfy-cookie--right { left: auto; bottom: 20px; right: 20px; max-width: 400px; }';
            $out .= '.clearfy-cookie.clearfy-cookie-hide { transform: translateY(150%) translateZ(0); opacity: 0; }';
            $out .= '.clearfy-cookie-container { max-width:1170px; margin:0 auto; text-align:center; }';
            $out .= '.clearfy-cookie-accept { background:' . $cookie_message_button_background . '; color:#fff; border:0; padding:.4em .8em; margin: 0 .5em; font-size: 13px; }';
            $out .= '.clearfy-cookie-accept:hover,.clearfy-cookie-accept:focus { opacity: .9; }';
            $out .= '</style>';

            $out .= '<div id="clearfy-cookie" class="clearfy-cookie clearfy-cookie--' . $cookie_message_position . '">';
            $out .= '  <div class="clearfy-cookie-container">';
            $out .= '   ' . $cookie_message_text;
            $out .= '   <button id="clearfy-cookie-accept" class="clearfy-cookie-accept">' . $cookie_message_button_text . '</button>';
            $out .= '  </div>';
            $out .= '</div>';

            $out .= '<script>';
            $out .= 'document.getElementById("clearfy-cookie-accept").onclick = function() {';
            $out .= ' document.getElementById("clearfy-cookie").className += " clearfy-cookie-hide";';
            $out .= ' var clearfy_cookie_date = new Date(new Date().getTime() + 31536000 * 1000);'; // year
            $out .= ' document.cookie = "clearfy_cookie_hide=yes; path=/; expires=" + clearfy_cookie_date.toUTCString();';
            $out .= ' setTimeout(function() { document.getElementById("clearfy-cookie").parentNode.removeChild( document.getElementById("clearfy-cookie") ); }, 300);';
            $out .= '}';
            $out .= '</script>';

            echo $out;

        }


        /**
         * Disable keystrokes
         */
        public function disable_keystrokes() {
            echo '<script>';
            echo 'function disable_keystrokes(e) {';
            echo 'if (e.ctrlKey){';
            echo 'var key;';
            echo 'if(window.event)';
            echo 'key = window.event.keyCode;';
            echo 'else ';
            echo 'key = e.which;';
            echo 'if (key == 97 || key == 65 || key == 67 || key == 99 || key == 88 || key == 120 || key == 26 || key == 85  || key == 86 || key == 83 || key == 43)';
            echo 'return false;';
            echo 'else ';
            echo 'return true;';
            echo '}';
            echo '}';
            echo 'document.onkeydown = disable_keystrokes;';
            echo '</script>';
        }
      

        /**
         * Disable selection text
         */
        public function add_disable_selection_text_scripts() {
            echo '<script>';
            echo 'function disableSelection(target){';
            echo 'if (typeof target.onselectstart!="undefined")';
            echo ' target.onselectstart=function(){return false};';
            echo 'else if (typeof target.style.MozUserSelect!="undefined")';
            echo 'target.style.MozUserSelect="none";';
            echo 'else';
            echo ' target.onmousedown=function(){return false};';
            echo 'target.style.cursor = "default"';
            echo '}';
            echo 'disableSelection(document.body);';
            echo '</script>';
        }
      
      
        /**
         * Disable right click
         */
        public function disable_right_click() {
            echo '<script>';
            echo 'document.oncontextmenu = function() { return false; }';
            echo '</script>';
        }
      
      
        /**
         * Add source to link when copying text
         */
        public function add_copy_source_link_scripts() {

            if ( ! empty( $this->options['copy_source_link_text'] ) ) {
                $source_text = $this->options['copy_source_link_text'];
            } else {
                $source_text = __( '<br>Source: %link%', $this->plugin_options->text_domain );
            }

            $source_text = str_replace('"', '\"', $source_text);

            echo '<script>';
            echo 'document.oncopy = function () {';
            echo 'var bodyElement = document.body;';
            echo 'var selection = getSelection();';
            echo 'var link_url = document.URL;';
            echo 'var page_link = "' .  $source_text  . '";';
            echo 'page_link = page_link.replace("%link%", " " + link_url + " ");';
            echo 'var copy_text = selection + page_link;';
            echo 'var divElement = document.createElement("div");';
            echo 'divElement.style.position="absolute";';
            echo 'divElement.style.left="-99999px";';
            echo 'bodyElement.appendChild(divElement);';
            echo 'divElement.innerHTML = copy_text;';
            echo 'selection.selectAllChildren(divElement);';
            echo 'window.setTimeout(function() {';
            echo 'bodyElement.removeChild(divElement);';
            echo '},0);';
            echo '}';
            echo '</script>';
        }






        /**
         * Disable gravatars
         */
        public function replace_gravatar( $avatar, $id_or_email, $size, $default, $alt, $args ) {

            if ( ! empty( $avatar ) && ! is_admin() ) {
                $default_avatar = plugin_dir_url(__FILE__) . 'assets/images/default-avatar.png';
                $avatar = preg_replace( '/src=(\'|")(.+?)(\'|")/', 'src=$1' . $default_avatar . '$3' , $avatar );
                $avatar = preg_replace( '/srcset=(\'|")(.+?)(\'|")/', 'srcset=$1' . $default_avatar . ' 2x$3', $avatar );
            }

            return $avatar;
        }





        /**
         * Remove useless widgets and MySQL queries
         */
        public function remove_unneeded_widgets() {
            if ($this->check_option('remove_unneeded_widget_page')) {
                unregister_widget('WP_Widget_Pages');
            }
            if ($this->check_option('remove_unneeded_widget_calendar')) {
                unregister_widget('WP_Widget_Calendar');
            }
            if ($this->check_option('remove_unneeded_widget_tag_cloud')) {
                unregister_widget('WP_Widget_Tag_Cloud');
            }
        }





        /**
         * Redirect archives author, date, tags
         */
        public function redirect_archives() {
            if ($this->check_option('redirect_archives_author')) {
                if (is_author() && ! is_admin()) {
                    wp_redirect(home_url(), 301);
                    die();
                }
            }

            if ($this->check_option('redirect_archives_date')) {
                if (is_date() && ! is_admin()) {
                    wp_redirect(home_url(), 301);
                    die();
                }
            }

            if ($this->check_option('redirect_archives_tag')) {
                if (is_tag() && ! is_admin()) {
                    wp_redirect(home_url(), 301);
                    die();
                }
            }
        }


        /**
         * Remove versions
         *
         * @param $src
         * @param $handle
         *
         * @return string
         */
        public function remove_versions_styles_scripts( $src, $handle ) {

            if ( is_admin() ) return $src;

            if ( strpos( $src, 'ver=' ) ) {
                $src = remove_query_arg( 'ver', $src );
            }

            return $src;

        }




        /**
         * Disable feeds
         */
        public function disable_feed() {
            //Remove feed links from the <head> section
            remove_action( 'wp_head', 'feed_links_extra', 3 );
            remove_action( 'wp_head', 'feed_links', 2 );

            //Redirect feed URLs to home page
            add_action( 'do_feed', array( $this, 'disable_feed_redirect' ), 1 );
            add_action( 'do_feed_rdf', array( $this, 'disable_feed_redirect' ), 1 );
            add_action( 'do_feed_rss', array( $this, 'disable_feed_redirect' ), 1 );
            add_action( 'do_feed_rss2', array( $this, 'disable_feed_redirect' ), 1 );
            add_action( 'do_feed_atom', array( $this, 'disable_feed_redirect' ), 1 );

        }

        public function disable_feed_redirect() {

            // if GET param - remove and redirect
            if( isset( $_GET['feed'] ) ) {
                wp_redirect( esc_url_raw( remove_query_arg( 'feed' ) ), 301 );
                exit;
            }

            // if beauty permalink - remove and redirect
            if( get_query_var( 'feed' ) !== 'old' ) {
                set_query_var( 'feed', '' );
            }
            redirect_canonical();

            wp_redirect( get_option( 'siteurl' ), 301 );
            die();
        }




        /**
         * Add directories to virtual robots.txt file
         */
        public function right_robots_txt( $output ) {

            if ( isset($this->options['robots_txt_text']) && !empty($this->options['robots_txt_text']) ) {
                return $this->options['robots_txt_text'];
            }

            $site_url = get_home_url();
            $site_url_clear = str_replace('http://', '', $site_url);
            $site_url_clear = str_replace('https://', '', $site_url_clear);

            if ( is_ssl() ) {
                $dir_host = 'https://' . $site_url_clear;
            } else {
                $dir_host = $site_url_clear;
            }

            $output  = 'User-agent: *' . PHP_EOL;
            //$output .= 'Disallow: /cgi-bin' . PHP_EOL;
            $output .= 'Disallow: /wp-admin' . PHP_EOL;
            $output .= 'Disallow: /wp-includes' . PHP_EOL;
            $output .= 'Disallow: /wp-content/plugins' . PHP_EOL;
            $output .= 'Disallow: /wp-content/cache' . PHP_EOL;
            //$output .= 'Disallow: /wp-content/themes' . PHP_EOL;
            $output .= 'Disallow: /wp-json/' . PHP_EOL;
            $output .= 'Disallow: /xmlrpc.php' . PHP_EOL;
            $output .= 'Disallow: /readme.html' . PHP_EOL;
            //$output .= 'Disallow: */trackback' . PHP_EOL;
            //$output .= 'Disallow: */feed' . PHP_EOL;
            //$output .= 'Disallow: */comments' . PHP_EOL;
            $output .= 'Disallow: /*?' . PHP_EOL;
            $output .= 'Disallow: /?s=' . PHP_EOL;
            $output .= 'Allow: /*.css' . PHP_EOL;
            $output .= 'Allow: /*.js' . PHP_EOL;

            /**
             * Check sitemaps
             */
            if ( function_exists( 'get_headers' ) ):
                $get_headers = @get_headers($site_url . '/sitemap.xml', 1);

                // standart path
                if ( preg_match( '#200 OK#i', $get_headers[0] ) ) {
                    $output .= 'Sitemap: ' . $site_url . '/sitemap.xml' . PHP_EOL;

                // if redirect, like yoast example
                } else if ( isset($get_headers['Location']) && !empty($get_headers['Location']) ) {
                    $output .= 'Sitemap: ' . $get_headers['Location'] . PHP_EOL;
                }
            endif;

            return $output;
        }



        /**
         * Remove X-Pingback
         * https://github.com/nickyurov/
         */
        public function remove_x_pingback( $headers ) {
            unset( $headers['X-Pingback'] );
            return $headers;
        }

        public function remove_x_pingback_headers( $headers ) {
            if ( function_exists('header_remove') ) {
                header_remove('X-Pingback');
                header_remove('Server');
            }
        }


        /**
         * Remove styles for .recentcomments a
         * .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
         * https://github.com/nickyurov/
         */
        public function remove_recent_comments_style() {
            global $wp_widget_factory;
            remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
        }


        /**
         * Disable JSON API
         */
        public function remove_rest_api() {

            remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
            remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
            remove_action( 'template_redirect', 'rest_output_link_header', 11 );

            // remove oembed links
            remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

            add_filter( 'rest_authentication_errors', array( $this, 'rest_authentication_errors' ), 20 );
        }

        public function rest_authentication_errors( $access ) {

            if ( apply_filters( 'clearfy_rest_api_logged_in', true ) && is_user_logged_in() ) return $access;

            $rest_route = $this->get_rest_route();

            $white_list = apply_filters( 'clearfy_rest_api_white_list', array(
                'contact-form-7',
            ) );

            if ( ! empty( $rest_route ) ) {

                $is_white_list = false;
                foreach ( $white_list as $item ) {
                    if ( preg_match( '/' . $item . '/i', $rest_route ) ) $is_white_list = true;
                }

                if ( ! $is_white_list ) {

                    if ( apply_filters( 'clearfy_rest_api_redirect', true ) ) {
                        wp_redirect( get_option( 'siteurl' ), 301 );
                        die();
                    } else {
                        return new WP_Error( 'rest_cannot_access', esc_html__( 'Access denied by Clearfy Pro.', $this->plugin_options->text_domain ), array( 'status' => rest_authorization_required_code() ) );
                    }
                }
            }

            return $access;

        }

        private function get_rest_route() {
            $rest_route = $GLOBALS['wp']->query_vars['rest_route'];

            if ( empty( $rest_route ) || '/' == $rest_route ) {
                return $rest_route;
            }

            return untrailingslashit( $rest_route );
        }



        /**
         * Remove unnecessary tags from head
         */
        public function remove_tags_from_head() {
            if ($this->check_option('remove_meta_generator')) {
                remove_action( 'wp_head', 'wp_generator' );
                add_filter( 'the_generator', '__return_empty_string' );
            }
            if ( $this->check_option('remove_dns_prefetch') ) {
                remove_action( 'wp_head', 'wp_resource_hints', 2 );
            }
            if ($this->check_option('remove_rsd_link'))         remove_action( 'wp_head', 'rsd_link' );
            if ($this->check_option('remove_wlw_link'))         remove_action( 'wp_head', 'wlwmanifest_link' );
            if ($this->check_option('remove_adjacent_posts_link'))  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
            if ($this->check_option('remove_adjacent_posts_link'))  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
            if ($this->check_option('remove_shortlink_link')) {
                remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
                remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
            }
            //remove_action( 'wp_head', 'index_rel_link' );
            //remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
            //remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
        }


        /**
         * Disable Emojis
         * URI: https://geek.hellyer.kiwi/plugins/disable-emojis/
         * Version: 1.5.1
         * Author: Ryan Hellyer
         * Author URI: https://geek.hellyer.kiwi/
         * License: GPL2
         */
        public function disable_emojis() {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
            add_filter( 'tiny_mce_plugins', array($this, 'disable_emojis_tinymce') );
        }

        /**
         * Filter function used to remove the tinymce emoji plugin.
         *
         * @param    array  $plugins
         * @return   array             Difference betwen the two arrays
         */
        public function disable_emojis_tinymce( $plugins ) {
            if ( is_array( $plugins ) ) {
                return array_diff( $plugins, array( 'wpemoji' ) );
            } else {
                return array();
            }
        }

        private function get_ip() {
            if ( function_exists( 'get_ip' ) ) {
                $ip = get_ip();
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

    }

    new Clearfy_Plugin();

endif;