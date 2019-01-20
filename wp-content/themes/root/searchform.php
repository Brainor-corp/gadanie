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

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" class="search-form">
    <label class="screen-reader-text" for="s"><?php _e( 'Search', 'root' ) ?>: </label>
    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="search-form__text">
    <button type="submit" id="searchsubmit" class="search-form__submit"></button>
</form>