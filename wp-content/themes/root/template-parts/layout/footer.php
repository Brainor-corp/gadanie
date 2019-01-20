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


$is_show_arrow = 'yes' == root_get_option( 'structure_arrow' );

?>


<?php do_action( 'root_before_footer' ); ?>

    <footer class="site-footer <?php root_site_footer_classes() ?>" itemscope itemtype="http://schema.org/WPFooter">
        <div class="site-footer-inner <?php root_site_footer_inner_classes() ?>">

            <div class="footer-info">
                <?php
                $footer_copyright = root_get_option( 'footer_copyright' );
                $footer_copyright = str_replace('%year%', date('Y'), $footer_copyright);
                echo $footer_copyright;
                ?>

                <?php
                $footer_text = root_get_option( 'footer_text' );
                if ( ! empty( $footer_text ) ) echo '<div class="footer-text">'. $footer_text .'</div>';
                ?>
            </div><!-- .site-info -->

            <?php if ( root_get_option( 'footer_social' ) == 'yes') {
                echo '<div class="footer-social">';
                get_template_part( 'template-parts/social', 'links' );
                echo '</div>';
            } ?>

            <div class="footer-counters">
                <?php echo root_get_option( 'footer_counters' ) ?>
            </div>

        </div><!-- .site-footer-inner -->
    </footer><!-- .site-footer -->


    <?php if ( $is_show_arrow ) { ?>
        <button type="button" class="scrolltop js-scrolltop"></button>
    <?php } ?>

<?php do_action( 'root_after_footer' ); ?>