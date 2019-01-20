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

?>

	</div><!-- #content -->

    <?php do_action( 'root_after_site_content' ); ?>

    <?php
        if ( ! is_singular() || 'checked' != get_post_meta( $post->ID, 'footer_menu_hide', true ) ) {
            get_template_part( 'template-parts/layout/footer', 'navigation' );
        }

        if ( ! is_singular() ||  'checked' != get_post_meta( $post->ID, 'footer_hide', true ) ) {
            get_template_part( 'template-parts/layout/footer' );
        }
    ?>

</div><!-- #page -->


<?php wp_footer(); ?>
<?php echo root_get_option( 'code_body' ) ?>

</body>
</html>
