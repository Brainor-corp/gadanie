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
 * @package root
 * @build 11416
 */


/**
 * Metaboxes
 */
class Posts_Meta_Box extends Vetteo_Meta_Box {

    public function __construct() {
        $this->set_settings( 'meta_posts_', 'post', 'Root: Настройки записи' );

        parent::__construct();
    }

    public function render_fields()
    {
        echo '<table class="form-table">';
      
        $this->field_text( 'source_link',               'Источник', 'http://...', 'Если необходимо указать ссылку на внешний сайт в качестве Источника, заполните это поле' );
        $this->field_checkbox( 'source_hide',           'Спрятать ссылку?', 'Скрыть ссылку на источник с помощью JS' );
        $this->field_checkbox( 'header_hide',           'Спрятать шапку', 'Не показывать шапку на этой странице' );
        $this->field_checkbox( 'header_menu_hide',      'Спрятать верхнее меню', 'Не показывать верхнее меню на этой странице' );
        $this->field_checkbox( 'footer_menu_hide',      'Спрятать нижнее меню', 'Не показывать нижнее меню на этой странице' );
        $this->field_checkbox( 'sidebar_hide',          'Спрятать сайдбар', 'Не показывать на этой странице сайдбар' );
        $this->field_checkbox( 'footer_hide',           'Спрятать подвал', 'Не показывать подвал на этой странице' );
        $this->field_checkbox( 'breadcrumbs_hide',      'Спрятать хлебные крошки', 'Не показывать хлебные крошки на этой странице' );
        $this->field_checkbox( 'h1_hide',               'Спрятать заголовок', 'Не показывать заголовок H1 на этой странице' );
        $this->field_checkbox( 'meta_hide',             'Спрятать мета-информацию', 'Не показывать мета-информацию (дата, рубрика, автор) на этой странице' );
        $this->field_checkbox( 'thumb_hide',            'Спрятать миниатюру', 'Не показывать миниатюру или разделитель на этой странице' );
        $this->field_checkbox( 'share_top_hide',        'Спрятать верхние соц. кнопки', 'Не показывать верхние соц. кнопки на этой странице' );
        $this->field_checkbox( 'share_bottom_hide',     'Спрятать нижние соц. кнопки', 'Не показывать нижние соц. кнопки на этой странице' );
        $this->field_checkbox( 'toc_hide',              'Спрятать содержание', 'Не показывать содержание на этой странице' );
        $this->field_checkbox( 'related_posts_hide',    'Спрятать похожие записи', 'Не показывать на этой странице похожие записи' );
        $this->field_checkbox( 'comments_hide',         'Спрятать комментарии', 'Не показывать комментарии на этой странице' );
        $this->field_checkbox( 'content_full_width',    'Контент по всей ширине', 'Сделать контент по всей ширине страницы без сайдбара' );
        $this->field_checkbox( 'site_full_width',       'Сайт по всей ширине', 'Сделать сайт по всей ширине' );

        echo '</table>';
    }

}

new Posts_Meta_Box;


class Pages_Meta_Box extends Vetteo_Meta_Box {

    public function __construct() {
        $this->set_settings( 'meta_pages_', 'page', __( 'Root: Настройки страницы', 'root' ) );

        parent::__construct();
    }

    public function render_fields()
    {
        echo '<table class="form-table">';

        $this->field_checkbox( 'header_hide',           'Спрятать шапку', 'Не показывать шапку на этой странице' );
        $this->field_checkbox( 'header_menu_hide',      'Спрятать верхнее меню', 'Не показывать верхнее меню на этой странице' );
        $this->field_checkbox( 'footer_menu_hide',      'Спрятать нижнее меню', 'Не показывать нижнее меню на этой странице' );
        $this->field_checkbox( 'sidebar_hide',          'Спрятать сайдбар', 'Не показывать на этой странице сайдбар' );
        $this->field_checkbox( 'footer_hide',           'Спрятать подвал', 'Не показывать подвал на этой странице' );
        $this->field_checkbox( 'breadcrumbs_hide',      'Спрятать хлебные крошки', 'Не показывать хлебные крошки на этой странице' );
        $this->field_checkbox( 'h1_hide',               'Спрятать заголовок', 'Не показывать заголовок H1 на этой странице' );
        $this->field_checkbox( 'thumb_hide',            'Спрятать миниатюру', 'Не показывать миниатюру или разделитель на этой странице' );
        $this->field_checkbox( 'share_top_hide',        'Спрятать верхние соц. кнопки', 'Не показывать нижние соц. кнопки на этой странице' );
        $this->field_checkbox( 'share_bottom_hide',     'Спрятать нижние соц. кнопки', 'Не показывать нижние соц. кнопки на этой странице' );
        $this->field_checkbox( 'toc_hide',              'Спрятать содержание', 'Не показывать содержание на этой странице' );
        $this->field_checkbox( 'related_posts_hide',    'Спрятать похожие записи', 'Не показывать на этой странице похожие записи' );
        $this->field_checkbox( 'content_full_width',    'Контент по всей ширине', 'Сделать контент по всей ширине страницы без сайдбара' );
        $this->field_checkbox( 'site_full_width',       'Сайт по всей ширине', 'Сделать сайт по всей ширине' );

        echo '</table>';
    }

}

new Pages_Meta_Box;
