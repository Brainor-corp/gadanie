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
 * The header for our theme.
 *
 * @package root
 * @build 11416
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<?php echo root_get_option( 'code_head' ) ?>
</head>

<body <?php body_class(); ?>>
<?php root_check_license(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'root' ); ?></a>

    <?php do_action( 'root_before_header' ); ?>

    <?php
    if ( ! is_singular() || 'checked' != get_post_meta( $post->ID, 'header_hide', true ) ) {
        get_template_part( 'template-parts/layout/header' );
    }
    ?>

    <?php do_action( 'root_after_header' ); ?>



    <?php
    if ( ! is_singular() ||  'checked' != get_post_meta( $post->ID, 'header_menu_hide', true ) ) {
        get_template_part( 'template-parts/layout/main', 'navigation' );
    }
    ?>

    <?php do_action( 'root_before_site_content' ); ?>

	<div id="content" class="site-content <?php root_site_content_classes() ?>">

        <?php
            $ad_options = get_option('root_ad_options');
            $ad_visible = ( ! empty( $ad_options['r_before_site_content_visible'] ) ) ? $ad_options['r_before_site_content_visible'] : array();

            $show_ad = false;
            if ( is_front_page()    && in_array('home', $ad_visible) )      $show_ad = true;
            if ( is_single()        && in_array('post', $ad_visible) )      $show_ad = true;
            if ( is_page()          && in_array('page', $ad_visible) )      $show_ad = true;
            if ( is_archive()       && in_array('archive', $ad_visible) )   $show_ad = true;
            if ( is_search()        && in_array('search', $ad_visible) )    $show_ad = true;

            if ( is_single() && in_array('post', $ad_visible) ) {
                $show_ad = do_show_ad(
                    $post->ID,
                    isset( $ad_options['r_before_site_content_exclude'] ) ? $ad_options['r_before_site_content_exclude'] : array(),
                    isset( $ad_options['r_before_site_content_include'] ) ? $ad_options['r_before_site_content_include'] : array()
                );
            }

            if ( is_page() && in_array('page', $ad_visible) ) {
                $show_ad = do_show_ad(
                    $post->ID,
                    isset( $ad_options['r_before_site_content_exclude'] ) ? $ad_options['r_before_site_content_exclude'] : array(),
                    isset( $ad_options['r_before_site_content_include'] ) ? $ad_options['r_before_site_content_include'] : array()
                );
            }

            if ( ! wp_is_mobile() && ! empty( $ad_options['r_before_site_content'] ) && $show_ad ) {
                echo '<div class="b-r b-r--before-site-content">' . do_shortcode( $ad_options['r_before_site_content'] ) . '</div>';
            }

            if ( wp_is_mobile() && ! empty( $ad_options['r_before_site_content_mob'] ) && $show_ad ) {
                echo '<div class="b-r b-r--before-site-content">' . do_shortcode( $ad_options['r_before_site_content_mob'] ) . '</div>';
            }
        ?>