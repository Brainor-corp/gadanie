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

/**
 * ТОП комментаторов
 *
 * @var $args array
 */
function sp_top_commentator( $args = array() ){

    global $wpdb;

    $length = 10; // количество символов
    $month = false; // периодичность обновления
    $count = 6; // количество комментаторов
    $exceptionEmail = get_option('admin_email') .', info@wpshop.biz'; // исключение адреса через запятую

    $domain_localization = ( ! empty( $args['localization'] ) ) ? $args['localization'] : 'default';

    if ( ! empty( $args['period'] ) && $args['period'] == 'month' ) $month = true;
    if ( ! empty( $args['count'] ) && is_numeric( $args['count'] ) ) $count = $args['count'];

    $results = $wpdb->get_results('
    SELECT
    COUNT(comment_author_email) AS comments_count, comment_author_email, comment_author, comment_author_url
    FROM
    (select * from '.$wpdb->comments.' order by comment_ID desc) as pc
    WHERE
    comment_author_email != "" AND
    comment_type = "" AND
    comment_approved = 1 AND
    comment_author_email NOT IN ('.preg_replace('/([\w\d\.\-_]+@[\w\d\.\-_]+)(,? ?)/','"\\1"\\2',$exceptionEmail).')'.
        ($month ? 'AND month(comment_date) = month(now()) AND year(comment_date) = year(now())' : '').
        'GROUP BY
    comment_author_email
    ORDER BY
    comments_count DESC
    LIMIT '.$count
    );


    if ( ! empty( $results ) ) {

        echo "<div class=\"top-commentators\"><ul>";

        foreach( $results as $result ) {

            // обрезаем имя
            if ($length and $length<mb_strlen($result->comment_author)) $result->comment_author = trim(mb_substr($result->comment_author, 0, $length)).'.';

            $comment_author_url = '';
            if ($result->comment_author_url) $comment_author_url = base64_encode( $result->comment_author_url );

            if ( ! empty( $comment_author_url ) ) {
                $com_name = '<span class="ps-link js-link" data-uri="'. $comment_author_url .'"><span>'.$result->comment_author.'</span></span>';
            } else {
                $com_name = $result->comment_author;
            }

            ?>

            <li>
                <div class="top-commentators__ava">
                    <?php
                    if ( ! empty( $comment_author_url ) ) {
                        echo '<span class="ps-link js-link" data-uri="'. $comment_author_url .'">' . get_avatar( $result->comment_author_email, 60 ) . '<span>';
                    } else {
                        echo get_avatar( $result->comment_author_email, 60 );
                    }
                    ?>
                </div>

                <div class="top-commentators__name">
                    <?php echo $com_name ?>
                </div>

                <div class="top-commentators__count">
                    <span><?php echo $result->comments_count ?></span>
                </div>
            </li>

            <?php
        }

        echo "</ul></div>";

    } else {

        _e( 'You can be first.', $domain_localization );

    }

}