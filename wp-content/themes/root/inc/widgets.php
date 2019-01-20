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

class wpshopbizTopCommentatorsWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'top_commentators',
            'ТОП комментаторов',
            array( 'description' => 'ТОП комментаторов' )
        );
    }

    /*
     * фронтэнд виджета
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];


        $period = ( ! empty($instance['period']) ) ? trim($instance['period']) : '';
        $count  = ( ! empty($instance['count']) ) ? trim($instance['count']) : '';


        $arguments = array(
            'localization' => 'root',
        );
        if ( ! empty( $period ) ) $arguments['period'] = $period;
        if ( ! empty( $count ) )  $arguments['count'] = $count;

        sp_top_commentator( $arguments );

        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $title                  = ( isset( $instance[ 'title' ] ) )         ? $instance[ 'title' ] : '';
        $period                 = ( isset( $instance[ 'period' ] ) )        ? $instance[ 'period' ] : '';
        $count                  = ( isset( $instance[ 'count' ] ) )         ? $instance[ 'count' ] : 6 ;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>">Количество комментаторов</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $count ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'period' ); ?>">Период</label><br>
            <select name="<?php echo $this->get_field_name( 'period' ); ?>" id="<?php echo $this->get_field_id( 'period' ); ?>" class="widefat">
                <option value="all" <?php selected($period, 'all') ?>>За все время</option>
                <option value="month" <?php selected($period, 'month') ?>>За месяц</option>
            </select>
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['period']     = ( ! empty( $new_instance['period'] ) ) ? strip_tags( $new_instance['period'] ) : '';
        $instance['count']      = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
        return $instance;
    }
}

function wpshopbiz_top_commentators_widget_load() {
    register_widget( 'wpshopbizTopCommentatorsWidget' );
}
add_action( 'widgets_init', 'wpshopbiz_top_commentators_widget_load' );











class wpshopbizSubscribeWidget2 extends WP_Widget {

    function __construct() {
        parent::__construct(
            'wpshopbiz_subscribe',
            'Подписка',
            array( 'description' => 'Форма подписки на обновления' )
        );
    }

    /*
     * фронтэнд виджета
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        ?>


        <!-- код формы подписки -->
        <div class="widget-subscribe">
            <div class="widget-subscribe__i">

                <a href="<?php bloginfo('rss2_url') ?>" class="widget-subscribe__rss">
                    RSS-подписка
                </a>
            </div>
        </div>
        <!-- код формы подписки -->



        <?php

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

function wpshopbiz_subscribe_widget_load2() {
    register_widget( 'wpshopbizSubscribeWidget2' );
}
//add_action( 'widgets_init', 'wpshopbiz_subscribe_widget_load2' );










class wpshopbizArticlesWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'wpshop_articles',
            'Вывод статей',
            array( 'description' => 'Вывод статей' )
        );
    }

    /*
     * фронтэнд виджета
     */
    public function widget( $args, $instance ) {

        global $post;
        
        $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // ID постов
        $post_ids = ( ! empty($instance['post_ids']) ) ? trim($instance['post_ids']) : '';

        // ID рубрик
        $category_ids = ( ! empty($instance['category_ids']) ) ? trim($instance['category_ids']) : '';

        // Сортировка
        $posts_orderby = ( ! empty($instance['posts_orderby']) ) ? trim($instance['posts_orderby']) : '';

        // Кол-во дней
        $posts_period  = ( ! empty($instance['posts_period']) ) ? trim($instance['posts_period']) : '';

        // Кол-во постов
        $post_limit = ( ! empty($instance['post_limit']) ) ? trim($instance['post_limit']) : '';

		// Внешний вид
        $articles_view = ! empty( $instance['articles_view'] ) ? $instance['articles_view'] : '';
		
		// Ссылка в новом окне
        $link_target   = ! empty( $instance['link_target'] ) ? $instance['link_target'] : '';



        // default values
        $get_posts_args = array(
            'orderby'           => 'rand',
            'numberposts'       => $post_limit,
        );

        // сортировка
        if ( $posts_orderby == 'rand' ) {
            $get_posts_args = array(
                'orderby'           => 'rand',
                'numberposts'       => $post_limit,
            );
        }
        if ( $posts_orderby == 'views' ) {
            $get_posts_args = array(
                'meta_key'          => 'views',
                'orderby'           => 'meta_value_num',
                'order'             => 'DESC',
                'numberposts'       => $post_limit,
            );
        }
        if ( $posts_orderby == 'comments' ) {
            $get_posts_args = array(
                'orderby'           => 'comment_count',
                'order'             => 'DESC',
                'numberposts'       => $post_limit,
            );
        }
        if ( $posts_orderby == 'new' ) {
            $get_posts_args = array(
                'orderby'           => 'date',
                'order'             => 'DESC',
                'numberposts'       => $post_limit,
            );
        }
	    
	if ( is_single() ) {
	    $get_posts_args['post__not_in'] = array( $post->ID);
	}

	

        /**
         * Если заданы посты для исключения
         */
        if ( ! empty($post_ids) ) {

            $post_ids_exp = explode(',', $instance['post_ids']);

            if (is_array($post_ids_exp)) {
                $post_ids = array_map('trim', $post_ids_exp);
            } else {
                $post_ids = array($instance['post_ids']);
            }

            $get_posts_args['post__in'] = $post_ids;

        }


        /**
         * Если заданы категории
         */
        if ( ! empty($category_ids) ) {

            $category_ids_exp = explode( ',', wpshop_sanitize_ids_string($instance['category_ids']) );
            $category_ids = array_map('trim', $category_ids_exp);

            if ( ! empty( $category_ids ) ) {
                $get_posts_args['cat'] = $category_ids;
            }

        }


        /**
         * Если задано кол-во дней
         */
        if ( ! empty( $posts_period ) ) {
            $get_posts_args['date_query'] = array(
                'after' => $posts_period . ' days ago',
            );
        }


        $posts = get_posts( $get_posts_args );
        foreach ( $posts as $single_post ) {
            ?>


            <?php if ( $articles_view == 'normal' ): ?>

                <div class="widget-article">
                    <div class="widget-article__image">
						<a href="<?php echo get_permalink($single_post->ID) ?>"<?php echo ( $link_target == true ) ? ' target="_blank"' : ''; ?>>
                        <?php $thumb = get_the_post_thumbnail($single_post->ID, 'thumb-wide'); if (!empty($thumb)): ?>
                            <?php echo $thumb ?>
                        <?php endif ?>
                        </a>
                    </div>
                    <div class="widget-article__body">
                        <div class="widget-article__title"><a href="<?php echo get_permalink($single_post->ID) ?>"<?php echo ( $link_target == true ) ? ' target="_blank"' : ''; ?>><?php echo get_the_title($single_post->ID) ?></a></div>
                    </div>
                </div>

            <?php else: ?>

                <div class="widget-article widget-article--compact">
                    <div class="widget-article__image">
						<a href="<?php echo get_permalink($single_post->ID) ?>"<?php echo ( $link_target == true ) ? ' target="_blank"' : ''; ?>>
                        <?php $thumb = get_the_post_thumbnail($single_post->ID, 'thumbnail'); if (!empty($thumb)): ?>
                            <?php echo $thumb ?>
                        <?php endif ?>
                        </a>
                    </div>
                    <div class="widget-article__body">
                        <div class="widget-article__title"><a href="<?php echo get_permalink($single_post->ID) ?>"<?php echo ( $link_target == true ) ? ' target="_blank"' : ''; ?>><?php echo get_the_title($single_post->ID) ?></a></div>
                        <div class="widget-article__category">
                            <?php echo root_category( $single_post->ID, '', false ) ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>



            <?php
        }


        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $title                  = ( isset( $instance[ 'title' ] ) )         ? $instance[ 'title' ] : '';
        $post_ids               = ( isset( $instance[ 'post_ids' ] ) )      ? $instance[ 'post_ids' ] : '';
        $category_ids           = ( isset( $instance[ 'category_ids' ] ) )  ? $instance[ 'category_ids' ] : '';
        $posts_orderby          = ( isset( $instance[ 'posts_orderby' ] ) ) ? $instance[ 'posts_orderby' ] : '';
        $posts_articles_view    = ( isset( $instance[ 'articles_view' ] ) ) ? $instance[ 'articles_view' ] : '';
        $posts_period           = ( isset( $instance[ 'posts_period' ] ) )  ? $instance[ 'posts_period' ] : '';
        $post_limit             = ( isset( $instance[ 'post_limit' ] ) )    ? $instance[ 'post_limit' ] : '';
		$link_target            = ! empty( $instance['link_target'] )       ? $instance['link_target'] : '';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_orderby' ); ?>">Сортировка</label><br>
            <select name="<?php echo $this->get_field_name( 'posts_orderby' ); ?>" id="<?php echo $this->get_field_id( 'posts_orderby' ); ?>">
                <option value="rand" <?php selected($posts_orderby, 'rand') ?>>Случайно</option>
                <option value="views" <?php selected($posts_orderby, 'views') ?>>По просмотрам (views)</option>
                <option value="comments" <?php selected($posts_orderby, 'comments') ?>>По комментариям</option>
                <option value="new" <?php selected($posts_orderby, 'new') ?>>Новые сверху</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_ids' ); ?>">ID постов через запятую, если нужно вывести определенные посты</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'post_ids' ); ?>" name="<?php echo $this->get_field_name( 'post_ids' ); ?>" type="text" value="<?php echo esc_attr( $post_ids ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category_ids' ); ?>">ID рубрик через запятую, если нужно вывести посты определенных рубрик (добавьте минус перед ID рубрики, чтобы её исключить)</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'category_ids' ); ?>" name="<?php echo $this->get_field_name( 'category_ids' ); ?>" type="text" value="<?php echo esc_attr( $category_ids ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_limit' ); ?>">Количество постов</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'post_limit' ); ?>" name="<?php echo $this->get_field_name( 'post_limit' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $post_limit ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_period' ); ?>">Количество дней, за которые показывать посты</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'posts_period' ); ?>" name="<?php echo $this->get_field_name( 'posts_period' ); ?>" type="number" value="<?php echo esc_attr( $posts_period ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'articles_view' ); ?>">Вывод</label><br>
            <select name="<?php echo $this->get_field_name( 'articles_view' ); ?>" id="<?php echo $this->get_field_id( 'articles_view' ); ?>">
                <option value="normal" <?php selected($posts_articles_view, 'normal') ?>>Обычный</option>
                <option value="compact" <?php selected($posts_articles_view, 'compact') ?>>Компактно</option>
            </select>
        </p>
		<p>
            <input type="checkbox" id="<?php echo $this->get_field_id('link_target'); ?>" name="<?php echo $this->get_field_name('link_target'); ?>" value="1" <?php checked( $link_target ); ?>>
			<label for="<?php echo $this->get_field_id( 'link_target' ); ?>">Открывать ссылку в новом окне</label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_ids']       = ( ! empty( $new_instance['post_ids'] ) ) ? wpshop_sanitize_ids_string( $new_instance['post_ids'] ) : '';
        $instance['category_ids']   = ( ! empty( $new_instance['category_ids'] ) ) ? wpshop_sanitize_ids_string ( $new_instance['category_ids'] ) : '';
        $instance['posts_orderby']  = ( ! empty( $new_instance['posts_orderby'] ) ) ? strip_tags( $new_instance['posts_orderby'] ) : '';
        $instance['post_limit']     = ( ! empty( $new_instance['post_limit'] ) ) ? strip_tags( $new_instance['post_limit'] ) : '';
        $instance['posts_period']   = ( ! empty( $new_instance['posts_period'] ) ) ? strip_tags( $new_instance['posts_period'] ) : '';
        $instance['articles_view']  = ( ! empty( $new_instance['articles_view'] ) ) ? strip_tags( $new_instance['articles_view'] ) : '';
		$instance['link_target']    = ! empty( $new_instance['link_target'] ) ? true : false;
        return $instance;
    }
}

function wpshopbiz_articles_widget_load() {
    register_widget( 'wpshopbizArticlesWidget' );
}
add_action( 'widgets_init', 'wpshopbiz_articles_widget_load' );




















