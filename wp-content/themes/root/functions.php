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
 *   ВЫ МОЖЕТЕ ИСПОЛЬЗОВАТЬ НАШ ПЛАГИН
 *   https://docs.wpshop.ru/profunctions/
 *
 * *****************************************************************************
 *
 * @package Root
 */




/**
 * ВНИМАНИЕ!
 *
 * НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ,
 * ПРИ ОБНОВЛЕНИИ ВЫ ПОТЕРЯЕТЕ ВСЕ ВАШИ ИЗМЕНЕНИЯ
 *
 * Используйте наш плагин https://docs.wpshop.ru/profunctions/
 */





/**
 * ВНИМАНИЕ!
 *
 * НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ,
 * ПРИ ОБНОВЛЕНИИ ВЫ ПОТЕРЯЕТЕ ВСЕ ВАШИ ИЗМЕНЕНИЯ
 *
 * Используйте наш плагин https://docs.wpshop.ru/profunctions/
 */



/**
 * Версия темы
 */
$theme_version = '2.2.4';


if ( ! function_exists( 'root_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function root_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Root, use a find and replace
	 * to change 'root' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'root', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

    /*
     * Add new image size
     */
    $thumb_big_sizes  = apply_filters( 'root_thumb_big_sizes', array( 770, 330, true ) );
    $thumb_wide_sizes = apply_filters( 'root_thumb_wide_sizes', array( 330, 140, true ) );
    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'thumb-big', $thumb_big_sizes[0], $thumb_big_sizes[1], $thumb_big_sizes[2]);
        add_image_size( 'thumb-wide', $thumb_wide_sizes[0], $thumb_wide_sizes[1], $thumb_wide_sizes[2] );
    }

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top_menu'    => esc_html__( 'Top menu', 'root' ),
		'header_menu' => esc_html__( 'Header menu', 'root' ),
		'footer_menu' => esc_html__( 'Footer menu', 'root' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	/*add_theme_support( 'post-formats', array(
		'image',
		'video',
		'quote',
		'link',
	) );*/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'revelation_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'root_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function root_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'root_content_width', 700 );
}
add_action( 'after_setup_theme', 'root_content_width', 0 );




/**
 * Register widget area.
 */
function root_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'root' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'root' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'root_widgets_init' );





/**
 * Enqueue scripts and styles.
 */
function root_scripts() {
    global $theme_version;

    $root_main_fonts            = root_get_option( 'typography_family' );
    $root_main_fonts_headers    = root_get_option( 'typography_headers_family' );
    $root_skin                  = root_get_option( 'skin' );

    global $fonts;
    $fonts_style = array();
    foreach ( $fonts as $key => $val ) {
        $fonts_style[$key] = $val['url'];
    }

    if ( isset( $fonts_style[ $root_main_fonts ] ) ) {
        wp_enqueue_style('google-fonts', $fonts_style[ $root_main_fonts ], false);
    }

    if ( isset( $fonts_style[ $root_main_fonts_headers ] ) && $root_main_fonts != $root_main_fonts_headers ) {
        wp_enqueue_style('google-fonts-headers', $fonts_style[ $root_main_fonts_headers ], false);
    }

    $style_version = apply_filters( 'root_style_version', $theme_version );

	wp_enqueue_style(  'root-style',   get_template_directory_uri() . '/css/style.min.css', array(), $style_version );

	if ( $root_skin == 'skin-1' ) {
        wp_enqueue_style( 'root-skin-1', get_template_directory_uri() . '/css/skin-1.css', array(), $style_version );
    }

	if ( $root_skin == 'skin-2' ) {
        wp_enqueue_style( 'root-skin-2', get_template_directory_uri() . '/css/skin-2.css', array(), $style_version );
    }

    wp_enqueue_script( 'root-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), $style_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function root_admin_scripts() {
    wp_enqueue_style( 'root-admin-style', get_template_directory_uri() . '/css/style.admin.css', array(), null );
    wp_enqueue_script( 'root-admin-scripts', get_template_directory_uri() . '/js/admin.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'root_scripts' );
add_action( 'admin_enqueue_scripts', 'root_admin_scripts' );




/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * WPShop.biz functions
 */
require get_template_directory() . '/inc/wpshopbiz.php';

/**
 * Clear WP
 */
require get_template_directory() . '/inc/clear-wp.php';

/**
 * Pseudo links
 */
require get_template_directory() . '/inc/pseudo-links.php';

/**
 * Sitemap
 */
require get_template_directory() . '/inc/sitemap.php';

/**
 * Contact Form
 */
require get_template_directory() . '/inc/contact-form.php';

/**
 * Top commentators
 */
require get_template_directory() . '/inc/top-commentators.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * TinyMCE
 */
if ( is_admin() ) {
    require get_template_directory() . '/inc/tinymce.php';
}

/**
 * Comments
 */
require get_template_directory() . '/inc/comments.php';


/**
 * Smiles
 */
require get_template_directory() . '/inc/smiles.php';


/**
 * Taxonomy header h1
 */
require get_template_directory() . '/inc/taxonomy-header.php';


/**
 * Thumbnails
 */
require get_template_directory() . '/inc/thumbnails.php';


/**
 * Additional functions
 */
require get_template_directory() . '/inc/core/additional-functions.php';


/**
 * Metaboxes
 */
require get_template_directory() . '/inc/core/metaboxes.php';
require get_template_directory() . '/inc/metaboxes.php';


/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/core/breadcrumbs.php';


/**
 * Transliteration
 */
require get_template_directory() . '/inc/core/transliteration.php';


/**
 * TOC
 */
require get_template_directory() . '/inc/core/toc.php';


/**
 * The designer
 */
//require get_template_directory() . '/inc/the-designer/the-designer.php';



/**
 * Admin
 */
require get_template_directory() . '/inc/admin.php';


/**
 * Admin Ad
 */
require get_template_directory() . '/inc/admin-ad.php';

/**
 * Theme updater
 */
require get_template_directory() . '/inc/theme-update-checker.php';

$theme_name 		= 'root';

$revelation_options = get_option('revelation_options');
if ( isset($revelation_options['license']) && !empty($revelation_options['license']) ) {

    $update_checker = new ThemeUpdateChecker(
        'root',
        'https://api.wpgenerator.ru/wp-update-server/?action=get_metadata&slug='. $theme_name . '&license_key=' . $revelation_options['license']
    );

}



/********************************************************************
 * Editor styles
 *******************************************************************/
function root_add_editor_style() {
    add_editor_style( 'css/editor-styles.css' );
}
add_action( 'current_screen', 'root_add_editor_style' );



/********************************************************************
 * Excerpt
 *******************************************************************/
if ( ! function_exists( 'new_excerpt_length' ) ):
    function new_excerpt_length( $length ) {
        return apply_filters( 'root_excerpt_length', 28 );
    }
    add_filter( 'excerpt_length', 'new_excerpt_length' );
endif;

if ( ! function_exists( 'change_excerpt_more' ) ):
    function change_excerpt_more( $more ) {
        return apply_filters( 'root_excerpt_more', '...' );
    }
    add_filter( 'excerpt_more', 'change_excerpt_more' );
endif;



/********************************************************************
 * Breadcrumbs
 *******************************************************************/
/**
 * Remove last item from breadcrumbs SEO by YOAST
 * http://www.wpdiv.com/remove-post-title-yoast-seo-plugin-breadcrumb/
 */
function adjust_single_breadcrumb( $link_output) {
    if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
        $link_output = '';
    }
    return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb' );



/********************************************************************
 * Микроразметка для изображений
 *******************************************************************/
if ( ! function_exists('microformat_image') ):
    function microformat_image($content) {
        $pattern  = '/<img (.*?) width="(.*?)" height="(.*?)" (.*?)>/i';
        $replace = '<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url image" \\1 width="\\2" height="\\3" \\4><meta itemprop="width" content="\\2"><meta itemprop="height" content="\\3"></span>';
        $content = preg_replace($pattern, $replace, $content);
        return $content;
    }
    add_filter('the_content', 'microformat_image', 999);
endif;




/**
 * Remove h2 from pagination and navigation
 */
function change_navigation_markup_template( $template, $class ) {
    $template = '
	<nav class="navigation %1$s" role="navigation">
		<div class="screen-reader-text">%2$s</div>
		<div class="nav-links">%3$s</div>
	</nav>';
    return $template;
};

add_filter( 'navigation_markup_template', 'change_navigation_markup_template', 10, 2 );








/**
 * Remove current link in menu
 *
 * @param $nav_menu
 * @param $args
 * @return mixed
 */
function remove_current_links_from_menu( $nav_menu, $args )
{
    preg_match_all('/<li(.+?)class="(.+?)current-menu-item(.+?)>(<a(.+?)>(.+?)<\/a>)/ui', $nav_menu, $matches);

    if ( isset($matches[4]) && !empty($matches[4]) && preg_match('/<a/ui', $matches[4][0]) ) {
        foreach ($matches[4] as $k => $v) {
            if ( ! is_paged() ) {
				$nav_menu = str_replace($v, '<span class="removed-link">' . $matches[6][$k] . '</span>', $nav_menu);
			}
        }
    }

    return $nav_menu;
}

add_filter( 'wp_nav_menu', 'remove_current_links_from_menu', PHP_INT_MAX, 2 );




/**
 * Remove hentry from post classes
 */
add_filter( 'post_class', 'remove_hentry_from_post_classes' );
function remove_hentry_from_post_classes( $classes ) {
    $classes = str_replace( 'hentry', '', $classes );
    return $classes;
}




function root_options_defaults() {
    $defaults = apply_filters( 'root_options_defaults', array(
        'header_padding_top'    => 0,
        'header_padding_bottom' => 0,
        'header_width'          => 'fixed',
        'header_inner_width'    => 'full',
        'header_social'         => 'yes',
        'header_html_block_1'   => '',
        'header_html_block_2'   => '',
        'header_search_mob'     => 'yes',

        'navigation_main_width'         => 'fixed',
        'navigation_main_inner_width'   => 'full',
        'navigation_main_fixed'         => 'no',

        'navigation_footer_width'       => 'fixed',
        'navigation_footer_inner_width' => 'full',
        'navigation_footer_mob'         => 'no',

        'footer_width'          => 'fixed',
        'footer_inner_width'    => 'full',
        'footer_social'         => 'yes',

        'skin'                  => 'no',
        'bg_pattern'            => 'no',

        'header_bg'             => '',
        'header_bg_repeat'      => 'no-repeat',
        'header_bg_position'    => 'center center',

        'logotype_image'        => '',
        'header_hide_title'     => 'no',

        'structure_sidebar_mob' => 'no',

        'color_main'            => '#5a80b1',
        'color_link'            => '#428bca',
        'color_link_hover'      => '#e66212',
        'color_text'            => '#333333',
        'color_logo'            => '#5a80b1',
        'color_description'     => '#666666',
        'color_menu_bg'         => '#5a80b1',
        'color_menu'            => '#ffffff',

        'footer_copyright'      => '© %year% ' . get_bloginfo( 'name' ),
        'footer_counters'       => '',
        'footer_text'           => '',

        'structure_home_posts'          => 'post-box',
        'structure_home_sidebar'        => 'right',
        'structure_home_h1'             => '',
        'structure_home_text'           => '',
        'structure_home_position'       => 'bottom',

        'structure_single_sidebar'          => 'right',
        'structure_single_thumb'            => 'yes',
        'structure_single_author'           => 'yes',
        'structure_single_date'             => 'yes',
        'structure_single_category'         => 'yes',
        'structure_single_social'           => 'yes',
        'structure_single_excerpt'          => 'yes',
        'structure_single_comments_count'   => 'yes',
        'structure_single_views'            => 'yes',
        'structure_single_tags'             => 'yes',
        'structure_single_social_bottom'    => 'yes',
        'structure_single_related'          => '6',
        'structure_single_comments'         => 'yes',

        'structure_page_sidebar'            => 'right',
        'structure_page_social'             => 'no',
        'structure_page_thumb'              => 'no',
        'structure_page_social_bottom'      => 'no',
        'structure_page_related'            => '6',
        'structure_page_comments'           => 'no',

        'structure_archive_posts'           => 'post-box',
        'structure_archive_sidebar'         => 'right',
        'structure_child_categories'        => 'yes',
        'structure_archive_description'     => 'top',

        'structure_posts_tag'               => 'div',
        'structure_posts_author'            => 'yes',
        'structure_posts_date'              => 'yes',
        'structure_posts_category'          => 'yes',
        'structure_posts_excerpt'           => 'yes',
        'structure_posts_comments'          => 'yes',
        'structure_posts_views'             => 'yes',

        'structure_social_js'               => 'yes',

        'toc_enabled'                       => 'no',
        'toc_noindex'                       => false,
        'toc_minimum_headers'               => 3,
        'toc_max_length'                    => 40,
        'toc_place'                         => 'before_header',

        'breadcrumbs_display'               => 'yes',
        'breadcrumbs_home_text'             => __( 'Home', 'root' ),
        'breadcrumbs_separator'             => '»',

        'social_facebook'  => '',
        'social_vk'        => '',
        'social_twitter'   => '',
        'social_ok'        => '',
        'social_gp'        => '',
        'social_telegram'  => '',
        'social_youtube'   => '',
        'social_instagram' => '',
        'social_linkedin'  => '',

        'code_head'                 => '',
        'code_body'                 => '',
        'code_after_content'        => '',

        'typography_family'         => 'roboto',
        'typography_font_size'      => '16',
        'typography_line_height'    => '1.5',
        'typography_headers_family' => 'roboto',

        'structure_arrow'           => 'yes',
        'structure_arrow_bg'        => '#cccccc',
        'structure_arrow_color'     => '#ffffff',
        'structure_arrow_width'     => '50',
        'structure_arrow_height'    => '50',
        'structure_arrow_icon'      => '\f102',
        'structure_arrow_mob'       => 'no',

        'comments_text_before_submit'   => '',
        'comments_date'                 => 'yes',
        'comments_smiles'               => 'yes',
    ) );
    return $defaults;
}

function root_options() {
    $root_options = wp_parse_args(
        get_option( 'root_options', array() ),
        root_options_defaults()
    );

    return $root_options;
}

function root_get_option( $option ) {
    $root_options = root_options();

    return ( isset($root_options[$option]) ) ? $root_options[$option] : '' ;
}


/**
 * Site header classes
 */
function root_site_header_classes() {
    $option = root_get_option('header_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_site_header_classes', $out_class );
    echo $classes;
}

/**
 * Site header inner classes
 */
function root_site_header_inner_classes() {
    $option = root_get_option('header_inner_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_site_header_inner_classes', $out_class );
    echo $classes;
}

/**
 * Main navigation classes
 */
function root_navigation_main_classes() {
    $option = root_get_option('navigation_main_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_navigation_main_classes', $out_class );
    echo $classes;
}

/**
 * Main navigation inner classes
 */
function root_navigation_main_inner_classes() {
    $option = root_get_option('navigation_main_inner_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_navigation_main_inner_classes', $out_class );
    echo $classes;
}

function root_site_content_classes() {
    global $post;
    if ( ( is_single() || is_page() ) && 'checked' == get_post_meta( $post->ID, 'site_full_width', true ) ) {
        $classes = apply_filters('root_site_content_classes', '');
        echo $classes;
    }
    else {
        $classes = apply_filters('root_site_content_classes', 'container');
        echo $classes;
    }
}

function root_site_footer_classes() {
    $option = root_get_option('footer_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_site_footer_classes', $out_class );
    echo $classes;
}

function root_site_footer_inner_classes() {
    $option = root_get_option('footer_inner_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_site_footer_inner_classes', $out_class );
    echo $classes;
}

function root_navigation_footer_classes() {
    $option = root_get_option('navigation_footer_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_navigation_footer_classes', $out_class );
    echo $classes;
}

function root_navigation_footer_inner_classes() {
    $option = root_get_option('navigation_footer_inner_width');
    $out_class = ( $option == 'fixed' ) ? 'container' : '';

    $classes = apply_filters( 'root_navigation_footer_inner_classes', $out_class );
    echo $classes;
}

/**
 * Content full width
 */
add_action( 'wp_head', 'root_styles_content_full_width' );

function root_styles_content_full_width() {

    if ( is_single() || is_page() ) {
        global $post;

        if ( 'checked' == get_post_meta( $post->ID, 'content_full_width', true ) ) {
            echo '<style>body.sidebar-none .breadcrumb, body.sidebar-none .entry-title, body.sidebar-none .entry-meta, body.sidebar-none .entry-content, body.sidebar-none .b-subscribe {max-width: 1090px;}body.sidebar-none .comments-area {max-width: 1090px; margin-left: auto; margin-right: auto;}</style>';
        }
    }

}

/**
 * Site full width
 */
add_action( 'wp_head', 'root_styles_site_full_width' );

function root_styles_site_full_width() {

    if ( is_single() || is_page() ) {
        global $post;
      
        if ( 'checked' == get_post_meta( $post->ID, 'site_full_width', true ) ) {
            echo '<style>@media (min-width: 992px) {.content-area { width: calc(100% - 360px); max-width: 820px;}body.sidebar-none .content-area {width: auto; max-width: 100%;}.b-related {margin-bottom: 30px; max-width: 700px; margin-left: auto; margin-right: auto;}body.sidebar-none .b-related {max-width: 940px; margin-right: auto; margin-left: auto;}}@media (min-width: 1200px) {.content-area {width: calc(100% - 430px); max-width: 1400px;}body.sidebar-none .b-related {max-width: 1090px; margin-right: auto; margin-left: auto;}}</style>';
        }
    }

}

/**
 * Remove role="navigation" for best validation w3
 *
 * @param $template
 * @param $class
 *
 * @return mixed
 */
function fix_validation_role_navigation( $template, $class ) {
    $template = str_replace( ' role="navigation"', '', $template );
    return $template;
}
add_filter( 'navigation_markup_template', 'fix_validation_role_navigation', 10, 2 );


/**
 * Disable shortcode wrapping in p
 */
if ( apply_filters( 'root_disable_wrapping_shortcode', false ) ) {
    remove_filter( 'the_content', 'wpautop' );
    add_filter( 'the_content', 'wpautop', 99 );
    add_filter( 'the_content', 'shortcode_unautop', 999 );
}








/**
 * Breadcrumbs home text
 */
$breadcrumbs_home_text = root_get_option( 'breadcrumbs_home_text' );
if ( ! empty( $breadcrumbs_home_text ) ) {
    add_filter( 'wpshop_breadcrumbs_home_text', 'wpshop_breadcrumbs_home_text_change' );
}
function wpshop_breadcrumbs_home_text_change() {
    $breadcrumbs_home_text = root_get_option( 'breadcrumbs_home_text' );
    return $breadcrumbs_home_text;
}


/**
 * Breadcrumbs separator
 */
$breadcrumbs_separator = root_get_option( 'breadcrumbs_separator' );
if ( ! empty( $breadcrumbs_separator ) ) {
    add_filter( 'wpshop_breadcrumbs_separator', 'wpshop_breadcrumbs_separator_change' );
}
function wpshop_breadcrumbs_separator_change() {
    $wpshop_breadcrumbs_separator = root_get_option( 'breadcrumbs_separator' );

    return $wpshop_breadcrumbs_separator;
}



/********************************************************************
 * TOC
 *******************************************************************/
add_filter( 'wpshop_toc_header', 'root_change_toc_header' );
function root_change_toc_header() {
    return __( 'Contents', 'root' );
}

add_action( 'wp', 'root_toc_enabled' );
function root_toc_enabled() {

    $show = true;

    if ( is_single() || is_page() ) {
        global $post;

        if ( 'checked' == get_post_meta( $post->ID, 'toc_hide', true ) ) {
            $show = false;
        }
    }

    if ( 'no' != root_get_option( 'toc_enabled' ) && $show ) {
        $wpshop_toc = new Wpshop_Table_Of_Contents;
        $wpshop_toc->init();
    }



    $toc_noindex = root_get_option( 'toc_noindex' );
    if ( $toc_noindex ) {
        add_filter( 'wpshop_toc_noindex', '__return_true' );
    }
}