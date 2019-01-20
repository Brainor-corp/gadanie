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


$is_show_social_js = 'yes' == root_get_option( 'structure_social_js' );

?>

<div class="social-buttons social-buttons--square social-buttons--circle social-buttons--small">

    <?php $social_facebook = root_get_option( 'social_facebook' );
    if ( ! empty ($social_facebook)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__fb js-social-link" data-uri="<?php echo $social_facebook; ?>"></span>
        <?php } else { ?>
            <a href="<?php echo $social_facebook; ?>" class="social-button social-button__fb" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_vk = root_get_option( 'social_vk' );
    if ( ! empty ($social_vk)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__vk js-social-link" data-uri="<?php echo $social_vk; ?>"></span>
        <?php } else { ?>
            <a href="<?php echo $social_vk; ?>" class="social-button social-button__vk" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_twitter = root_get_option( 'social_twitter' );
    if ( ! empty ($social_twitter)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__tw js-social-link" data-uri="<?php echo $social_twitter; ?>"></span>
        <?php } else { ?>
            <a href="<?php echo $social_twitter; ?>" class="social-button social-button__tw" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_ok = root_get_option( 'social_ok' );
    if ( ! empty ($social_ok)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__ok js-social-link" data-uri="<?php echo $social_ok; ?>"></span>
        <?php } else { ?>
            <a href="<?php echo $social_ok; ?>" class="social-button social-button__ok" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_gp = root_get_option( 'social_gp' );
    if ( ! empty ($social_gp)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__gp js-social-link" data-uri="<?php echo $social_gp; ?>"></span>
        <?php }  else { ?>
            <a href="<?php echo $social_gp; ?>" class="social-button social-button__gp" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_telegram = root_get_option( 'social_telegram' );
    if ( ! empty ($social_telegram)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__telegram js-social-link" data-uri="<?php echo $social_telegram; ?>"></span>
        <?php }  else { ?>
            <a href="<?php echo $social_telegram; ?>" class="social-button social-button__telegram" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_youtube = root_get_option( 'social_youtube' );
    if ( ! empty ($social_youtube)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__youtube js-social-link" data-uri="<?php echo $social_youtube; ?>"></span>
        <?php }  else { ?>
            <a href="<?php echo $social_youtube; ?>" class="social-button social-button__youtube" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_instagram = root_get_option( 'social_instagram' );
    if ( ! empty ($social_instagram)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__instagram js-social-link" data-uri="<?php echo $social_instagram; ?>"></span>
        <?php }  else { ?>
            <a href="<?php echo $social_instagram; ?>" class="social-button social-button__instagram" target="_blank"></a>
        <?php } ?>
    <?php } ?>

    <?php $social_linkedin = root_get_option( 'social_linkedin' );
    if ( ! empty ($social_linkedin)) {
        if ( $is_show_social_js ) { ?>
            <span class="social-button social-button__linkedin js-social-link" data-uri="<?php echo $social_linkedin; ?>"></span>
        <?php }  else { ?>
            <a href="<?php echo $social_linkedin; ?>" class="social-button social-button__linkedin" target="_blank"></a>
        <?php } ?>
    <?php } ?>
</div>