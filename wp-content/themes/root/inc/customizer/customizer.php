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
 * Root Theme Customizer.
 *
 * @package Root
 */



$patterns = array(
    'wood'          => array(
        'label'     => esc_html__( 'Wood', 'root' ),
        'mini'      => 'wood-mini.jpg',
        'pattern'   => 'wood.jpg',
    ),
    'wood-2'        => array(
        'label'     => esc_html__( 'Wood 2', 'root' ),
        'mini'      => 'wood-2-mini.jpg',
        'pattern'   => 'wood-2.jpg',
    ),
    'blue-waves'    => array(
        'label'     => esc_html__( 'Blue waves', 'root' ),
        'mini'      => 'blue-waves-mini.png',
        'pattern'   => 'blue-waves.png',
    ),
    'plaid'         => array(
        'label'     => esc_html__( 'Plaid', 'root' ),
        'mini'      => 'plaid-mini.jpg',
        'pattern'   => 'plaid.jpg',
    ),
    'wallpaper'     => array(
        'label'     => esc_html__( 'Wallpaper', 'root' ),
        'mini'      => 'wallpaper-mini.png',
        'pattern'   => 'wallpaper.png',
    ),
    'honey'         => array(
        'label'     => esc_html__( 'Honey', 'root' ),
        'mini'      => 'honey-mini.png',
        'pattern'   => 'honey.png',
    ),
    'wall'          => array(
        'label'     => esc_html__( 'Wall', 'root' ),
        'mini'      => 'wall-mini.png',
        'pattern'   => 'wall.png',
    ),
    'sea' => array(
        'label'     => esc_html__( 'Sea', 'root' ),
        'mini'      => 'sea-mini.png',
        'pattern'   => 'sea.png',
    ),
    'dots' => array(
        'label'     => esc_html__( 'Dots', 'root' ),
        'mini'      => 'dots-mini.png',
        'pattern'   => 'dots.png',
    ),
);



$fonts = array(
    'arial'             => array(
        'name'          => 'Arial',
        'url'           => '',
        'family'        => 'Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'roboto'            => array(
        'name'          => 'Roboto',
        'url'           => 'https://fonts.googleapis.com/css?family=Roboto:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Roboto", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'roboto_condensed'  => array(
        'name'          => 'Roboto Condensed',
        'url'           => 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Roboto Condensed", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'roboto_slab'       => array(
        'name'          => 'Roboto Slab',
        'url'           => 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&amp;subset=cyrillic',
        'family'        => '"Roboto Slab", "Times New Roman", Times, Baskerville, Georgia, serif',
    ),
    'pt_sans'           => array(
        'name'          => 'PT Sans',
        'url'           => 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700&amp;subset=cyrillic',
        'family'        => '"PT Sans", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'pt_serif'          => array(
        'name'          => 'PT Serif',
        'url'           => 'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700&amp;subset=cyrillic',
        'family'        => '"PT Serif", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'open_sans'         => array(
        'name'          => 'Open Sans',
        'url'           => 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Open Sans", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'open_sans_condensed'=> array(
        'name'          => 'Open Sans Condensed',
        'url'           => 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&amp;subset=cyrillic',
        'family'        => '"Open Sans Condensed", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'ubuntu'            => array(
        'name'          => 'Ubuntu',
        'url'           => 'https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Ubuntu", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'ubuntu_condensed'  => array(
        'name'          => 'Ubuntu Condensed',
        'url'           => 'https://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=cyrillic',
        'family'        => '"Ubuntu Condensed", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'exo_2'             => array(
        'name'          => 'Exo 2',
        'url'           => 'https://fonts.googleapis.com/css?family=Exo+2:300,400,400i,700,900&amp;subset=cyrillic',
        'family'        => '"Exo 2", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'tinos'             => array(
        'name'          => 'Tinos',
        'url'           => 'https://fonts.googleapis.com/css?family=Tinos:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Tinos", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'fira_sanscondensed'=> array(
        'name'          => 'Fira Sans Condensed',
        'url'           => 'https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Fira Sans Condensed", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'merriweather'      => array(
        'name'          => 'Merriweather',
        'url'           => 'https://fonts.googleapis.com/css?family=Merriweather:400,400i,700&amp;subset=cyrillic',
        'family'        => '"Merriweather", "Times New Roman", Times, Baskerville, Georgia, serif',
    ),
    'oswald'            => array(
        'name'          => 'Oswald',
        'url'           => 'https://fonts.googleapis.com/css?family=Oswald:300,400,700&amp;subset=cyrillic',
        'family'        => '"Oswald", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'lora'              => array(
        'name'          => 'Lora',
        'url'           => 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;subset=cyrillic',
        'family'        => '"Lora", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'lobster'           => array(
        'name'          => 'Lobster',
        'url'           => 'https://fonts.googleapis.com/css?family=Lobster&amp;subset=cyrillic',
        'family'        => '"Lobster", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'yanone_kaffeesatz' => array(
        'name'          => 'Yanone Kaffeesatz',
        'url'           => 'https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,400,700&amp;subset=cyrillic',
        'family'        => '"Yanone Kaffeesatz", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'bad_script'        => array(
        'name'          => 'Bad Script',
        'url'           => 'https://fonts.googleapis.com/css?family=Bad+Script&amp;subset=cyrillic',
        'family'        => '"Bad Script", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
    'kurale'            => array(
        'name'          => 'Kurale',
        'url'           => 'https://fonts.googleapis.com/css?family=Kurale&amp;subset=cyrillic',
        'family'        => '"Kurale", Arial, "Helvetica Neue", Helvetica, Arial, sans-serif',
    ),
);


/**
 * Convert theme_mod to options for old versions
 */
require get_template_directory() . '/inc/customizer/customizer-old-version.php';


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function root_customize_register( $wp_customize ) {


    $defaults = root_options_defaults();


    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $root_transport = 'postMessage';





    /********************************************************************
     * Фоны
     *******************************************************************/

    // Паттерн
    $wp_customize->add_setting( 'root_options[bg_pattern]', array(
        'default'           => $defaults['bg_pattern'],
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ));
    $wp_customize->add_control( new Customize_Control_Radio_Image( $wp_customize,
        'root_options[bg_pattern]',
        array(
            'settings'      => 'root_options[bg_pattern]',
            'label'         => __('Паттерн', 'root'),
            'section'       => 'background_image',
            'choices'       => root_get_patterns(),
        )
    ));


    // Фон шапки
    $wp_customize->add_setting( 'root_options[header_bg]', array(
        'default'           => $defaults['header_bg'],
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'root_options[header_bg]', array(
        'settings'          => 'root_options[header_bg]',
        'label'             => __('Фон для шапки', 'root'),
        'section'           => 'background_image',
    )));



    // Фон повторение
    $wp_customize->add_setting( 'root_options[header_bg_repeat]', array(
        'default'           => $defaults['header_bg_repeat'],
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ) );
    $wp_customize->add_control( 'root_options[header_bg_repeat]', array(
        'settings'          => 'root_options[header_bg_repeat]',
        'type'              => 'select',
        'section'           => 'background_image',
        'label'             => __( 'Повторение фона', 'root' ),
        'description'       => __( 'Если Вам необходимо повторять фоновое изображение шапки, Вы можете задать это в поле ниже' ),
        'choices'           => array(
            'no-repeat'     => __( 'Не повторять', 'root' ),
            'repeat'        => __( 'Повторять по горизонали и вертикали', 'root' ),
            'repeat-x'      => __( 'Повторять по горизонтали', 'root' ),
            'repeat-y'      => __( 'Повторять по вертикали', 'root' ),
        ),
    ) );

    // Фон расположене
    $wp_customize->add_setting( 'root_options[header_bg_position]', array(
        'default'           => $defaults['header_bg_position'],
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ) );
    $wp_customize->add_control( 'root_options[header_bg_position]', array(
        'settings'          => 'root_options[header_bg_position]',
        'type'              => 'select',
        'section'           => 'background_image',
        'label'             => __( 'Расположение фона', 'root' ),
        'choices'           => array(
            'left top'      => __( 'Сверху слева', 'root' ),
            'center top'    => __( 'Сверху по центру', 'root' ),
            'right top'     => __( 'Сверху справа', 'root' ),
            'left center'   => __( 'По центру слева', 'root' ),
            'center center' => __( 'По центру', 'root' ),
            'right center'  => __( 'По центру справа', 'root' ),
            'left bottom'   => __( 'Снизу слева', 'root' ),
            'center bottom' => __( 'Снизу по центру', 'root' ),
            'right bottom'  => __( 'Снизу справа', 'root' ),
        ),
    ) );




    /********************************************************************
     * ЦВЕТА
     *******************************************************************/

    $wp_customize->get_setting( 'background_color' )->default = '#f9f8f5';


    // Основной цвет сайта
    $wp_customize->add_setting( 'root_options[color_main]', array(
        'default'           => $defaults['color_main'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_main]', array(
            'settings'   => 'root_options[color_main]',
            'section'    => 'colors',
            'label'      => 'Основной цвет сайта',
            'description'=> 'Разделители, пагинация, списки, кнопки, моб. меню и т.д. Цвет желательно подобрать выделяющийся на белом фоне',
        )
    ));


    // Основной цвет ссылок
    $wp_customize->add_setting( 'root_options[color_link]', array(
        'default'           => $defaults['color_link'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_link]', array(
            'settings'   => 'root_options[color_link]',
            'label'      => 'Основной цвет ссылок',
            'section'    => 'colors',
        )
    ));


    // Основной цвет ссылок при наведении
    $wp_customize->add_setting( 'root_options[color_link_hover]', array(
        'default'           => $defaults['color_link_hover'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_link_hover]', array(
            'settings'      => 'root_options[color_link_hover]',
            'label'         => 'Основной цвет ссылок при наведении',
            'section'       => 'colors',
        )
    ));


    // Основной цвет текста
    $wp_customize->add_setting( 'root_options[color_text]', array(
        'default'           => $defaults['color_text'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_text]', array(
            'settings'      => 'root_options[color_text]',
            'label'         => 'Основной цвет текста',
            'section'       => 'colors',
        )
    ));

    // Цвет названия сайта
    $wp_customize->add_setting( 'root_options[color_logo]', array(
        'default'           => $defaults['color_logo'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_logo]', array(
            'settings'      => 'root_options[color_logo]',
            'label'         => 'Цвет названия сайта',
            'section'       => 'colors',
        )
    ));

    // Цвет описания сайта
    $wp_customize->add_setting( 'root_options[color_description]', array(
        'default'           => $defaults['color_description'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_description]', array(
            'settings'      => 'root_options[color_description]',
            'label'         => 'Цвет описания сайта',
            'section'       => 'colors',
        )
    ));

    // Фоновый цвет меню
    $wp_customize->add_setting( 'root_options[color_menu_bg]', array(
        'default'           => $defaults['color_menu_bg'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_menu_bg]', array(
            'settings'      => 'root_options[color_menu_bg]',
            'label'         => 'Фоновый цвет меню',
            'section'       => 'colors',
        )
    ));

    // Цвет ссылок в меню
    $wp_customize->add_setting( 'root_options[color_menu]', array(
        'default'           => $defaults['color_menu'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[color_menu]', array(
            'settings'      => 'root_options[color_menu]',
            'label'         => 'Цвет ссылок в меню',
            'section'       => 'colors',
        )
    ));






    /********************************************************************
     * Скины
     *******************************************************************/
    /*$wp_customize->add_section( 'root_skins', array(
        'title'         => __('Skins', 'root'),
        'description'   => 'В данной секции Вы можете выбрать готовое оформление для сайта.<br><br>В ближайшее время мы добавим еще больше скинов.<br><span style="color:red;">BETA</span>',
        'priority'      => 30,
        'capability'    => 'edit_theme_options',
    ));

    // Скины
    $wp_customize->add_setting('root_options[skin]', array(
        'default'       => $defaults['skin'],
        'type'          => 'option',
    ));
    $wp_customize->add_control('root_options[skin]', array(
        'settings'      => 'root_options[skin]',
        'label'         => __('Skin', 'root'),
        'section'       => 'root_skins',
        'type'          => 'radio',
        'choices'       => array(
            'no'        => __('No skins', 'root'),
            'skin-1'    => __('Skin 1', 'root'),
        ),
    ));*/








    /********************************************************************
     * Типографика
     *******************************************************************/
    $wp_customize->add_section( 'root_typography', array(
        'title'             => 'Типографика',
        'description'       => 'В данной секции Вы можете настроить шрифты на сайте',
        'capability'        => 'edit_theme_options',
        'priority'          => 14,
    ));

    global $fonts;
    $fonts_list = array();
    foreach ( $fonts as $key => $val ) {
        $fonts_list[$key] = $val['name'];
    }


    // Основной шрифт
    $wp_customize->add_setting( 'root_options[typography_family]', array(
        'default'           => $defaults['typography_family'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[typography_family]', array(
        'settings'          => 'root_options[typography_family]',
        'section'           => 'root_typography',
        'label'             => __('Основной шрифт', 'root'),
        'type'              => 'select',
        'choices'           => $fonts_list,
    ));


    // Основной размер шрифта
    $wp_customize->add_setting( 'root_options[typography_font_size]', array(
        'default'           => $defaults['typography_font_size'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[typography_font_size]', array(
        'settings'          => 'root_options[typography_font_size]',
        'section'           => 'root_typography',
        'label'             => __('Основной размер шрифта, px', 'root'),
        'type'              => 'number',
        'description'       => 'По умолчанию 16',
        'input_attrs'       => array(
            'min'           => 10,
            'max'           => 36,
            'step'          => 1
        )
    ));


    // Межстрочный интервал
    $wp_customize->add_setting( 'root_options[typography_line_height]', array(
        'default'           => $defaults['typography_line_height'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[typography_line_height]', array(
        'settings'          => 'root_options[typography_line_height]',
        'section'           => 'root_typography',
        'label'             => __('Основной межстрочный интервал', 'root'),
        'type'              => 'number',
        'description'       => 'По умолчанию 1.5',
        'input_attrs'       => array(
            'min'           => 0.5,
            'max'           => 3,
            'step'          => 0.1
        )
    ));


    // Шрифт заголовков
    $wp_customize->add_setting( 'root_options[typography_headers_family]', array(
        'default'           => $defaults['typography_headers_family'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[typography_headers_family]', array(
        'settings'          => 'root_options[typography_headers_family]',
        'section'           => 'root_typography',
        'label'             => __('Шрифт заголовков', 'root'),
        'type'              => 'select',
        'choices'           => $fonts_list,
    ));






    /********************************************************************
     * Структура
     *******************************************************************/
    $wp_customize->add_panel( 'root_layout_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Структура', 'root' ),
        'type'           => 'default',
    ) );


    /********************************************************************
     * Шапка
     */
    $wp_customize->add_section(
        'root_layout_header',
        array(
            'title'         => __('Шапка', 'root'),
            'description'   => 'В данной секции Вы можете настроить главную страницу, вывод постов, дополнительного текста',
            'panel'         => 'root_layout_panel',
            'capability'    => 'edit_theme_options',
        )
    );


    /**
     * Header width
     */
    $wp_customize->add_setting(
        'root_options[header_width]',
        array(
            'default'   => $defaults['header_width'],
            'type'      => 'option',
        )
    );
    $wp_customize->add_control(
        'root_options[header_width]',
        array(
            'settings'  => 'root_options[header_width]',
            'type'      => 'select',
            'section'   => 'root_layout_header',
            'label'     => __( 'Header width', 'root' ),
            'choices'   => array(
                'full'  => __( 'Full width', 'root' ),
                'fixed' => __( 'Fixed width', 'root' )
            ),
        )
    );

    /**
     * Header width inner
     */
    $wp_customize->add_setting(
        'root_options[header_inner_width]',
        array(
            'default'   => $defaults['header_inner_width'],
            'type'      => 'option',
        )
    );
    $wp_customize->add_control(
        'root_options[header_inner_width]',
        array(
            'settings'  => 'root_options[header_inner_width]',
            'type'      => 'select',
            'section'   => 'root_layout_header',
            'label'     => __( 'Header inner width', 'root' ),
            'choices'   => array(
                'full'  => __( 'Full width', 'root' ),
                'fixed' => __( 'Fixed width', 'root' )
            ),
        )
    );


    /**
     * Верхний отступ у шапки
     */
    $wp_customize->add_setting( 'root_options[header_padding_top]', array(
        'default'       => $defaults['header_padding_top'],
        'type'          => 'option',
        'sanitize_callback' => 'root_sanitize_integer',
        //'transport'      => $root_transport,
    ) );

    $wp_customize->add_control(
        new WP_Customize_Range_Control(
            $wp_customize,
            'root_options[header_padding_top]',
            array(
                'settings'      => 'root_options[header_padding_top]',
                'label'         => __( 'Header padding top', 'root' ),
                'section'       => 'root_layout_header',
                'description'   => 'Вы можете задать отступ сверху у шапки, например, чтобы поместить выбранный фон',
                'input_attrs'   => array(
                    'min'       => 0,
                    'max'       => 200,
                    'step'      => 1,
                ),
            )
        )
    );


    /**
     * Нижний отступ у шапки
     */
    $wp_customize->add_setting( 'root_options[header_padding_bottom]', array(
        'default'       => $defaults['header_padding_bottom'],
        'type'          => 'option',
        'sanitize_callback' => 'root_sanitize_integer',
        //'transport'      => $root_transport,
    ) );
    $wp_customize->add_control(
        new WP_Customize_Range_Control(
            $wp_customize,
            'root_options[header_padding_bottom]',
            array(
                'settings'      => 'root_options[header_padding_bottom]',
                'label'         => __( 'Header padding bottom', 'root' ),
                'section'       => 'root_layout_header',
                'description'   => 'Вы можете задать отступ снизу у шапки, чтобы поместить выбранный фон',
                'input_attrs'   => array(
                    'min'       => 0,
                    'max'       => 200,
                    'step'      => 1,
                ),
            )
        )
    );





    /********************************************************************
     * Меню основное
     */
    $wp_customize->add_section(
        'root_layout_navigation_main',
        array(
            'title'         => __('Основное меню', 'root'),
            'panel'         => 'root_layout_panel',
            'capability'    => 'edit_theme_options',
        )
    );


    /**
     * Navigation main width
     */
    $wp_customize->add_setting( 'root_options[navigation_main_width]',array(
        'default'           => $defaults['navigation_main_width'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[navigation_main_width]',
        array(
            'settings'      => 'root_options[navigation_main_width]',
            'type'          => 'select',
            'section'       => 'root_layout_navigation_main',
            'label'         => __( 'Main navigation width', 'root' ),
            'choices'       => array(
                'full'      => __( 'Full width', 'root' ),
                'fixed'     => __( 'Fixed width', 'root' )
            ),
        )
    );

    /**
     * Header width inner
     */
    $wp_customize->add_setting( 'root_options[navigation_main_inner_width]',
        array(
            'default'       => $defaults['navigation_main_inner_width'],
            'type'          => 'option',
        )
    );
    $wp_customize->add_control( 'root_options[navigation_main_inner_width]',
        array(
            'settings'      => 'root_options[navigation_main_inner_width]',
            'type'          => 'select',
            'section'       => 'root_layout_navigation_main',
            'label'         => __( 'Main navigation inner width', 'root' ),
            'choices'       => array(
                'full'      => __( 'Full width', 'root' ),
                'fixed'     => __( 'Fixed width', 'root' )
            ),
        )
    );

    // Фиксированное меню
    $wp_customize->add_setting( 'root_options[navigation_main_fixed]', array(
        'default'           => $defaults['navigation_main_fixed'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[navigation_main_fixed]', array(
        'settings'          => 'root_options[navigation_main_fixed]',
        'section'           => 'root_layout_navigation_main',
        'label'             => __('Сделать главное меню фиксированным?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, сделать',
            'no'            => 'Нет, не нужно',
        ),
    ));


    /********************************************************************
     * Меню нижнее
     */
    $wp_customize->add_section(
        'root_layout_navigation_footer',
        array(
            'title'         => __('Нижнее меню', 'root'),
            'panel'         => 'root_layout_panel',
            'capability'    => 'edit_theme_options',
        )
    );


    /**
     * Navigation footer width
     */
    $wp_customize->add_setting( 'root_options[navigation_footer_width]',array(
        'default'           => $defaults['navigation_footer_width'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[navigation_footer_width]',
        array(
            'settings'      => 'root_options[navigation_footer_width]',
            'type'          => 'select',
            'section'       => 'root_layout_navigation_footer',
            'label'         => __( 'Footer navigation width', 'root' ),
            'choices'       => array(
                'full'      => __( 'Full width', 'root' ),
                'fixed'     => __( 'Fixed width', 'root' )
            ),
        )
    );

    /**
     * Footer width inner
     */
    $wp_customize->add_setting( 'root_options[navigation_footer_inner_width]',
        array(
            'default'       => $defaults['navigation_footer_inner_width'],
            'type'          => 'option',
        )
    );
    $wp_customize->add_control( 'root_options[navigation_footer_inner_width]',
        array(
            'settings'      => 'root_options[navigation_footer_inner_width]',
            'type'          => 'select',
            'section'       => 'root_layout_navigation_footer',
            'label'         => __( 'Footer navigation inner width', 'root' ),
            'choices'       => array(
                'full'      => __( 'Full width', 'root' ),
                'fixed'     => __( 'Fixed width', 'root' )
            ),
        )
    );

    // Выводить нижнее меню на мобильном
    $wp_customize->add_setting( 'root_options[navigation_footer_mob]', array(
        'default'           => $defaults['navigation_footer_mob'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[navigation_footer_mob]', array(
        'settings'          => 'root_options[navigation_footer_mob]',
        'section'           => 'root_layout_navigation_footer',
        'label'             => __('Выводить нижнее меню на мобильном?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));




    /********************************************************************
     * Подвал
     */
    $wp_customize->add_section(
        'root_layout_footer',
        array(
            'title'         => __('Подвал', 'root'),
            'description'   => 'В данной секции Вы можете настроить главную страницу, вывод постов, дополнительного текста',
            'panel'         => 'root_layout_panel',
            'capability'    => 'edit_theme_options',
        )
    );


    /**
     * Footer width
     */
    $wp_customize->add_setting( 'root_options[footer_width]', array(
        'default'   => $defaults['footer_width'],
        'type'      => 'option',
    ));
    $wp_customize->add_control( 'root_options[footer_width]',
        array(
            'settings'  => 'root_options[footer_width]',
            'type'      => 'select',
            'section'   => 'root_layout_footer',
            'label'     => __( 'Footer width', 'root' ),
            'choices'   => array(
                'full'  => __( 'Full width', 'root' ),
                'fixed' => __( 'Fixed width', 'root' )
            ),
        )
    );

    /**
     * Footer width inner
     */
    $wp_customize->add_setting( 'root_options[footer_inner_width]', array(
        'default'   => $defaults['footer_inner_width'],
        'type'      => 'option',
    ));
    $wp_customize->add_control( 'root_options[footer_inner_width]',
        array(
            'settings'  => 'root_options[footer_inner_width]',
            'type'      => 'select',
            'section'   => 'root_layout_footer',
            'label'     => __( 'Footer inner width', 'root' ),
            'choices'   => array(
                'full'  => __( 'Full width', 'root' ),
                'fixed' => __( 'Fixed width', 'root' )
            ),
        )
    );







    /********************************************************************
     * Блоки и расположение
     *******************************************************************/

    $wp_customize->add_panel( 'panel_structure', array(
        'priority'       => 12,
        'capability'     => 'edit_theme_options',
        'title'          => 'Блоки и расположение',
        'type'           => 'default',
    ) );





    /********************************************************************
     * Шапка
     */
    $wp_customize->add_section( 'root_structure_header', array(
        'title'             => 'Шапка',
        'description'       => 'В данной секции Вы можете настроить элементы шапки сайта',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // логотип
    $wp_customize->add_setting( 'root_options[logotype_image]', array(
        'default'           => $defaults['logotype_image'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
        'root_options[logotype_image]', array(
            'settings'       => 'root_options[logotype_image]',
            'label'          => __('Логотип', 'root'),
            'section'        => 'root_structure_header',
        )
    ));


    // Скрыть заголовок и описание в шапке?
    $wp_customize->add_setting( 'root_options[header_hide_title]', array(
        'default'           => 'no',
        'type'              => 'option',
    ));
    $wp_customize->add_control('root_options[header_hide_title]', array(
        'settings'          => 'root_options[header_hide_title]',
        'label'             => __('Скрыть заголовок и описание в шапке?', 'root'),
        'description'       => 'Если скрыть заголовок и описание, желательно задать для главной страницы h1, например, в разделе "Блоки и расположение" -> "Главная"',
        'section'           => 'root_structure_header',
        'type'              => 'radio',
        'choices'           => array(
            'no'            => 'Не скрывать',
            'yes'           => 'Скрыть',
        ),
    ));





    /**
     * Выводить соц кнопки
     */
    $wp_customize->add_setting( 'root_options[header_social]', array(
        'default'           => $defaults['header_social'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[header_social]', array(
        'settings'          => 'root_options[header_social]',
        'section'           => 'root_structure_header',
        'label'             => __('Показывать соц сети?', 'root'),
        'description'       => 'Ссылки на соц. сети можно задать в разделе Блоки и расположение > Социальные сети',
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, показывать',
            'no'            => 'Нет, не показывать',
        ),
    ));


    // HTML код #1
    $wp_customize->add_setting( 'root_options[header_html_block_1]', array(
        'default'           => $defaults['header_html_block_1'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[header_html_block_1]', array(
        'settings'          => 'root_options[header_html_block_1]',
        'section'           => 'root_structure_header',
        'label'             => __('HTML код #1', 'root'),
        'description'       => 'Код будет выведен после логотипа',
        'type'              => 'textarea',
    ));


    // HTML код #2
    $wp_customize->add_setting( 'root_options[header_html_block_2]', array(
        'default'           => $defaults['header_html_block_2'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[header_html_block_2]', array(
        'settings'          => 'root_options[header_html_block_2]',
        'section'           => 'root_structure_header',
        'label'             => __('HTML код #2', 'root'),
        'description'       => 'Код будет выведен справа',
        'type'              => 'textarea',
    ));


    // Выводить поиск на мобильном
    $wp_customize->add_setting( 'root_options[header_search_mob]', array(
        'default'           => $defaults['header_search_mob'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[header_search_mob]', array(
        'settings'          => 'root_options[header_search_mob]',
        'section'           => 'root_structure_header',
        'label'             => __('Выводить поиск на мобильном?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));







    /********************************************************************
     * Подвал
     */
    $wp_customize->add_section( 'root_structure_footer', array(
        'title'             => 'Подвал',
        'description'       => 'В данной секции Вы можете настроить внешний вид и тексты подвала, добавить счетчики',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // копирайт
    $wp_customize->add_setting( 'root_options[footer_copyright]', array(
        'default'           => $defaults['footer_copyright'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[footer_copyright]', array(
        'settings'          => 'root_options[footer_copyright]',
        'section'           => 'root_structure_footer',
        'label'             => __('Копирайт', 'root'),
        'description'       => __('Используйте %year%, чтобы добавить текущий год', 'root'),
    ));


    // Текст под копирайтом
    $wp_customize->add_setting( 'root_options[footer_text]', array(
        'default'           => $defaults['footer_text'],
        'type'              => 'option',
    ));
    $wp_customize->add_control('root_options[footer_text]', array(
        'settings'          => 'root_options[footer_text]',
        'label'             => __('Текст под копирайтом', 'root'),
        'section'           => 'root_structure_footer',
        'type'              => 'textarea',
    ));


    // счетчики
    $wp_customize->add_setting( 'root_options[footer_counters]', array(
        'default'           => $defaults['footer_counters'],
        'type'              => 'option',
    ));
    $wp_customize->add_control('root_options[footer_counters]', array(
        'settings'          => 'root_options[footer_counters]',
        'label'             => __('Счетчики', 'root'),
        'section'           => 'root_structure_footer',
        'type'              => 'textarea',
    ));



    /**
     * Выводить соц кнопки
     */
    $wp_customize->add_setting( 'root_options[footer_social]', array(
        'default'           => $defaults['footer_social'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[footer_social]', array(
        'settings'          => 'root_options[footer_social]',
        'section'           => 'root_structure_footer',
        'label'             => __('Показывать соц сети?', 'root'),
        'description'       => 'Ссылки на соц. сети можно задать в разделе Блоки и расположение > Социальные сети',
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, показывать',
            'no'            => 'Нет, не показывать',
        ),
    ));




    /********************************************************************
     * Главная
     */
    $wp_customize->add_section( 'root_structure_home', array(
        'title'             => 'Главная',
        'description'       => 'В данной секции Вы можете настроить главную страницу, вывод постов, дополнительного текста',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Карточки постов на главной
    $wp_customize->add_setting( 'root_options[structure_home_posts]', array(
        'default'           => $defaults['structure_home_posts'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_home_posts]', array(
        'settings'          => 'root_options[structure_home_posts]',
        'label'             => __('Карточки постов на главной', 'root'),
        'section'           => 'root_structure_home',
        'type'              => 'radio',
        'choices'           => array(
            'post-box'      => 'Одна запись большая',
            'post-card-one' => 'Одна запись маленькая',
            'post-card'     => 'Небольшие карточки (2 или 3 в строке)',
        ),
    ));


    // Сайдбар
    $wp_customize->add_setting( 'root_options[structure_home_sidebar]', array(
        'default'           => $defaults['structure_home_sidebar'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_home_sidebar]', array(
        'settings'          => 'root_options[structure_home_sidebar]',
        'label'             => __('Сайдбар', 'root'),
        'section'           => 'root_structure_home',
        'type'              => 'radio',
        'choices'           => array(
            'right'         => 'Справа',
            'left'          => 'Слева',
            'none'          => 'Не показывать',
        ),
    ));


    // h1 главной
    $wp_customize->add_setting( 'root_options[structure_home_h1]', array(
        'default'           => $defaults['structure_home_h1'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_home_h1]', array(
        'settings'          => 'root_options[structure_home_h1]',
        'section'           => 'root_structure_home',
        'label'             => __('Заголовок H1', 'root'),
        'description'       => __('Если поле не задано - заголовком h1 становится логотип (название сайта)', 'root'),
    ));


    // текст на главной
    $wp_customize->add_setting( 'root_options[structure_home_text]', array(
        'default'           => $defaults['structure_home_text'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_home_text]', array(
        'settings'          => 'root_options[structure_home_text]',
        'section'           => 'root_structure_home',
        'label'             => __('Текст', 'root'),
        'type'              => 'textarea',
        'description'       => __('Текст под заголовком H1, отображается только на главной', 'root'),
    ));


    // Расположение заголовка и текста
    $wp_customize->add_setting( 'root_options[structure_home_position]', array(
        'default'           => $defaults['structure_home_position'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_home_position]', array(
        'settings'          => 'root_options[structure_home_position]',
        'section'           => 'root_structure_home',
        'label'             => __('Расположение заголовка и текста', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'top'           => 'Сверху (сразу под меню)',
            'bottom'        => 'Снизу (после постов и пагинации)',
        ),
    ));



    /********************************************************************
     * Записи
     */
    $wp_customize->add_section( 'root_structure_single', array(
        'title'             => 'Записи',
        'description'       => 'В данной секции Вы можете настроить внешний вид записей, вывод постов, дополнительного текста',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Сайдбар
    $wp_customize->add_setting( 'root_options[structure_single_sidebar]', array(
        'default'           => $defaults['structure_single_sidebar'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_sidebar]', array(
        'settings'          => 'root_options[structure_single_sidebar]',
        'section'           => 'root_structure_single',
        'label'             => __('Сайдбар', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'right'         => 'Справа',
            'left'          => 'Слева',
            'none'          => 'Не показывать',
        ),
    ));


    // Выводить миниатюру
    $wp_customize->add_setting( 'root_options[structure_single_thumb]', array(
        'default'           => $defaults['structure_single_thumb'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_thumb]', array(
        'settings'          => 'root_options[structure_single_thumb]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить миниатюру?', 'root'),
        'type'              => 'radio',
        'description'       => 'Изображение записи',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить автора
    $wp_customize->add_setting( 'root_options[structure_single_author]', array(
        'default'           => $defaults['structure_single_author'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_author]', array(
        'settings'          => 'root_options[structure_single_author]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить автора?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить если возможно',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить дату
    $wp_customize->add_setting( 'root_options[structure_single_date]', array(
        'default'           => $defaults['structure_single_date'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_date]', array(
        'settings'          => 'root_options[structure_single_date]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить дату?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить если возможно',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить рубрику
    $wp_customize->add_setting( 'root_options[structure_single_category]', array(
        'default'           => $defaults['structure_single_category'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_category]', array(
        'settings'          => 'root_options[structure_single_category]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить рубрику?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить наверху соц кнопки
    $wp_customize->add_setting( 'root_options[structure_single_social]', array(
        'default'           => $defaults['structure_single_social'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_social]', array(
        'settings'          => 'root_options[structure_single_social]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить наверху соц кнопки?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить отрывок
    $wp_customize->add_setting( 'root_options[structure_single_excerpt]', array(
        'default'           => $defaults['structure_single_excerpt'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_excerpt]', array(
        'settings'          => 'root_options[structure_single_excerpt]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить отрывок', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить кол-во комментариев
    $wp_customize->add_setting( 'root_options[structure_single_comments_count]', array(
        'default'           => $defaults['structure_single_comments_count'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_comments_count]', array(
        'settings'          => 'root_options[structure_single_comments_count]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить кол-во комментариев', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить кол-во просмотров
    $wp_customize->add_setting( 'root_options[structure_single_views]', array(
        'default'           => $defaults['structure_single_views'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_views]', array(
        'settings'          => 'root_options[structure_single_views]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить кол-во просмотров', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить теги, если заданы
    $wp_customize->add_setting( 'root_options[structure_single_tags]', array(
        'default'           => $defaults['structure_single_tags'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_tags]', array(
        'settings'          => 'root_options[structure_single_tags]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить теги, если заданы?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить соц кнопки
    $wp_customize->add_setting( 'root_options[structure_single_social_bottom]', array(
        'default'           => $defaults['structure_single_social_bottom'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_social_bottom]', array(
        'settings'          => 'root_options[structure_single_social_bottom]',
        'section'           => 'root_structure_single',
        'label'             => __('Выводить соц кнопки под постом?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // количество похожих
    $wp_customize->add_setting( 'root_options[structure_single_related]', array(
        'default'           => $defaults['structure_single_related'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_related]', array(
        'settings'          => 'root_options[structure_single_related]',
        'section'           => 'root_structure_single',
        'label'             => __('Кол-во похожих статей', 'root'),
        'type'              => 'number',
        'description'       => __('0 - чтобы отключить, максимум 50', 'root'),
    ));


	// Комментарии
    $wp_customize->add_setting( 'root_options[structure_single_comments]', array(
        'default'           => $defaults['structure_single_comments'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_single_comments]', array(
        'settings'          => 'root_options[structure_single_comments]',
        'section'           => 'root_structure_single',
        'label'             => __('Комментарии', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'no'            => 'Не показывать',
            'yes'           => 'Показывать',
        ),
    ));







    /********************************************************************
     * Страницы
     */
    $wp_customize->add_section( 'root_structure_page', array(
        'title'             => 'Страницы',
        'description'       => 'В данной секции Вы можете настроить внешний вид страниц, вывод сайдбара, блока похожих статей',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Сайдбар
    $wp_customize->add_setting( 'root_options[structure_page_sidebar]', array(
        'default'           => $defaults['structure_page_sidebar'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_sidebar]', array(
        'settings'          => 'root_options[structure_page_sidebar]',
        'section'           => 'root_structure_page',
        'label'             => __('Сайдбар', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'right'         => 'Справа',
            'left'          => 'Слева',
            'none'          => 'Не показывать',
        ),
    ));


    // Выводить наверху соц кнопки
    $wp_customize->add_setting( 'root_options[structure_page_social]', array(
        'default'           => $defaults['structure_page_social'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_social]', array(
        'settings'          => 'root_options[structure_page_social]',
        'section'           => 'root_structure_page',
        'label'             => __('Выводить наверху соц кнопки?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить миниатюру
    $wp_customize->add_setting( 'root_options[structure_page_thumb]', array(
        'default'           => $defaults['structure_page_thumb'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_thumb]', array(
        'settings'          => 'root_options[structure_page_thumb]',
        'section'           => 'root_structure_page',
        'label'             => __('Выводить миниатюру?', 'root'),
        'type'              => 'radio',
        'description'       => 'Изображение страницы',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить соц кнопки
    $wp_customize->add_setting( 'root_options[structure_page_social_bottom]', array(
        'default'           => $defaults['structure_page_social_bottom'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_social_bottom]', array(
        'settings'          => 'root_options[structure_page_social_bottom]',
        'section'           => 'root_structure_page',
        'label'             => __('Выводить соц кнопки под текстом страницы?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // количество похожих
    $wp_customize->add_setting( 'root_options[structure_page_related]', array(
        'default'           => $defaults['structure_page_related'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_related]', array(
        'settings'          => 'root_options[structure_page_related]',
        'label'             => __('Кол-во похожих статей', 'root'),
        'section'           => 'root_structure_page',
        'type'              => 'number',
        'description'       => __('0 - чтобы отключить, максимум 50', 'root'),
    ));


    // Комментарии
    $wp_customize->add_setting( 'root_options[structure_page_comments]', array(
        'default'           => $defaults['structure_page_comments'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_page_comments]', array(
        'settings'          => 'root_options[structure_page_comments]',
        'section'           => 'root_structure_page',
        'label'             => __('Комментарии', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'no'            => 'Не показывать',
            'yes'           => 'Показывать',
        ),
    ));







    /********************************************************************
     * Архивы
     */
    $wp_customize->add_section( 'root_structure_archive', array(
        'title'             => 'Архивы',
        'description'       => 'В данной секции Вы можете настроить архивы записей',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Карточки постов в архивах
    $wp_customize->add_setting( 'root_options[structure_archive_posts]', array(
        'default'           => $defaults['structure_archive_posts'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_archive_posts]', array(
        'settings'          => 'root_options[structure_archive_posts]',
        'section'           => 'root_structure_archive',
        'label'             => __('Карточки постов в архивах', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'post-box'      => 'Одна запись большая',
            'post-card-one' => 'Одна запись маленькая',
            'post-card'     => 'Небольшие карточки (2 или 3 в строке)',
        ),
    ));


    // Сайдбар
    $wp_customize->add_setting( 'root_options[structure_archive_sidebar]', array(
        'default'           => $defaults['structure_archive_sidebar'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_archive_sidebar]', array(
        'settings'          => 'root_options[structure_archive_sidebar]',
        'section'           => 'root_structure_archive',
        'label'             => __('Сайдбар', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'right'         => 'Справа',
            'left'          => 'Слева',
            'none'          => 'Не показывать',
        ),
    ));


    // Выводить подрубрики
    $wp_customize->add_setting( 'root_options[structure_child_categories]', array(
        'default'           => $defaults['structure_child_categories'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_child_categories]', array(
        'settings'          => 'root_options[structure_child_categories]',
        'section'           => 'root_structure_archive',
        'label'             => __('Выводить подрубрики?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));

    
    // Описание рубрики
    $wp_customize->add_setting( 'root_options[structure_archive_description]', array(
        'default'           => $defaults['structure_archive_description'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_archive_description]', array(
        'settings'          => 'root_options[structure_archive_description]',
        'section'           => 'root_structure_archive',
        'label'             => __('Описание рубрики', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'top'           => 'Сверху (под заголовков)',
            'bottom'        => 'Снизу (под пагинацией)',
        ),
    ));





    /********************************************************************
     * Комментарии
     */
    $wp_customize->add_section( 'root_structure_comments', array(
        'title'             => 'Комментарии',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // приписка под комментариями
    $wp_customize->add_setting( 'root_options[comments_text_before_submit]', array(
        'default'           => $defaults['comments_text_before_submit'],
        'type'              => 'option',
    ));
    $wp_customize->add_control('root_options[comments_text_before_submit]', array(
        'settings'          => 'root_options[comments_text_before_submit]',
        'label'             => __('Текст перед кнопкой Отправить', 'root'),
        'section'           => 'root_structure_comments',
        'description'       => 'Вы можете добавить любой HTML код, пример с ссылками (# нужно заменить на адрес ссылки):<br><br>Нажимая на кнопку "Отправить комментарий", я даю согласие на &lt;a href="#"&gt;обработку персональных данных&lt;/a&gt; и принимаю &lt;a href="#" target="_blank"&gt;политику конфиденциальности&lt;/a&gt;.',
        'type'              => 'textarea',
    ));


    // Выводить дату в комментариях
    $wp_customize->add_setting( 'root_options[comments_date]', array(
        'default'           => $defaults['comments_date'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[comments_date]', array(
        'settings'          => 'root_options[comments_date]',
        'section'           => 'root_structure_comments',
        'label'             => __('Выводить дату в комментариях', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Выводить смайлы в комментариях
    $wp_customize->add_setting( 'root_options[comments_smiles]', array(
        'default'           => $defaults['comments_smiles'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[comments_smiles]', array(
        'settings'          => 'root_options[comments_smiles]',
        'section'           => 'root_structure_comments',
        'label'             => __('Выводить смайлы в комментариях', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));




    /********************************************************************
     * Карточки постов
     */
    $wp_customize->add_section( 'root_structure_posts', array(
        'title'             => 'Карточки постов',
        'description'       => 'В данной секции Вы можете настроить внешний вид карточек постов, которые выводятся на главной, в рубриках, поиске и т.д.',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Тег заголовка
    $wp_customize->add_setting( 'root_options[structure_posts_tag]', array(
        'default'           => $defaults['structure_posts_tag'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_tag]', array(
        'settings'          => 'root_options[structure_posts_tag]',
        'section'           => 'root_structure_posts',
        'label'             => __('Тег заголовка', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'h2'            => 'h2',
            'div'           => 'div',
        ),
    ));


    // Карточки постов: Выводить автора
    $wp_customize->add_setting( 'root_options[structure_posts_author]', array(
        'default'           => $defaults['structure_posts_author'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_author]', array(
        'settings'          => 'root_options[structure_posts_author]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить автора?', 'root'),
        'type'              => 'radio',
        'description'       => 'Только для карточки "Одна запись большая"',
        'choices'           => array(
            'yes'           => 'Да, выводить если возможно',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Карточки постов: Выводить дату
    $wp_customize->add_setting( 'root_options[structure_posts_date]', array(
        'default'           => $defaults['structure_posts_date'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_date]', array(
        'settings'          => 'root_options[structure_posts_date]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить дату?', 'root'),
        'type'              => 'radio',
        'description'       => 'Только для карточки "Одна запись большая"',
        'choices'           => array(
            'yes'           => 'Да, выводить если возможно',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Карточки постов: Выводить рубрику
    $wp_customize->add_setting( 'root_options[structure_posts_category]', array(
        'default'           => $defaults['structure_posts_category'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_category]', array(
        'settings'          => 'root_options[structure_posts_category]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить рубрику?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));

    // Карточки постов: Выводить отрывок
    $wp_customize->add_setting( 'root_options[structure_posts_excerpt]', array(
        'default'           => $defaults['structure_posts_excerpt'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_excerpt]', array(
        'settings'          => 'root_options[structure_posts_excerpt]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить отрывок', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));

    // Карточки постов: Выводить комментарии
    $wp_customize->add_setting( 'root_options[structure_posts_comments]', array(
        'default'           => $defaults['structure_posts_comments'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_comments]', array(
        'settings'          => 'root_options[structure_posts_comments]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить кол-во комментариев', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));

    // Карточки постов: Выводить кол-во просмотров
    $wp_customize->add_setting( 'root_options[structure_posts_views]', array(
        'default'           => $defaults['structure_posts_views'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_posts_views]', array(
        'settings'          => 'root_options[structure_posts_views]',
        'section'           => 'root_structure_posts',
        'label'             => __('Выводить кол-во просмотров', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));




    /********************************************************************
     * Сайдбар
     */
    $wp_customize->add_section( 'root_structure_sidebar', array(
        'title'             => 'Сайдбар',
        'description'       => 'В данной секции Вы можете настроить внешний вид сайдбара',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Выводить сайдбар на мобильном
    $wp_customize->add_setting( 'root_options[structure_sidebar_mob]', array(
        'default'           => $defaults['structure_sidebar_mob'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_sidebar_mob]', array(
        'settings'          => 'root_options[structure_sidebar_mob]',
        'section'           => 'root_structure_sidebar',
        'label'             => __('Выводить сайдбар на мобильном?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));



    /********************************************************************
     * Содержание
     */
    $wp_customize->add_section( 'root_structure_toc', array(
        'title'             => 'Содержание',
        'description'       => 'В данной секции Вы можете настроить вывод Содержание постов',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Вывод крошек
    $wp_customize->add_setting( 'root_options[toc_enabled]', array(
        'default'           => $defaults['toc_enabled'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[toc_enabled]', array(
        'settings'          => 'root_options[toc_enabled]',
        'section'           => 'root_structure_toc',
        'label'             => __('Выводить содержание постов? BETA', 'root'),
        'description'       => 'Выводит содержание записи',
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Noindex
    $wp_customize->add_setting( 'root_options[toc_noindex]', array(
        'default'           => $defaults['toc_noindex'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[toc_noindex]', array(
        'settings'          => 'root_options[toc_noindex]',
        'section'           => 'root_structure_toc',
        'label'             => __( 'Обернуть содержание в noindex', 'root' ),
        'type'              => 'checkbox',
    ));





    /********************************************************************
     * Хлебные крошки
     */
    $wp_customize->add_section( 'root_structure_breadcrumbs', array(
        'title'             => 'Хлебные крошки',
        'description'       => 'В данной секции Вы можете настроить вывод хлебных крошек',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));

    // Вывод крошек
    $wp_customize->add_setting( 'root_options[breadcrumbs_display]', array(
        'default'           => $defaults['breadcrumbs_display'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[breadcrumbs_display]', array(
        'settings'          => 'root_options[breadcrumbs_display]',
        'section'           => 'root_structure_breadcrumbs',
        'label'             => __('Выводить хлебные крошки?', 'root'),
        'description'       => 'По умолчанию отображаются хлебные крошки, встроенные в тему Root, но при активации вывода хлебных крошек в плагине Yoast - будут выводиться хлебные крошки Yoast.',
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));

    // Текст первого пункта
    $wp_customize->add_setting( 'root_options[breadcrumbs_home_text]', array(
        'default'           => $defaults['breadcrumbs_home_text'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[breadcrumbs_home_text]', array(
        'settings'          => 'root_options[breadcrumbs_home_text]',
        'section'           => 'root_structure_breadcrumbs',
        'label'             => __('Текст ссылки на главную страницу', 'root'),
    ));

    // Разделитель
    $wp_customize->add_setting( 'root_options[breadcrumbs_separator]', array(
        'default'           => $defaults['breadcrumbs_separator'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[breadcrumbs_separator]', array(
        'settings'          => 'root_options[breadcrumbs_separator]',
        'section'           => 'root_structure_breadcrumbs',
        'label'             => __('Разделитель', 'root'),
    ));



    /********************************************************************
     * Социальные сети
     */
    $wp_customize->add_section( 'root_structure_social_network', array(
        'title'             => 'Социальные сети',
        'description'       => 'В данной секции Вы можете настроить вывод ссылок на Ваши социальные сети',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Facebook
    $wp_customize->add_setting( 'root_options[social_facebook]', array(
        'default'           => $defaults['social_facebook'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_facebook]', array(
        'settings'          => 'root_options[social_facebook]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Facebook', 'root'),
    ));


    // Вконтакте
    $wp_customize->add_setting( 'root_options[social_vk]', array(
        'default'           => $defaults['social_vk'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_vk]', array(
        'settings'          => 'root_options[social_vk]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Vk', 'root'),
    ));


    // Twitter
    $wp_customize->add_setting( 'root_options[social_twitter]', array(
        'default'           => $defaults['social_twitter'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_twitter]', array(
        'settings'          => 'root_options[social_twitter]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Twitter', 'root'),
    ));


    // Одноклассники
    $wp_customize->add_setting( 'root_options[social_ok]', array(
        'default'           => $defaults['social_ok'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_ok]', array(
        'settings'          => 'root_options[social_ok]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Одноклассники', 'root'),
    ));


    // Google plus
    $wp_customize->add_setting( 'root_options[social_gp]', array(
        'default'           => $defaults['social_gp'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_gp]', array(
        'settings'          => 'root_options[social_gp]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Google plus', 'root'),
    ));


    // Telegram
    $wp_customize->add_setting( 'root_options[social_telegram]', array(
        'default'           => $defaults['social_telegram'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_telegram]', array(
        'settings'          => 'root_options[social_telegram]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Telegram', 'root'),
    ));


    // YouTube
    $wp_customize->add_setting( 'root_options[social_youtube]', array(
        'default'           => $defaults['social_youtube'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_youtube]', array(
        'settings'          => 'root_options[social_youtube]',
        'section'           => 'root_structure_social_network',
        'label'             => __('YouTube', 'root'),
    ));


    // Instagram
    $wp_customize->add_setting( 'root_options[social_instagram]', array(
        'default'           => $defaults['social_instagram'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_instagram]', array(
        'settings'          => 'root_options[social_instagram]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Instagram', 'root'),
    ));


    // Linkedin
    $wp_customize->add_setting( 'root_options[social_linkedin]', array(
        'default'           => $defaults['social_linkedin'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[social_linkedin]', array(
        'settings'          => 'root_options[social_linkedin]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Linkedin', 'root'),
    ));


    // Скрывать ссылки через JS
    $wp_customize->add_setting( 'root_options[structure_social_js]', array(
        'default'           => $defaults['structure_social_js'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_social_js]', array(
        'settings'          => 'root_options[structure_social_js]',
        'section'           => 'root_structure_social_network',
        'label'             => __('Hide links by JS?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, скрывать',
            'no'            => 'Нет, не скрывать',
        ),
    ));







    /********************************************************************
     * Стрелка вверх
     */
    $wp_customize->add_section( 'root_structure_arrow', array(
        'title'             => 'Стрелка вверх',
        'description'       => 'В данной секции Вы можете настроить стрелку вверх',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Выводить стрелку
    $wp_customize->add_setting( 'root_options[structure_arrow]', array(
        'default'           => $defaults['structure_arrow'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_arrow]', array(
        'settings'          => 'root_options[structure_arrow]',
        'section'           => 'root_structure_arrow',
        'label'             => __('Выводить стрелку вверх?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));


    // Фоновый цвет стрелки вверх
    $wp_customize->add_setting( 'root_options[structure_arrow_bg]', array(
        'default'           => $defaults['structure_arrow_bg'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[structure_arrow_bg]',
        array(
            'settings'      => 'root_options[structure_arrow_bg]',
            'section'       => 'root_structure_arrow',
            'label'         => 'Фоновый цвет стрелки вверх',
        )
    ));


    // Цвет иконки стрелки вверх
    $wp_customize->add_setting( 'root_options[structure_arrow_color]', array(
        'default'           => $defaults['structure_arrow_color'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'root_options[structure_arrow_color]',
        array(
            'section'       => 'root_structure_arrow',
            'settings'      => 'root_options[structure_arrow_color]',
            'label'         => 'Цвет иконки стрелки вверх',
        )
    ));


    // Ширина стрелки вверх
    $wp_customize->add_setting( 'root_options[structure_arrow_width]', array(
        'default'           => $defaults['structure_arrow_width'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize,
        'root_options[structure_arrow_width]',
        array(
            'settings'      => 'root_options[structure_arrow_width]',
            'section'       => 'root_structure_arrow',
            'label'         => __( 'Ширина стрелки вверх, px', 'root' ),
            'description'   => 'По умолчанию — 50px',
            'input_attrs'   => array(
                'min'       => 30,
                'max'       => 80,
                'step'      => 1,
            ),
        ))
    );


    // Высота стрелки вверх
    $wp_customize->add_setting( 'root_options[structure_arrow_height]', array(
        'default'           => $defaults['structure_arrow_height'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize,
        'root_options[structure_arrow_height]',
        array(
            'settings'      => 'root_options[structure_arrow_height]',
            'section'       => 'root_structure_arrow',
            'label'         => __( 'Высота стрелки вверх, px', 'root' ),
            'description'   => 'По умолчанию — 50px',
            'input_attrs'   => array(
                'min'       => 30,
                'max'       => 80,
                'step'      => 1,
            ),
        ))
    );


    // Выбор иконки стрелки вверх
    $wp_customize->add_setting( 'root_options[structure_arrow_icon]', array(
        'default'           => $defaults['structure_arrow_icon'],
        'type'              => 'option',
    ) );
    $wp_customize->add_control( 'root_options[structure_arrow_icon]', array(
        'settings'          => 'root_options[structure_arrow_icon]',
        'section'           => 'root_structure_arrow',
        'type'              => 'select',
        'label'             => __( 'Выбор иконки стрелки вверх', 'root' ),
        'choices'           => array(
            '\f102'         => __( 'Двойная кавычка вверх', 'root' ),
            '\f106'         => __( 'Кавычка вверх', 'root' ),
            '\f10c'         => __( 'Круг', 'root' ),
            '\f139'         => __( 'Стрелка в круге', 'root' ),
            '\f148'         => __( 'Стрелка вверх', 'root' ),
            '\f151'         => __( 'Стрелка в квадрате', 'root' ),
            '\f096'         => __( 'Квадрат', 'root' ),
            '\f176'         => __( 'Стрелка вверх 2', 'root' ),
            '\f01b'         => __( 'Стрелка в круге 2', 'root' ),
            '\f077'         => __( 'Стрелка вверх 2', 'root' ),
        ),
    ) );


    // Стрелка вверх на мобильном
    $wp_customize->add_setting( 'root_options[structure_arrow_mob]', array(
        'default'           => $defaults['structure_arrow_mob'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[structure_arrow_mob]', array(
        'settings'          => 'root_options[structure_arrow_mob]',
        'section'           => 'root_structure_arrow',
        'label'             => __('Выводить стрелку вверх на мобильном?', 'root'),
        'type'              => 'radio',
        'choices'           => array(
            'yes'           => 'Да, выводить',
            'no'            => 'Нет, не выводить',
        ),
    ));







    /********************************************************************
     * Коды
     */
    $wp_customize->add_section( 'root_structure_code', array(
        'title'             => 'Коды',
        'panel'             => 'panel_structure',
        'capability'        => 'edit_theme_options',
    ));


    // Коды: В <head>
    $wp_customize->add_setting( 'root_options[code_head]', array(
        'default'           => $defaults['code_head'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[code_head]', array(
        'settings'          => 'root_options[code_head]',
        'section'           => 'root_structure_code',
        'label'             => __('В &lt;head&gt;', 'root'),
        'description'       => 'Код будет выведен перед закрывающим &lt;/head&gt;',
        'type'              => 'textarea',
    ));


    // Коды: Перед </body>
    $wp_customize->add_setting( 'root_options[code_body]', array(
        'default'           => $defaults['code_body'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[code_body]', array(
        'settings'          => 'root_options[code_body]',
        'section'           => 'root_structure_code',
        'label'             => __('Перед &lt;/body&gt;', 'root'),
        'description'       => 'Код будет выведен перед закрывающим &lt;/body&gt;',
        'type'              => 'textarea',
    ));


    // Коды: Сразу после контента
    $wp_customize->add_setting( 'root_options[code_after_content]', array(
        'default'           => $defaults['code_after_content'],
        'type'              => 'option',
    ));
    $wp_customize->add_control( 'root_options[code_after_content]', array(
        'settings'          => 'root_options[code_after_content]',
        'section'           => 'root_structure_code',
        'label'             => __('Сразу после контента', 'root'),
        'type'              => 'textarea',
    ));


    
    

}
add_action( 'customize_register', 'root_customize_register' );






/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function root_customize_preview_js() {
    wp_enqueue_script( 'root_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), rand(1,9999), true );
}
add_action( 'customize_preview_init', 'root_customize_preview_js' );









function root_customizer_body_classes( $classes ) {

    /********************************************************************
     * Sidebar
     */

    $sidebar_class = '';

    // Сайдбар на главной
    if ( root_get_option( 'structure_home_sidebar' ) == 'none' && is_front_page() ) {
        $sidebar_class = 'sidebar-none';
    }
    if ( root_get_option( 'structure_home_sidebar' ) == 'left' && is_front_page() ) {
        $sidebar_class = 'sidebar-left';
    }

    // Сайдбар в архивах
    if ( root_get_option( 'structure_archive_sidebar' ) == 'none' && is_archive() ) {
        $sidebar_class = 'sidebar-none';
    }
    if ( root_get_option( 'structure_archive_sidebar' ) == 'left' && is_archive() ) {
        $sidebar_class = 'sidebar-left';
    }

    // Сайдбар записи
    if ( root_get_option( 'structure_single_sidebar' ) == 'none' && is_single() ) {
        $sidebar_class = 'sidebar-none';
    }
    if ( root_get_option( 'structure_single_sidebar' ) == 'left' && is_single() ) {
        $sidebar_class = 'sidebar-left';
    }

    // Сайдбар страниц
    if ( root_get_option( 'structure_page_sidebar' ) == 'none' && is_page() ) {
        $sidebar_class = 'sidebar-none';
    }
    if ( root_get_option( 'structure_page_sidebar' ) == 'left' && is_page() ) {
        $sidebar_class = 'sidebar-left';
    }

    // настройки для отдельной статьи
    if ( is_single() || is_page() ) {
        global $post;
        if ( 'checked' == get_post_meta( $post->ID, 'sidebar_hide', true ) ) {
            $sidebar_class = 'sidebar-none';
        }
    }

    $classes[] = $sidebar_class;


    /********************************************************************
     * Skin
     */
    $skin = root_get_option( 'skin' );
    if ( ! empty( $skin ) && $skin != 'no' ) {
        $classes[] = $skin;
    }


    return $classes;
}
add_filter( 'body_class', 'root_customizer_body_classes' );




/**
 * Sanitize int value
 *
 * @param $val
 *
 * @return int
 */
function root_sanitize_integer( $val ) {
    return absint( $val );
}



/**
 * Get all patterns to customizer choicer
 *
 * @return array
 */
function root_get_patterns() {

    global $patterns;
    $pattern_choices = array(
        'no' => array(
            'label' => esc_html__( 'No', 'root' ),
            'url'   => '%s/images/backgrounds/no.png'
        ),
    );
    foreach ( $patterns as $key => $pattern ) {
        $pattern_choices[ $key ] = array(
            'label'     => $pattern['label'],
            'url'       => '%s/images/backgrounds/' . $pattern['mini'],
        );
    }

    return $pattern_choices;

}


/**
 * Get pattern file name
 *
 * @param string $pattern
 *
 * @return string
 */
function root_get_pattern_url( $pattern = '' ) {

    global $patterns;
    if ( isset( $patterns[$pattern] ) ) {
        return $patterns[$pattern]['pattern'];
    } else {
        return '';
    }

}



/**
 * Customizer CSS
 */
require get_template_directory() . '/inc/customizer/customizer-css.php';

/**
 * Customizer Control - Radio Image
 */
require get_template_directory() . '/inc/customizer/customizer-control-radio-image.php';

/**
 * Customizer Control - Range
 */
require get_template_directory() . '/inc/customizer/customizer-control-range.php';